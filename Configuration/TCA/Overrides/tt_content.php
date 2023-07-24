<?php

defined('TYPO3') || die();

use Localizationteam\L10nmgr\LanguageRestriction\LanguageRestrictionRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

ExtensionManagementUtility::addTCAcolumns('pages', [
    'l10nmgr_language_restriction' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:l10nmgr/Resources/Private/Language/locallang_db.xlf:sys_language.restrictions',
        'config' => [
            'type' => 'select',
            'renderType' => 'selectMultipleSideBySide',
            'itemsProcFunc' => LanguageRestrictionRegistry::class . '->populateAvailableSiteLanguages',
            'maxitems' => 9999,
        ],
    ],
]);

ExtensionManagementUtility::addToAllTCAtypes('tt_content', 'l10nmgr_language_restriction', '', 'after:sys_language_uid');
