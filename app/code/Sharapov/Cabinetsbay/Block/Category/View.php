<?php
namespace Sharapov\Cabinetsbay\Block\Category;
use Magento\Catalog\Model\Category as C;
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

	/**
	 * 2024-01-02
	 * @used-by self::getCategoryImagesForCarousel()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml
	 * @return C|null
	 */
	function parent() {
		if ($this->getCurrentCategory()) {
			if ($this->getCurrentCategory()->getParentCategories()) {
				foreach ($this->getCurrentCategory()->getParentCategories() as $parent) {
					if ($parent->getLevel() == 3) {
						$objectManager_sub = \Magento\Framework\App\ObjectManager::getInstance();
						$category = $objectManager_sub->get('Magento\Catalog\Model\Category');
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
		if ($this->parent()) {
			$imageDir = getcwd() . '/' . DirectoryList::MEDIA . '/wysiwyg/catalog-carousel-images/'
			. $this->parent()->getId();
			if (is_dir($imageDir)) {
				$dh = opendir($imageDir);
				while (false !== ($filename = readdir($dh))) {
					$files[] = 'wysiwyg/catalog-carousel-images/'
					. $this->parent()->getId() . '/'
					. $filename;
				}
				$images = preg_grep('/\.jpg|\.png|\.gif$/i', $files);
				unset($files);
				if (!empty($images)) {
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
		  (string)$this->parent()->getData('cb_specs')
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
		  (string)$this->parent()->getData('cb_assembly')
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
		  (string)$this->parent()->getData('cb_styles')
	  );
  }

  /**
   * @return array
   */
  function getMatchingProducts(): array
  {
	$ids = $this->parent()->getData('cb_matching_products');

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
