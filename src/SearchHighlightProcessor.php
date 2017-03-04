<?php

namespace Mind\CommonMark\SearchHighlightExtension;

use League\CommonMark\Block\Element\Document;
use League\CommonMark\DocumentProcessorInterface;
use League\CommonMark\Inline\Element\Text;
use League\CommonMark\Util\Configuration;
use League\CommonMark\Util\ConfigurationAwareInterface;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\InlineContainer;
use Mind\CommonMark\SearchHighlightExtension\Inline\Element\Span;

/**
 * Class SearchHighlightProcessor
 *
 * @package Mind\CommonMark\SearchHighlightExtension
 */
class SearchHighlightProcessor implements DocumentProcessorInterface, ConfigurationAwareInterface
{
    /**
     * @var Configuration
     */
    private $config;

    /**
     * @param Configuration $configuration
     */
    public function setConfiguration(Configuration $configuration)
    {
        $this->config = $configuration;
    }

    /**
     * @param Document $document
     *
     * @return void
     */
    public function processDocument(Document $document)
    {
        $walker = $document->walker();

        while ($event = $walker->next()) {
            $node = $event->getNode();

            if ( ! $event->isEntering() || $node->isContainer()) {
                continue;
            }

            if ( ! method_exists($node, 'getContent') || empty($node->getContent())) {
                continue;
            }

            $content      = $node->getContent();
            $searchstring = $this->config->getConfig('searchstring');

            if (preg_match_all("/($searchstring)/im", $content, $matches, PREG_SET_ORDER)) {
                $partials = preg_split("/($searchstring)/im", $content);

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
