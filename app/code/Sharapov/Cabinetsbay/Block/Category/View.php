<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 28.10.2019
 * Time: 23:42
 */

namespace Sharapov\Cabinetsbay\Block\Category;

use Magento\Framework\App\Filesystem\DirectoryList;

class View extends \Magento\Catalog\Block\Category\View {
  function getCategoryProducts() {
	$objectManager_sub = $objectManager
	  = \Magento\Framework\App\ObjectManager::getInstance();
	$category = $objectManager_sub->get('Magento\Catalog\Model\Category');

	return $category
	  ->getCollection()
	  ->addAttributeToSelect('*')
	  ->addAttributeToFilter('is_active', 1)
	  ->addIdFilter($this->getCurrentCategory()->getChildren())
	  ->setOrder('position', 'ASC');
  }

  function getCategoryDeepLevel() {
	return $this->getCurrentCategory()->getLevel();
  }

  function isRTA() {
	return ($this->getCurrentCategory()->getId() == 3411);
  }

  function isPA() {
	return ($this->getCurrentCategory()->getId() == 4036);
  }

  function getRootCategoryName() {
	if($this->getCurrentCategory()) {
	  if($this->getCurrentCategory()->getParentCategories()) {
		foreach(
		  $this->getCurrentCategory()->getParentCategories() as
		  $parent
		) {
		  if($parent->getLevel() == 2) {
			// returns the level 1 category id;
			return $parent->getName();
		  }
		}
	  }
	}

	return '';
  }

  function getSecondLevelCategoryName() {
	if($this->getCurrentCategory()) {
	  if($this->getCurrentCategory()->getParentCategories()) {
		foreach(
		  $this->getCurrentCategory()->getParentCategories() as
		  $parent
		) {
		  if($parent->getLevel() == 3) {
			$objectManager_sub = $objectManager
			  = \Magento\Framework\App\ObjectManager::getInstance();
			$category
			  = $objectManager_sub->get('Magento\Catalog\Model\Category');

			// returns the level 2 category id;
			return $category->load($parent->getId());
		  }
		}
	  }
	}

	return null;
  }

	/**
	 * 2024-01-02
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml:27
	 */
	function getCategoryImagesForCarousel() {
		if($this->getSecondLevelCategoryName()) {
			$imageDir = getcwd() . '/' . DirectoryList::MEDIA . '/wysiwyg/catalog-carousel-images/'
			. $this->getSecondLevelCategoryName()->getId();
			if(is_dir($imageDir)) {
				$dh = opendir($imageDir);
				while(false !== ($filename = readdir($dh))) {
					$files[] = 'wysiwyg/catalog-carousel-images/'
					. $this->getSecondLevelCategoryName()->getId() . '/'
					. $filename;
				}
				$images = preg_grep('/\.jpg|\.png|\.gif$/i', $files);
				unset($files);
				if(!empty($images)) {
					natsort($images);
					return $images;
				}
			}
		}
		return null;
	}

  /**
   * @return string
   */
  function getSpecifications() {
	return \Magento\Framework\App\ObjectManager::getInstance()
	  ->get('Magento\Cms\Model\Template\FilterProvider')
	  ->getPageFilter()
	  ->filter(
		  (string)$this->getSecondLevelCategoryName()->getData('cb_specs')
	  );
  }

  /**
   * @return string
   */
  function getCabinetAssembly() {
	return \Magento\Framework\App\ObjectManager::getInstance()
	  ->get('Magento\Cms\Model\Template\FilterProvider')
	  ->getPageFilter()
	  ->filter(
		  (string)$this->getSecondLevelCategoryName()->getData('cb_assembly')
	  );
  }

  /**
   * @return string
   */
  function getMatchingStyles() {
	return \Magento\Framework\App\ObjectManager::getInstance()
	  ->get('Magento\Cms\Model\Template\FilterProvider')
	  ->getPageFilter()
	  ->filter(
		  (string)$this->getSecondLevelCategoryName()->getData('cb_styles')
	  );
  }

  /**
   * @return array
   */
  function getMatchingProducts(): array
  {
	$ids = $this->getSecondLevelCategoryName()->getData('cb_matching_products');

	$ids = ($ids) ? explode(",", $ids) : [];
	$matchingCategories = [];

	$objectManager
	  = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
	$categoryFactory
	  = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');// Instance of Category Model

	foreach ($ids as $id) {
	  array_push($matchingCategories, $categoryFactory->create()->load($id));
	}

	unset($categoryFactory, $objectManager, $ids);

	return $matchingCategories;
  }
}
