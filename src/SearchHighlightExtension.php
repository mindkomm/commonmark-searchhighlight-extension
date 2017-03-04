<?php

namespace Mind\CommonMark\SearchHighlightExtension;

use League\CommonMark\Extension\Extension;
use Mind\CommonMark\SearchHighlightExtension\Inline\Renderer\InlineContainerRenderer;
use Mind\CommonMark\SearchHighlightExtension\Inline\Renderer\SpanRenderer;

/**
 * Class SearchHighlightExtension
 *
 * @package Mind\CommonMark\SearchHighlightExtension
 */
class SearchHighlightExtension extends Extension
{
    public function getInlineRenderers()
    {
        return [
            __NAMESPACE__.'\\Inline\Element\Span'            => new SpanRenderer(),
            __NAMESPACE__.'\\Inline\Element\InlineContainer' => new InlineContainerRenderer(),
        ];
    }

    public function getDocumentProcessors()
    {
        return [
            new SearchHighlightProcessor(),
        ];
    }
}
