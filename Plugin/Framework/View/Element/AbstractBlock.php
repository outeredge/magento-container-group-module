<?php

namespace OuterEdge\ContainerGroup\Plugin\Framework\View\Element;

use Magento\Framework\View\Element\AbstractBlock as ElementAbstractBlock;

class AbstractBlock
{
    public function aroundGetChildData(ElementAbstractBlock $subject, callable $proceed, $alias, $key = '')
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
