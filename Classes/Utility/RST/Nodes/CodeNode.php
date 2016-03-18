<?php

namespace BERGWERK\BwrkRst\Utility\RST\Nodes;

use Gregwar\RST\Nodes\CodeNode as Base;

class CodeNode extends Base
{
    public function render()
    {
        return "<pre><code class=\"language-".$this->language."\">".htmlspecialchars($this->value)."</code></pre>";
    }
}
