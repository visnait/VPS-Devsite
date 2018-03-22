<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'DRAKE.'.$_EXTKEY,
    'Obd',
    [
        'Obd' => 'list,add',
    ],
    [
        'Obd' => 'list,add',
    ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'DRAKE.'.$_EXTKEY,
    'Terms',
    [
        'Terms' => 'list,add,import',
    ],
    [
        'Terms' => 'list,add,import',
    ]
);

