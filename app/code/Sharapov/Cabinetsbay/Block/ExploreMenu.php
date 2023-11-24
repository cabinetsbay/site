<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 02/10/2019
 * Time: 20:40
 */

namespace Sharapov\Cabinetsbay\Block;

class ExploreMenu extends \Magento\Framework\View\Element\Template
{
    public function getExploreCategories() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $subCategory = $objectManager->create('Magento\Catalog\Model\Category')->load(2);

        $collection = $subCategory->getCollection();
        /* @var $collection \Magento\Catalog\Model\ResourceModel\Category\Collection */
        $collection->addAttributeToSelect(
            'category_id'
        )->addAttributeToSelect(
            'url_key'
        )->addAttributeToSelect(
            'image'
        )->addAttributeToSelect(
            'name'
        )->addAttributeToSelect(
            'all_children'
        )->addAttributeToSelect(
            'is_anchor'
        )->addAttributeToFilter(
            'is_active',
            1
        )->addAttributeToFilter(
            'include_in_menu',
            1
        )->addIdFilter(
            $subCategory->getChildren()
        )->setOrder(
            'position',
            \Magento\Framework\DB\Select::SQL_ASC
        )->joinUrlRewrite();

        return $collection;
    }
}
