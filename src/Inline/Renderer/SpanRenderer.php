<?php

namespace Mind\CommonMark\SearchHighlightExtension\Inline\Renderer;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use League\CommonMark\HtmlElement;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\Span;

/**
 * Class SpanRenderer
 *
 * @package Mind\CommonMark\SearchHighlightExtension\Inline\Renderer
 */
class SpanRenderer implements InlineRendererInterface
{
    /**
     * @param Span                     $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return HtmlElement
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if ( ! ($inline instanceof Span)) {
            throw new \InvalidArgumentException('Incompatible inline type: '.get_class($inline));
        }

        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        return new HtmlElement('span', $attrs, $htmlRenderer->renderInlines($inline->children()));
    }
}
