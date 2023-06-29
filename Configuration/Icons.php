<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

$path = 'EXT:l10nmgr/Resources/Public/Icons/';

return [
    'extensionIcon' => [
        'provider' => BitmapIconProvider::class,
        'source' => $path . 'Extension.gif',
    ],
    'module-configuration' => [
        'provider' => BitmapIconProvider::class,
        'source' => $path . 'icon_tx_l10nmgr_cfg.gif',
    ],
    'module-priorities' => [
        'provider' => BitmapIconProvider::class,
        'source' => $path . 'icon_tx_l10nmgr_priorities.gif',
    ],
    'module-1' => [
        'provider' => BitmapIconProvider::class,
        'source' => $path . 'module1_icon.gif',
    ],
    'module-2' => [
        'provider' => BitmapIconProvider::class,
        'source' => $path . 'module2_icon.gif',
    ],
    'module-l10nmgr' => [
        'provider' => SvgIconProvider::class,
        'source' => $path . 'module-l10nmgr.svg',
    ],
    'module-tasks' => [
        'provider' => SvgIconProvider::class,
        'source' => $path . 'module-l10nmgr-tasks.svg',
    ],
];
