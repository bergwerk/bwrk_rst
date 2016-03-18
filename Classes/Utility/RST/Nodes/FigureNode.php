<?php

namespace BERGWERK\BwrkRst\Utility\RST\Nodes;

use Gregwar\RST\Nodes\CodeNode as Base;

class FigureNode extends Base
{
    protected $data;

    public function setData($data)
    {
        $this->data = $data;
    }

    public function __construct(array $lines)
    {

    }

    public function render()
    {
        $html = '<img src="' . $this->data['url'] . '"';

        if (isset($this->data['alt']))
        {
            $html .= ' alt="' . $this->data['alt'] . '"';
        }

        $html .= '/>';

        return $html;
    }
}
