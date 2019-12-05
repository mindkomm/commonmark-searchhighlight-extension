<?php

namespace Mind\CommonMark\SearchHighlightExtension;

use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Inline\Element\Text;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\InlineContainer;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\Span;

/**
 * Class SearchHighlightProcessor
 *
 * @package Mind\CommonMark\SearchHighlightExtension
 */
class SearchHighlightProcessor
{
    /**
	 * Search String.
	 *
	 * @var string
	 */
	private $searchstring;

    public function __construct($searchstring) {
    	$this->searchstring = $searchstring;
    }

    /**
     * @return void
     */
    public function onDocumentParsed(DocumentParsedEvent $event)
    {
	    $document = $event->getDocument();
	    $walker   = $document->walker();

        while ($nodeEvent = $walker->next()) {
            $node = $nodeEvent->getNode();

            if ( ! $nodeEvent->isEntering() || $node->isContainer()) {
                continue;
            }

            if ( ! method_exists($node, 'getContent') || empty($node->getContent())) {
                continue;
            }

            $content = $node->getContent();

            if (preg_match_all("/($this->searchstring)/im", $content, $matches, PREG_SET_ORDER)) {
                $partials = preg_split("/($this->searchstring)/im", $content);

                $container  = new InlineContainer();
                $matchcount = count($matches);

                foreach ($partials as $key => $partial) {
                    if ( ! empty($partial)) {
                        $container->appendChild(new Text($partial));
                    }

                    if ($key > ($matchcount - 1)) {
                        continue;
                    }

                    $span = new Span();

                    $span->data['attributes']['class'] = 'search-highlight';
                    $span->appendChild(new Text($matches[$key][1]));

                    $container->appendChild($span);
                }

                $node->replaceWith($container);
            }
        }
    }
}
