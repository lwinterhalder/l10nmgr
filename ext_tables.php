<?php

use Localizationteam\L10nmgr\Controller\ConfigurationManager;
use Localizationteam\L10nmgr\Controller\TranslationTasks;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

/**
 * Registers a Backend Module
 */
ExtensionManagementUtility::addModule(
    'web',
    'ConfigurationManager',
    '',
    '',
    [
        'routeTarget' => ConfigurationManager::class . '::mainAction',
        'access'      => 'user,group',
        'name'        => 'web_ConfigurationManager',
        'icon'        => 'EXT:l10nmgr/Resources/Public/Icons/module-l10nmgr.svg',
        'labels'      => 'LLL:EXT:l10nmgr/Resources/Private/Language/Modules/ConfigurationManager/locallang_mod.xlf',
    ]
);

/**
 * Registers a Backend Module
 */
ExtensionManagementUtility::addModule(
    'LocalizationManager',
    '',
    '',
    '',
    [
        'routeTarget' => \Localizationteam\L10nmgr\Controller\LocalizationManager::class . '::mainAction',
        'access'      => 'user,group',
        'name'        => 'LocalizationManager',
        'icon'        => 'EXT:l10nmgr/Resources/Public/Icons/module-l10nmgr.svg',
        'labels'      => 'LLL:EXT:l10nmgr/Resources/Private/Language/Modules/ConfigurationManager/locallang_mod.xlf',
    ]
);

/**
 * Registers a Backend Module
 */
/*ExtensionManagementUtility::addModule(
    'user',
    'txl10nmgrM2',
    'top',
    '',
    [
        'routeTarget' => \Localizationteam\L10nmgr\Controller\Module2::class . '::main',
        'access'      => 'user,group',
        'name'        => 'user_txl10nmgrM2',
        'icon'        => 'EXT:l10nmgr/Resources/Public/Icons/module-l10nmgr.svg',
        'labels'      => 'LLL:EXT:l10nmgr/Resources/Private/Language/Modules/Module2/locallang_mod.xlf',
    ]
);*/

/**
 * Registers a Backend Module
 */
ExtensionManagementUtility::addModule(
    'LocalizationManager',
    'TranslationTasks',
    '',
    '',
    [
        'routeTarget' => TranslationTasks::class . '::mainAction',
        'access'      => 'user,group',
        'name'        => 'LocalizationManager_TranslationTasks',
        'icon'        => 'EXT:l10nmgr/Resources/Public/Icons/module-l10nmgr-tasks.svg',
        'labels'      => 'LLL:EXT:l10nmgr/Resources/Private/Language/Modules/Module2/locallang_mod.xlf',
    ]
);

// Add context sensitive help (csh) for the Scheduler tasks
ExtensionManagementUtility::addLLrefForTCAdescr(
    '_tasks_txl10nmgr',
    'EXT:l10nmgr/Resources/Private/Language/Task/locallang_csh_tasks.xlf'
);

ExtensionManagementUtility::allowTableOnStandardPages('tx_l10nmgr_cfg');
ExtensionManagementUtility::addLLrefForTCAdescr(
    'tx_l10nmgr_cfg',
    'EXT:l10nmgr/Resources/Private/Language/locallang_csh_l10nmgr.xlf'
);

// Example for disabling localization of specific fields in tables like tt_content
// Add as many fields as you need
//$TCA['tt_content']['columns']['imagecaption']['l10n_mode'] = 'exclude';
//$TCA['tt_content']['columns']['image']['l10n_mode'] = 'prefixLangTitle';
//$TCA['tt_content']['columns']['image']['l10n_display'] = 'defaultAsReadonly';
