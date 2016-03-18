<?php

namespace BERGWERK\BwrkRst\Utility\RST\Directives;

use BERGWERK\BwrkRst\Utility\RST\Nodes\FigureNode;
use Gregwar\RST\HTML\Nodes\CodeNode;
use Gregwar\RST\Parser;
use Gregwar\RST\Directive;

/**
 * Renders a figure, example:
 *
 * .. figure:: bergwerk_kumpel_dm_01_quadrat.jpg
 *     :alt: Change the backend preview
 *
 *     Default output and fitted preview
 */
class Figure extends Directive
{
    protected $baseUrl;

    public function __construct($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    public function getName()
    {
        return 'figure';
    }

    /**
     * @param Parser $parser
     * @param CodeNode $node
     * @param string $variable
     * @param string $data
     * @param array $options
     */
    public function process(Parser $parser, $node, $variable, $data, array $options)
    {
        $figureNode = new FigureNode(array());
        $figureNode->setLanguage($node->getLanguage());
        $figureNode->setValue($node->getValue());

        $options['url'] = $this->baseUrl . $data;

        if (file_exists($options['url']))
        {
            $figureNode->setData($options);

            $parser->getDocument()->addNode($figureNode);
        }
    }

    public function wantCode()
    {
        return true;
    }
}
