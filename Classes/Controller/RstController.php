<?php

namespace BERGWERK\BwrkRst\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

/**
 * Class RstController
 * @package BERGWERK\BwrkRst\Controller
 */
class RstController extends ActionController
{
    protected $contentObject;

    protected function initializeAction()
    {
        $this->contentObject = $this->configurationManager->getContentObject();
    }

    public function contentAction()
    {
        return 'CONTENT';
    }

    public function fileAction()
    {
        return 'FILE';
    }

    public function externalAction()
    {
        return 'EXTERNAL';
    }
}