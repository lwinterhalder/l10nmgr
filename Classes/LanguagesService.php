<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr;

use Localizationteam\L10nmgr\Traits\BackendUserTrait;
use TYPO3\CMS\Core\Site\Entity\SiteLanguage;
use TYPO3\CMS\Core\Site\SiteFinder;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class LanguagesService
{
    use BackendUserTrait;

    /**
     * Provides a list of all languages available for ALL sites.
     * In case no site configuration can be found in the system,
     * a fallback is used to add at least the default language.
     */
    public function getAll(): array
    {
        $allLanguages = [];
        foreach (self::siteFinder()->getAllSites() as $site) {
            foreach ($site->getAllLanguages() as $language) {
                // @extensionScannerIgnoreLine
                $languageId = $language->getLanguageId();
                if (isset($allLanguages[$languageId])) {
                    // Language already provided by another site, just add the label separately
                    $allLanguages[$languageId]['label'] .= ', ' . $language->getTitle() . ' [Site: ' . $site->getIdentifier() . ']';
                    continue;
                }
                $allLanguages[$languageId] = [
                    'label' => $language->getTitle() . ' [Site: ' . $site->getIdentifier() . ']',
                    'value' => $languageId,
                    'icon' => $language->getFlagIdentifier(),
                ];
            }
        }

        return $allLanguages;
    }

    public function getDefault(int $pageId): SiteLanguage
    {
        return self::siteFinder()->getSiteByPageId($pageId)->getDefaultLanguage();
    }

    public static function siteFinder(): SiteFinder
    {
        return GeneralUtility::makeInstance(SiteFinder::class);
    }
}
