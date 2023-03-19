<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Osu;

use App\Libraries\LocaleMeta;
use App\Libraries\OsuWiki;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\Node\Block;
use League\CommonMark\Extension\CommonMark\Node\Inline;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Node\Inline\Text;
use League\CommonMark\Node\Node;
use League\CommonMark\Node\NodeWalkerEvent;
use League\CommonMark\Node\StringContainerInterface;
use League\Config\ConfigurationInterface;

class DocumentProcessor
{
    public ?string $firstImage;
    public ?string $title;
    public ?array $toc;

    private ConfigurationInterface $config;
    private ?NodeWalkerEvent $event;
    private $node;

    private int $figureIndex;
    private ?string $galleryId;
    private array $tocSlugs;

    private ?string $relativeUrlRoot;
    private ?string $wikiLocale;
    private ?string $wikiPathToRoot = null;
    private ?string $wikiAbsoluteRootPath = null;

    public function __construct(EnvironmentBuilderInterface $environment)
    {
        $this->config = $environment->getConfiguration();
    }

    public function __invoke(DocumentParsedEvent $event): void
    {
        $document = $event->getDocument();
        $walker = $document->walker();

        // The config value should come from route() call which means it's percent encoded
        // but it'll be reused as parameter for another route() call so decode it here.
        $relativeUrlRoot = $this->config->get('osu_extension/relative_url_root');
        $this->relativeUrlRoot = $relativeUrlRoot === null ? null : urldecode($relativeUrlRoot);
        $fixWikiUrl = $this->config->get('osu_extension/fix_wiki_url');
        $generateToc = $this->config->get('osu_extension/generate_toc');
        $recordFirstImage = $this->config->get('osu_extension/record_first_image');
        $titleFromDocument = $this->config->get('osu_extension/title_from_document');
        $withGallery = $this->config->get('osu_extension/with_gallery');
        $this->wikiLocale = $this->config->get('osu_extension/wiki_locale');

        $this->setWikiPaths();

        $this->figureIndex = 0;
        $this->firstImage = null;
        $this->galleryId = null;
        $this->title = null;
        $this->toc = [];
        $this->tocSlugs = [];

        while (($this->event = $walker->next()) !== null) {
            $this->node = $this->event->getNode();

            $this->updateLocaleLink();
            $this->fixRelativeUrl();

            if ($fixWikiUrl) {
                $this->fixWikiUrl();
            }

            if ($recordFirstImage) {
                $this->recordFirstImage();
            }

            if ($titleFromDocument) {
                $this->setTitle();
            }

            if ($generateToc) {
                $this->loadToc();
            }

            $this->proxyImage();

            $this->parseFigure($withGallery);
        }
    }

    private function fixRelativeUrl()
    {
        if ($this->relativeUrlRoot === null) {
            return;
        }

        if (!$this->event->isEntering() || !($this->node instanceof Inline\AbstractWebResource)) {
            return;
        }

        $src = $this->node->getUrl();

        if (preg_match(',^(#|/|https?://|mailto:),', $src) !== 1) {
            if (starts_with($src, './')) {
                $src = substr($src, 2);
            }

            $this->node->setUrl($this->relativeUrlRoot.'/'.$src);
        }
    }

    private function getText(Node $node, bool $trim = true): string
    {
        $text = '';

        foreach ($node->children() as $child) {
            if ($child instanceof Inline\Image) {
                continue;
            } elseif ($child instanceof StringContainerInterface) {
                $text .= $child->getLiteral();
            } else {
                $text .= $this->getText($child, false);
            }
        }

        if ($trim) {
            $text = trim($text);
        }

        return $text;
    }

    private function loadToc()
    {
        if (
            !$this->node instanceof Block\Heading ||
            !$this->event->isEntering() ||
            ($level = $this->node->getLevel()) === 1
        ) {
            return;
        }

        $title = presence($this->getText($this->node));
        $slug = $this->node->data['attributes']['id'] ?? presence(mb_strtolower(str_replace(' ', '-', $title))) ?? 'page';

        if (array_key_exists($slug, $this->tocSlugs)) {
            $this->tocSlugs[$slug] += 1;

            $slug .= '.'.$this->tocSlugs[$slug];
        } else {
            $this->tocSlugs[$slug] = 0;
        }

        if ($level <= 3) {
            $this->toc[$slug] = compact('title', 'level');
        }

        $this->node->data->set('attributes/id', $slug);
    }

    private function parseFigure($withGallery = false)
    {
        if (!$this->node instanceof Paragraph || $this->event->isEntering()) {
            return;
        }

        if (count($this->node->children()) !== 1 || !$this->node->children()[0] instanceof Inline\Image) {
            return;
        }

        $blockClass = $this->config->get('osu_extension/block_name');

        $image = $this->node->children()[0];
        $this->node->data->set('attributes/class', "{$blockClass}__figure-container");
        $image->data->set('attributes/class', "{$blockClass}__figure-image");

        if (present($image->getTitle() ?? null)) {
            $text = new Text($image->getTitle());
            $textContainer = new Inline\Emphasis();
            $textContainer->data->set('attributes/class', "{$blockClass}__figure-caption");
            $textContainer->appendChild($text);
            $this->node->appendChild($textContainer);
        }

        if ($withGallery) {
            $this->galleryId ??= (string) rand();
            $imageUrl = $image->getUrl();

            if (starts_with($imageUrl, route('wiki.show', [], false))) {
                $imageUrl = config('app.url').$imageUrl;
            }

            $imageSize = fast_imagesize($imageUrl);
            if (!isset($imageSize)) {
                return;
            }

            $image->data->append('attributes/class', "{$blockClass}__figure-image--gallery js-gallery");
            $image->data->set('attributes/data-width', (string) $imageSize[0]);
            $image->data->set('attributes/data-height', (string) $imageSize[1]);
            $image->data->set('attributes/data-gallery-id', $this->galleryId);
            $image->data->set('attributes/data-index', (string) $this->figureIndex);
            $image->data->set('attributes/data-src', $imageUrl);

            $this->figureIndex++;
        }
    }

    private function fixWikiUrl()
    {
        if (!$this->event->isEntering() || !($this->node instanceof Inline\AbstractWebResource)) {
            return;
        }

        $url = $this->node->getUrl();

        $url = preg_replace_callback(',^(?:/help)?/wiki/(?<locale>[^/?#]+)(?:/(?<path>[^?#]+))?(?<query>\?.*)?(?<hash>#.*)?$,', function ($matches) {
            $matches['path'] = $matches['path'] ?? '';
            $matches['query'] = $matches['query'] ?? '';
            $matches['hash'] = $matches['hash'] ?? '';

            if (LocaleMeta::isValid($matches['locale'])) {
                $locale = $matches['locale'];
                $path = $matches['path'];
            } else {
                $path = concat_path([$matches['locale'], $matches['path']]);
            }

            if (OsuWiki::isImage($path)) {
                $url = wiki_image_url($path, false);
            } else {
                $locale ??= $this->wikiLocale ?? config('app.fallback_locale');
                $url = wiki_url($path, $locale, false, false);

                if (starts_with($url, $this->wikiAbsoluteRootPath)) {
                    $url = $this->wikiPathToRoot.substr($url, strlen($this->wikiAbsoluteRootPath));
                }
            }

            return "{$url}{$matches['query']}{$matches['hash']}";
        }, $url);

        $this->node->setUrl($url);
    }

    private function proxyImage()
    {
        if (!$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $url = $this->node->getUrl();

        if (present($url)) {
            $this->node->setUrl(proxy_media($url));
        }
    }

    private function recordFirstImage()
    {
        if ($this->firstImage !== null || !$this->node instanceof Inline\Image || !$this->event->isEntering()) {
            return;
        }

        $this->firstImage = proxy_media($this->node->getUrl());
    }

    private function setTitle()
    {
        // wait until leaving otherwise node->next will be null after detaching.
        if (!$this->node instanceof Block\Heading || $this->event->isEntering() || $this->title !== null) {
            return;
        }

        $this->title = presence($this->getText($this->node));
    }

    private function updateLocaleLink()
    {
        if (!$this->node instanceof Inline\Link || !$this->event->isEntering()) {
            return;
        }

        if (preg_match('#^(\w{2}(?:-\w{2})?):(.+)$#', $this->node->getUrl(), $matches) !== 1) {
            return;
        }

        $this->node->setUrl("{$matches[2]}?locale={$matches[1]}");
    }

    private function setWikiPaths()
    {
        if ($this->relativeUrlRoot === null || $this->wikiLocale === null) {
            return;
        }

        $this->wikiAbsoluteRootPath = route('wiki.show', ['locale' => $this->wikiLocale], false).'/';

        if (starts_with($this->relativeUrlRoot, $this->wikiAbsoluteRootPath)) {
            $relativeFromBase = substr($this->relativeUrlRoot, strlen($this->wikiAbsoluteRootPath));
            $slashes = substr_count($relativeFromBase, '/');

            if ($slashes === 0) {
                $this->wikiPathToRoot = './';
            } else {
                $this->wikiPathToRoot = implode('/', array_fill(0, $slashes, '..')).'/';
            }
        } else {
            $this->wikiPathToRoot = $this->wikiAbsoluteRootPath;
        }
    }
}
