<?php
namespace WeltPixel\FrameworkEssential\Module;

class ModuleList extends \Magento\Framework\Module\ModuleList
{
    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        $result = parent::getAll();
        $moduleName = 'WeltPixel_FrameworkEssential';

        $frameworkModule = $result[$moduleName];
        unset($result[$moduleName]);
        $result[$moduleName] = $frameworkModule;

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getNames()
    {
        $result = parent::getNames();

        foreach ($result as $key => $value) {
            if ($value == 'WeltPixel_FrameworkEssential') {
                unset($result[$key]);
            }
        }
        $result[] = 'WeltPixel_FrameworkEssential';

        return $result;
    }
}
