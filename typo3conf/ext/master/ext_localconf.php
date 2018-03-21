<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
    $_EXTKEY,
    'constants',
    \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('EXT:' . $_EXTKEY . 'Resources/Private/Typoscript/constants.txt')
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
    $_EXTKEY,
    'setup',
    \TYPO3\CMS\Core\Utility\GeneralUtility::getUrl('EXT:' . $_EXTKEY . 'Resources/Private/Typoscript/setup.txt')
);



$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon('iconWell', \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class, ['source' => 'EXT:master/Resources/Public/Images/WizardIcons/iconWell.svg']);


$fcecropsettings = [
    'title' => 'Default',
    'cropArea' => [
        'x' => 0.0,
        'y' => 0.0,
        'width' => 1.0,
        'height' => 1.0,
    ],
    'focusArea' => [
        'x' => 1 / 2,
        'y' => 1 / 2,
        'width' => 0.1,
        'height' => 0.1,
    ]
];

$snippetsCropSettings = $fcecropsettings;
$snippetsCropSettings['allowedAspectRatios'] = [
    'snippetsmaster' => [
        'title' => 'Snippets ratio',
        'value' => 1.375
    ],
];
$snippetsCropSettings['selectedRatio'] = 'snippetsmaster';

$GLOBALS['TCA']['tt_content']['types']['fluidcontent_content']['columnsOverrides']['image']['config']['overrideChildTca']['columns']['crop']['config']['cropVariants']['snippetsmaster'] = $snippetsCropSettings;


?>