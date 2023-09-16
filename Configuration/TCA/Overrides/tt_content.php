<?php

defined('TYPO3') || die();

use Localizationteam\L10nmgr\LanguageRestriction\LanguageRestrictionRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

\Localizationteam\L10nmgr\Utility\L10nmgrExtensionManagementUtility::makeTranslationsRestrictable(
    'core',
    'tt_content'
);
