<?php

namespace OuterEdge\ContainerGroup\View\Layout\Data;

use Magento\Framework\View\Layout\Data\Structure as MagentoStructure;

class Structure extends MagentoStructure
{
    public function setGroupElementBefore($childId, $groupName, $before)
    {
        $parentId = $this->getParentId($childId);
        $group = $this->_elements[$parentId][self::GROUPS][$groupName];

        $sortedGroup = [];
        foreach ($group as $elementName) {
            if ($elementName === $before) {
                $sortedGroup[$childId] = $childId;
            }
            $sortedGroup[$elementName] = $elementName;
        }

        if (count($sortedGroup) === count($group)) {
            $this->_elements[$parentId][self::GROUPS][$groupName] = $sortedGroup;
        }
    }

    public function setGroupElementAfter($childId, $groupName, $after)
    {
        $parentId = $this->getParentId($childId);
        $group = $this->_elements[$parentId][self::GROUPS][$groupName];

        $sortedGroup = [];
        foreach ($group as $elementName) {
            $sortedGroup[$elementName] = $elementName;
            if ($elementName === $after) {
                $sortedGroup[$childId] = $childId;
            }
        }

        if (count($sortedGroup) === count($group)) {
            $this->_elements[$parentId][self::GROUPS][$groupName] = $sortedGroup;
        }
    }
}
