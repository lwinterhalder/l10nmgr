<?php

declare(strict_types=1);

/**
 * Definitions for modules provided by EXT:l10nmgr
 * @see https://docs.typo3.org/m/typo3/reference-coreapi/main/en-us/ExtensionArchitecture/HowTo/BackendModule/ModuleConfiguration.html
 */

use Localizationteam\L10nmgr\Controller\ConfigurationModuleController;
use Localizationteam\L10nmgr\Controller\LocalizationModuleController;

$lll = 'LLL:EXT:l10nmgr/Resources/Private/Language/';

return [
    'l10nmgr' => [
        'labels' => $lll . 'Modules/LocalizationManager/locallang_mod.xlf',
        'iconIdentifier' => 'module-l10nmgr',
        'position' => ['after' => 'web'],
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
    ],
    'l10nmgr_configuration' => [
        'parent' => 'l10nmgr',
        'access' => 'user', // user, admin or systemMaintainer
        'path' => '/module/l10nmgr/configuration',
        'iconIdentifier' => 'module-configuration',
        'labels' => $lll . 'Modules/Configuration/locallang_mod.xlf',
        'navigationComponent' => '@typo3/backend/page-tree/page-tree-element',
        'routes' => [
            '_default' => [
                'target' => ConfigurationModuleController::class . '::handleRequest',
            ],
            'localize' => [
                'path' => '/localization',
                'target' => LocalizationModuleController::class . '::handleRequest',
            ],
        ],
    ],
];
