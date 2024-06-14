<?php

use Localizationteam\L10nmgr\Utility\L10nmgrExtensionManagementUtility;

defined('TYPO3') || die();

L10nmgrExtensionManagementUtility::makeTranslationsRestrictable(
    'core',
    'tt_content'
);
