<?php

namespace BERGWERK\BwrkRst\Controller;

use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use Gregwar\RST\Parser;
use BERGWERK\BwrkRst\Utility\RST\Directives\Figure;

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
        $rst = $this->settings['rst'];
        $baseUrl = $this->settings['base_url'];

        return '' . $this->parseRst($rst, $baseUrl);
    }

    public function fileAction()
    {
        $uid = $this->contentObject->data['uid'];
        $fileRepository = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Resource\\FileRepository');
        $fileObjects = $fileRepository->findByRelation('tt_content', 'rst', $uid);

        $html = '';

        /** @var FileReference $fileObject */
        foreach ($fileObjects as $fileObject)
        {
            $fileName = $fileObject->getName();
            $fileFullPath = $fileObject->getPublicUrl();
            $filePath = str_replace($fileName, '', $fileFullPath);

            $fileContents = file_get_contents($fileFullPath);

            $html .= $this->parseRst($fileContents, $filePath);
        }

        return $html;
    }

    public function externalAction()
    {
        $url = $this->settings['rst'];

        $urlSplit = explode('/', $url);

        $fileName = $urlSplit[count($urlSplit) - 1];

        $filePath = str_replace($fileName, '', $url);

        $fileContents = file_get_contents($url);

        return '' . $this->parseRst($fileContents, $filePath);
    }

    protected function parseRst($rst, $baseUrl)
    {
        $parser = new Parser();
        $parser->registerDirective(new Figure($baseUrl));
        return $parser->parse($rst);
    }
}