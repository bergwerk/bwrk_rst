<?php

namespace BERGWERK\BwrkRst\FlexForm;

use BERGWERK\BwrkRst\Bootstrap;
use BERGWERK\BwrkUtility\Utility\Tca\Configuration;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;

/**
 * Class Pi2
 * @package BERGWERK\BwrkRst\FlexForm
 */
class Pi2 extends FlexForm
{
    /**
     * Pi2 constructor.
     */
    public function __construct()
    {
        $configuration = new Configuration();
        $configuration->setExt(Bootstrap::$_extKey);
        $configuration->setPlugin('Pi2');

        $this->init($configuration);
    }

    /**
     * @return string
     */
    public function render()
    {
        $this->addSheet('general', array(
            $this->addSysFileReference('rst', null, null, null, null, 'rst')
        ));

        $xml = $this->renderFlexForm();

        return $xml;
    }
}