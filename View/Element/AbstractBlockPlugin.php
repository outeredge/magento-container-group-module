<?php

namespace OuterEdge\ContainerGroup\View\Element;

use Magento\Framework\View\Element\AbstractBlock;

class AbstractBlockPlugin
{
    public function aroundGetChildData(AbstractBlock $subject, callable $proceed, $alias, $key = '')
    {
        $returnValue = $proceed($alias, $key);

        if (null === $returnValue) {
            $layout = $subject->getLayout();
            if (!$layout) {
                return false;
            }

            $name = $layout->getChildName($subject->getNameInLayout(), $alias);
            if ($layout->isContainer($name)) {
                $returnValue = $layout->getElementProperty($name, $key);
            }
        }

        return $returnValue;
    }
}