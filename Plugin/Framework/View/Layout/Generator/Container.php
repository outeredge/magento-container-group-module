<?php

namespace OuterEdge\ContainerGroup\Plugin\Framework\View\Layout\Generator;

use Magento\Framework\View\Layout\Generator\Container as GeneratorContainer;

class Container
{
    const CONTAINER_OPT_GROUP  = 'group';
    const CONTAINER_OPT_BEFORE = 'before';
    const CONTAINER_OPT_AFTER  = 'after';

    public function beforeGenerateContainer(GeneratorContainer $subject, $structure, $elementName, $options)
    {
        if (!empty($options[self::CONTAINER_OPT_GROUP])) {
            $structure->addToParentGroup($elementName, $options[self::CONTAINER_OPT_GROUP]);

            if (!empty($options[self::CONTAINER_OPT_BEFORE])) {
                $structure->setGroupElementBefore($elementName, $options[self::CONTAINER_OPT_GROUP], $options[self::CONTAINER_OPT_BEFORE]);
            } else if (!empty($options[self::CONTAINER_OPT_AFTER])) {
                $structure->setGroupElementAfter($elementName, $options[self::CONTAINER_OPT_GROUP], $options[self::CONTAINER_OPT_AFTER]);
            }
        }
        return null;
    }
}
