<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use Localizationteam\L10nmgr\Constants;
use Localizationteam\L10nmgr\Utility\L10nmgrExtensionManagementUtility;

ExtensionManagementUtility::addTCAcolumns('pages', [
    'l10nmgr_configuration' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_DEFAULT,
                    1 => Constants::L10NMGR_CONFIGURATION_DEFAULT,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_NONE,
                    1 => Constants::L10NMGR_CONFIGURATION_NONE,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_EXCLUDE,
                    1 => Constants::L10NMGR_CONFIGURATION_EXCLUDE,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_INCLUDE,
                    1 => Constants::L10NMGR_CONFIGURATION_INCLUDE,
                ],
            ],
            'default' => Constants::L10NMGR_CONFIGURATION_DEFAULT,
        ],
    ],
    'l10nmgr_configuration_next_level' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration_next_level',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectSingle',
            'items' => [
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_DEFAULT,
                    1 => Constants::L10NMGR_CONFIGURATION_DEFAULT,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_NONE,
                    1 => Constants::L10NMGR_CONFIGURATION_NONE,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_EXCLUDE,
                    1 => Constants::L10NMGR_CONFIGURATION_EXCLUDE,
                ],
                [
                    0 => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.l10nmgr_configuration.I.' . Constants::L10NMGR_CONFIGURATION_INCLUDE,
                    1 => Constants::L10NMGR_CONFIGURATION_INCLUDE,
                ],
            ],
            'default' => Constants::L10NMGR_CONFIGURATION_DEFAULT,
        ],
    ],
]);

ExtensionManagementUtility::addFieldsToPalette(
    'pages',
    'l10nmgr_configuration',
    'l10nmgr_configuration,l10nmgr_configuration_next_level'
);
ExtensionManagementUtility::addToAllTCAtypes(
    'pages',
    '--palette--;LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:pages.palettes.l10nmgr_configuration;l10nmgr_configuration',
    '',
    'after:l18n_cfg'
);

L10nmgrExtensionManagementUtility::makeTranslationsRestrictable(
    'core',
    'pages'
);
