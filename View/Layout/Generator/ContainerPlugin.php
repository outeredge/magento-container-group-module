<?php

namespace OuterEdge\ContainerGroup\View\Layout\Generator;

use Magento\Framework\View\Layout\Generator\Container;

class ContainerPlugin
{
    const CONTAINER_OPT_GROUP = 'group';

    public function beforeGenerateContainer(Container $subject, $structure, $elementName, $options)
    {
        if (!empty($options[self::CONTAINER_OPT_GROUP])) {
            $structure->addToParentGroup($elementName, $options[self::CONTAINER_OPT_GROUP]);
        }
        return null;
    }
}
