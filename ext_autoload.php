<?php

$extensionPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('bwrk_address');
$vendorPath = $extensionPath . 'Vendor/';

$rstPath = $vendorPath . 'Gregwar/RST/';

return array(
    'BERGWERK\BwrkRst\Bootstrap' => $extensionPath . 'Classes/Bootstrap.php',
    'Gregwar\RST\HTML\Nodes\CodeNode' => $extensionPath . 'Classes/Utility/RST/Nodes/CodeNode.php',
    'Gregwar\RST\Parser' => $rstPath . 'Parser.php',
    'Gregwar\RST\HTML\Kernel' => $rstPath . 'HTML/Kernel.php'
);