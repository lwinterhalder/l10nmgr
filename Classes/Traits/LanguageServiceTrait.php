<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Traits;

use TYPO3\CMS\Core\Localization\LanguageService;

trait LanguageServiceTrait
{
    /**
     * Returns the Language Service
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
