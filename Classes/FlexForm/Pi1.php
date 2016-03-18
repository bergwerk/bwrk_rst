<?php

namespace BERGWERK\BwrkRst\FlexForm;

use BERGWERK\BwrkRst\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

/**
 * Class Pi1
 * @package BERGWERK\BwrkRst\FlexForm
 */
class Pi1 extends FlexForm
{
    /**
     * Pi1 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi1');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addTextField('rst', false),
            $this->addInputField('base_url')
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}