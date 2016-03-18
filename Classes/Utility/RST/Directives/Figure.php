<?php

namespace BERGWERK\BwrkRst\Utility\RST\Directives;

use Gregwar\RST\Parser;
use Gregwar\RST\Directive;

use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

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

    public function process(Parser $parser, $node, $variable, $data, array $options)
    {
        DebuggerUtility::var_dump(array(
            'data' => $data,
            'options' => $options,
            'baseUrl' => $this->baseUrl
        ));
    }
}
