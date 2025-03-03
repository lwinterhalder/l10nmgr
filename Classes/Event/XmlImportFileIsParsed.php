<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Event;

class XmlImportFileIsParsed
{
    private array $errorMessages;

    private array $xmlNodes;

    public function __construct(array $xmlNodes, array $errorMessages)
    {
        $this->errorMessages = $errorMessages;
        $this->xmlNodes = $xmlNodes;
    }

    public function addErrorMessage(string $message): void
    {
        $this->errorMessages[] = $message;
    }

    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    public function getXmlNodes(): array
    {
        return $this->xmlNodes;
    }

    public function setXmlNodes(array $xmlNodes): void
    {
        $this->xmlNodes = $xmlNodes;
    }
}
