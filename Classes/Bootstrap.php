<?php
namespace BERGWERK\BwrkRst;

use BERGWERK\BwrkRst\FlexForm\Pi1;
use BERGWERK\BwrkRst\FlexForm\Pi2;
use BERGWERK\BwrkRst\FlexForm\Pi3;
use BERGWERK\BwrkUtility\Utility\Tca\FlexForm;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

/**
 * Class Bootstrap
 * @package BERGWERK\BwrkAddress
 */
class Bootstrap
{
    /**
     * @var string
     */
    static public $_extKey = 'bwrk_rst';

    /**
     *
     */
    static public function extTables()
    {
        // Register Plugins
        self::registerPlugin('Pi1', 'reStructuredText (content)', Pi1::class);
        self::registerPlugin('Pi2', 'reStructuredText (file)', Pi2::class);
        self::registerPlugin('Pi3', 'reStructuredText (external)', Pi3::class);
    }

    /**
     *
     */
    static public function extLocalconf()
    {
        // Configure Plugins
        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi1',
            array('Rst' => 'content'),
            array('Rst' => 'content')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi2',
            array('Rst' => 'file'),
            array('Rst' => 'file')
        );

        ExtensionUtility::configurePlugin('BERGWERK.' . self::$_extKey, 'Pi3',
            array('Rst' => 'external'),
            array('Rst' => 'external')
        );
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManager
     */
    static public function getObjectManager()
    {
        return GeneralUtility::makeInstance(
            ObjectManager::class
        );
    }

    /**
     * @return int
     */
    static public function getCurrentLanguage()
    {
        return (int)$GLOBALS['TSFE']->sys_language_uid;
    }

    /**
     * @param $pluginName
     * @param $pluginTitle
     * @param null $flexFormClass
     */
    static protected function registerPlugin($pluginName, $pluginTitle, $flexFormClass = null)
    {
        ExtensionUtility::registerPlugin('BERGWERK.' . self::$_extKey, $pluginName, $pluginTitle);

        if (empty($flexFormClass))
        {
            return;
        }

        /** @var FlexForm $flexFormInstance */
        $flexFormInstance = new $flexFormClass();

        if (!$flexFormInstance instanceof FlexForm)
        {
            return;
        }

        $flexForm = $flexFormInstance->render();

        $pluginSignature = strtolower(GeneralUtility::underscoredToUpperCamelCase(self::$_extKey)) . '_' . strtolower($pluginName);

        $GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

        ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, $flexForm);
    }
}