<?php

namespace BERGWERK\BwrkRst\FlexForm;

use BERGWERK\BwrkRst\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

/**
 * Class Pi3
 * @package BERGWERK\BwrkRst\FlexForm
 */
class Pi3 extends FlexForm
{
    /**
     * Pi3 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi3');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addInputField('rst')
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}