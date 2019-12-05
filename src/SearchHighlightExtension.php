<?php

namespace Mind\CommonMark\SearchHighlightExtension;

use League\CommonMark\ConfigurableEnvironmentInterface;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\ExtensionInterface;
use Mind\CommonMark\SearchHighlightExtension\Inline\Renderer\InlineContainerRenderer;
use Mind\CommonMark\SearchHighlightExtension\Inline\Renderer\SpanRenderer;

/**
 * Class SearchHighlightExtension
 *
 * @package Mind\CommonMark\SearchHighlightExtension
 */
class SearchHighlightExtension implements ExtensionInterface
{
	/**
	 * Search String.
	 *
	 * @var string
	 */
	private $searchstring;

	public function __construct($searchstring = '')
	{
		$this->searchstring = $searchstring;
	}

	public function register(ConfigurableEnvironmentInterface $environment)
    {
    	$searchHighlightProcessor = new SearchHighlightProcessor($this->searchstring);

		$environment
			->addEventListener( DocumentParsedEvent::class, [$searchHighlightProcessor, 'onDocumentParsed'] )
            ->addInlineRenderer(__NAMESPACE__.'\\Inline\Element\Span', new SpanRenderer(), 0)
            ->addInlineRenderer(__NAMESPACE__.'\\Inline\Element\InlineContainer', new InlineContainerRenderer(), 0)
        ;
    }
}
