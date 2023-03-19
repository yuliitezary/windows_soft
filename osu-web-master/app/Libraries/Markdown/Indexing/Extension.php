<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\Indexing;

use App\Libraries\Markdown\CustomContainerInline\Element as CustomContainerInline;
use App\Libraries\Markdown\Osu\Extension as OsuExtension;
use App\Libraries\Markdown\StyleBlock\Element as StyleBlock;
use League\CommonMark\Environment\EnvironmentBuilderInterface;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\CommonMark\Node\Block as ExtensionBlock;
use League\CommonMark\Extension\CommonMark\Node\Inline as ExtensionInline;
use League\CommonMark\Extension\Footnote;
use League\CommonMark\Extension\Strikethrough\Strikethrough;
use League\CommonMark\Extension\Table as TableExtension;
use League\CommonMark\Node\Block;
use League\CommonMark\Node\Inline;

class Extension extends OsuExtension
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        if ($environment->getConfiguration()->exists('osu_extension/attributes_allowed')) {
            $environment->addExtension(new AttributesExtension());
        }

        foreach ($this->renderers() as $class => $renderer) {
            $environment->addRenderer($class, $renderer, 10);
        }
    }

    private function renderers()
    {
        return [
            Block\Document::class => new Renderers\BlockRenderer(),
            Block\Paragraph::class => new Renderers\BlockRenderer(),
            CustomContainerInline::class => new Renderers\InlineRenderer(),
            ExtensionBlock\BlockQuote::class => new Renderers\BlockRenderer(),
            ExtensionBlock\FencedCode::class => new Renderers\NoopRenderer(),
            ExtensionBlock\Heading::class => new Renderers\NoopRenderer(),
            ExtensionBlock\HtmlBlock::class => new Renderers\NoopRenderer(),
            ExtensionBlock\IndentedCode::class => new Renderers\BlockRenderer(),
            ExtensionBlock\ListBlock::class => new Renderers\ListBlockRenderer(),
            ExtensionBlock\ListItem::class => new Renderers\ListItemRenderer(),
            ExtensionBlock\ThematicBreak::class => new Renderers\BlockRenderer(),
            ExtensionInline\Code::class => new Renderers\InlineRenderer(),
            ExtensionInline\Emphasis::class => new Renderers\InlineRenderer(),
            ExtensionInline\HtmlInline::class => new Renderers\NoopRenderer(),
            ExtensionInline\Image::class => new Renderers\NoopRenderer(),
            ExtensionInline\Link::class => new Renderers\InlineRenderer(),
            ExtensionInline\Strong::class => new Renderers\InlineRenderer(),
            Footnote\Node\Footnote::class => new Renderers\NoopRenderer(),
            Footnote\Node\FootnoteBackref::class => new Renderers\NoopRenderer(),
            Footnote\Node\FootnoteContainer::class => new Renderers\NoopRenderer(),
            Footnote\Node\FootnoteRef::class => new Renderers\NoopRenderer(),
            Inline\Newline::class => new Renderers\NewlineRenderer(),
            Inline\Text::class => new Renderers\InlineRenderer(),
            Strikethrough::class => new Renderers\InlineRenderer(),
            StyleBlock::class => new Renderers\BlockRenderer(),
            TableExtension\Table::class => new Renderers\TableRenderer(),
            TableExtension\TableCaption::class => new Renderers\NoopRenderer(),
            TableExtension\TableSection::class => new Renderers\TableRenderer(),
            TableExtension\TableRow::class => new Renderers\TableRenderer(),
            TableExtension\TableCell::class => new Renderers\TableRenderer(),
        ];
    }
}
