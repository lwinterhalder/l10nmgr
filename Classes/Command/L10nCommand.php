<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Command;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the  GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

use Localizationteam\L10nmgr\Model\Dto\EmConfiguration;
use Localizationteam\L10nmgr\Traits\BackendUserTrait;
use Symfony\Component\Console\Command\Command;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Class L10nCommand
 */
class L10nCommand extends Command
{
    use BackendUserTrait;

    /**
     * @var EmConfiguration
     */
    protected EmConfiguration $emConfiguration;

    /**
     * @var LanguageService
     */
    private LanguageService $languageService;

    /**
     * The function loadExtConf loads the extension configuration.
     * Check for deprecated configuration throws false positive in extension scanner.
     *
     * @return EmConfiguration
     */
    protected function getExtConf(): EmConfiguration
    {
        $this->emConfiguration = GeneralUtility::makeInstance(EmConfiguration::class);

        return $this->emConfiguration;
    }

    /**
     * getter for LanguageService object
     *
     * @return LanguageService $languageService
     */
    protected function getLanguageService(): LanguageService
    {
        $this->languageService = GeneralUtility::makeInstance(LanguageService::class);
        $fileRef = 'EXT:l10nmgr/Resources/Private/Language/Cli/locallang.xlf';
        $this->languageService->includeLLFile($fileRef);
        // @extensionScannerIgnoreLine
        $this->languageService->init('');

        return $this->languageService;
    }
}
