<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
if (ExtensionManagementUtility::isLoaded('static_info_tables')) {
    ExtensionManagementUtility::addTCAcolumns(
        'tx_l10nmgr_cfg',
        [
            'sourceLangStaticId' => [
                'exclude' => 1,
                'label' => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:tx_l10nmgr_cfg.sourceLang',
                'config' => [
                    'type' => 'select',
                    'renderType' => 'selectSingle',
                    'items' => [
                        ['', 0],
                    ],
                    'foreign_table' => 'static_languages',
                    'foreign_table_where' => 'AND static_languages.pid=0 ORDER BY static_languages.lg_name_en',
                    'size' => 1,
                    'minitems' => 0,
                    'maxitems' => 1,
                ],
            ],
        ]
    );
    ExtensionManagementUtility::addToAllTCAtypes('tx_l10nmgr_cfg', 'sourceLangStaticId', '', 'after:pages');
}
