<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Traits;

use TYPO3\CMS\Core\Localization\LanguageService;

trait LanguageServiceTrait
{
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
