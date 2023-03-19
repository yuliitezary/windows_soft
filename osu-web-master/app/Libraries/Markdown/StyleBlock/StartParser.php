<?php

// Copyright (c) ppy Pty Ltd <contact@ppy.sh>. Licensed under the GNU Affero General Public License v3.0.
// See the LICENCE file in the repository root for full licence text.

namespace App\Libraries\Markdown\StyleBlock;

use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

class StartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        $currentLine = $cursor->getLine();

        if (!starts_with($currentLine, ':::')) {
            return BlockStart::none();
        }

        // TODO: what happens to characters at the end of an opening block isn't well defined in the spec (e.g. markdown-it seems to behave differently),
        // which can conflict with inline custom containers.
        $className = mb_strtolower(str_replace(' ', '-', trim($currentLine, ' :')));

        if (!present($className)) {
            return BlockStart::none();
        }

        $cursor->advanceToEnd();

        return BlockStart::of(new Parser($className))->at($cursor);
    }
}
