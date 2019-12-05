<?php

namespace Mind\CommonMark\SearchHighlightExtension\Inline\Element;

use League\CommonMark\Inline\Element\AbstractInline;

/**
 * Class InlineContainer
 *
 * @package Mind\CommonMark\SearchHighlightExtension\Inline\Element
 */
class InlineContainer extends AbstractInline
{
	/**
     * @return bool
     */
	public function isContainer(): bool
	{
		return true;
	}
}
