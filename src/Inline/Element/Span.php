<?php

namespace Mind\CommonMark\SearchHighlightExtension\Inline\Element;

use League\CommonMark\Inline\Element\AbstractInline;

/**
 * Class Span
 *
 * @package Mind\CommonMark\SearchHighlightExtension\Inline\Element
 */
class Span extends AbstractInline
{
	/**
     * @return bool
     */
	public function isContainer(): bool
	{
		return true;
	}
}
