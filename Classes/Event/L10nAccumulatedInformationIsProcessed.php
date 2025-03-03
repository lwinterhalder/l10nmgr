<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Event;

class L10nAccumulatedInformationIsProcessed
{
    private array $accumulatedInformation;

    private array $l10nConfiguration;

    public function __construct(array $accumulatedInformation, array $l10nConfiguration)
    {
        $this->accumulatedInformation = $accumulatedInformation;
        $this->l10nConfiguration = $l10nConfiguration;
    }

    public function getAccumulatedInformation(): array
    {
        return $this->accumulatedInformation;
    }

    public function setAccumulatedInformation(array $accumulatedInformation): void
    {
        $this->accumulatedInformation = $accumulatedInformation;
    }

    public function getL10nConfiguration(): array
    {
        return $this->l10nConfiguration;
    }
}
