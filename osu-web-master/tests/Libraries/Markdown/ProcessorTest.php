<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace Tests\Libraries\Markdown;

use App\Libraries\Markdown\OsuMarkdown;
use Tests\TestCase;

class ProcessorTest extends TestCase
{
    /**
     * @dataProvider htmlExamples
     */
    public function testHtml($name, $path)
    {
        [$osuMarkdown, $expectedOutput] = $this->loadOutputTest($name, $path, 'html');

        $this->assertSame(
            $this->normalizeHTML("<div class='osu-md'>{$expectedOutput}</div>"),
            $this->normalizeHTML($osuMarkdown->html()),
        );
    }

    /**
     * @dataProvider indexableExamples
     */
    public function testIndexable($name, $path)
    {
        [$osuMarkdown, $expectedOutput] = $this->loadOutputTest($name, $path, 'txt');

        $this->assertSame($expectedOutput, $osuMarkdown->toIndexable());
    }

    public function testTocId()
    {
        $parser = new OsuMarkdown('default', osuExtensionConfig: ['attributes_allowed' => ['id'], 'generate_toc' => true]);

        $parsed = $parser->load('## some header {#headerid}')->toArray();

        $this->assertTrue(isset($parsed['toc']['headerid']));
    }

    public function testTocImage()
    {
        $parser = new OsuMarkdown('default', osuExtensionConfig: ['generate_toc' => true]);

        $parsed = $parser->load('## ![alt text](/image.jpg) some header')->toArray();

        $this->assertTrue(isset($parsed['toc']['some-header']));
        $this->assertSame('some header', $parsed['toc']['some-header']['title']);
    }

    public function htmlExamples()
    {
        return $this->fileList(__DIR__.'/html_markdown_examples', '.md');
    }

    public function indexableExamples()
    {
        return $this->fileList(__DIR__.'/indexable_markdown_examples', '.md');
    }

    private function loadOutputTest(string $name, string $path, string $extension)
    {
        $mdFilePath = "{$path}/{$name}.md";
        $textFilePath = "{$path}/{$name}.{$extension}";

        return [
            (new OsuMarkdown(
                'default',
                osuExtensionConfig: [
                    'attributes_allowed' => ['flag', 'id'],
                    'custom_container_inline' => true,
                    'style_block_allowed_classes' => ['class-name'],
                ],
                osuMarkdownConfig: [
                    'enable_footnote' => true,
                ],
            ))->load(file_get_contents($mdFilePath)),
            file_get_contents($textFilePath),
        ];
    }
}
