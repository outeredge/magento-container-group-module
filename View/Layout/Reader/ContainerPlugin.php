<?php

namespace OuterEdge\ContainerGroup\View\Layout\Reader;

use Magento\Framework\View\Layout\Reader\Container;

class ContainerPlugin
{
    const CONTAINER_OPT_GROUP = 'group';
    const CONTAINER_OPT_TITLE = 'title';

    public function aroundInterpret(Container $subject, callable $proceed, $readerContext, $currentElement)
    {
        $returnValue = $proceed($readerContext, $currentElement);

        if ($returnValue) {
            $scheduledStructure = $readerContext->getScheduledStructure();

            switch ($currentElement->getName()) {
                case $subject::TYPE_CONTAINER:
                case $subject::TYPE_REFERENCE_CONTAINER:
                    $this->setContainerAttributes($scheduledStructure, $currentElement);
                    break;
            }
        }

        return $returnValue;
    }

    protected function setContainerAttributes($scheduledStructure, $currentElement)
    {
        $containerName = $currentElement->getAttribute('name');
        $elementData = $scheduledStructure->getStructureElementData($containerName);

        if (isset($elementData['attributes'])) {
            $elementData['attributes'][self::CONTAINER_OPT_GROUP] = (string)$currentElement[self::CONTAINER_OPT_GROUP];
            $elementData['attributes'][self::CONTAINER_OPT_TITLE] = (string)$currentElement[self::CONTAINER_OPT_TITLE];
        } else {
            $elementData['attributes'] = [
                self::CONTAINER_OPT_GROUP => (string)$currentElement[self::CONTAINER_OPT_GROUP],
                self::CONTAINER_OPT_TITLE => (string)$currentElement[self::CONTAINER_OPT_TITLE]
            ];
        }

        $scheduledStructure->setStructureElementData($containerName, $elementData);
    }
}
