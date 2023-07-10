<?php

declare(strict_types=1);

use Localizationteam\L10nmgr\Controller\LocalizationManager;

return [
    'download_setting' => [
        'path' => '/downloadSetting',
        'target' => LocalizationManager::class . '::downloadSetting',
    ],
];
