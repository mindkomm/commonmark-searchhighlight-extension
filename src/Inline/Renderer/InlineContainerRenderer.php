<?php

namespace Mind\CommonMark\SearchHighlightExtension\Inline\Renderer;

use League\CommonMark\ElementRendererInterface;
use League\CommonMark\Inline\Element\AbstractInline;
use League\CommonMark\Inline\Renderer\InlineRendererInterface;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\InlineContainer;

/**
 * Class InlineContainerRenderer
 *
 * @package Mind\CommonMark\SearchHighlightExtension\Inline\Renderer
 */
class InlineContainerRenderer implements InlineRendererInterface
{
    /**
     * @param AbstractInline           $inline
     * @param ElementRendererInterface $htmlRenderer
     *
     * @return \League\CommonMark\HtmlElement|string
     */
    public function render(AbstractInline $inline, ElementRendererInterface $htmlRenderer)
    {
        if ( ! ($inline instanceof InlineContainer)) {
            throw new \InvalidArgumentException('Incompatible inline type: '.get_class($inline));
        }

        $attrs = [];
        foreach ($inline->getData('attributes', []) as $key => $value) {
            $attrs[$key] = $htmlRenderer->escape($value, true);
        }

        return $htmlRenderer->renderInlines($inline->children());
    }
}
