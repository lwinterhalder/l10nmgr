<?php

declare(strict_types=1);

namespace Localizationteam\L10nmgr\Event;

class XmlImportFileIsParsed
{
    /**
     * @var array
     */
    private array $errorMessages;

    /**
     * @var array
     */
    private array $xmlNodes;

    public function __construct(array $xmlNodes, array $errorMessages)
    {
        $this->errorMessages = $errorMessages;
        $this->xmlNodes = $xmlNodes;
    }

    /**
     * @param string $message
     */
    public function addErrorMessage(string $message): void
    {
        $this->errorMessages[] = $message;
    }

    /**
     * @return array
     */
    public function getErrorMessages(): array
    {
        return $this->errorMessages;
    }

    /**
     * @return array
     */
    public function getXmlNodes(): array
    {
        return $this->xmlNodes;
    }

    /**
     * @param array $xmlNodes
     */
    public function setXmlNodes(array $xmlNodes): void
    {
        $this->xmlNodes = $xmlNodes;
    }
}
