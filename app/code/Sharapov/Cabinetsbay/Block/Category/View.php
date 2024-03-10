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

	/**
	 * 2024-03-10 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * 1) "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * 2) @uses \Magento\Catalog\Model\Category::getLevel() can return a string (e.g.: "3").
	 * @see \Sharapov\Cabinetsbay\Block\Product\ListProduct::level()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 */
	function level():int {return (int)$this->getCurrentCategory()->getLevel();}

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
	 * 2024-03-10
	 * 1) https://3v4l.org/3ssAP
	 * 2) https://www.php.net/manual/migration71.new-features.php#migration71.new-features.nullable-types
	 * @used-by self::images()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml
	 */
	function parent():?C {return !($c = $this->getCurrentCategory()) ? null : df_find(
		$c->getParentCategories(), function(C $c):?C {return
			/** 2024-03-10 @uses \Magento\Catalog\Model\Category::getLevel() can return a string (e.g., "3"). */
			3 !== (int)$c->getLevel() ? null : df_category($c->getId())
		;}
	);}

	/**
	 * 2024-01-02
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml:27
	 * @return array(string => string)
	 */
	function images():array {$r = []; /** @var array(string => string)  $r */
		$path = 'wysiwyg/catalog-carousel-images/'; /** @var string $path */
		if ($p = $this->parent()) {
			if (is_dir($d = getcwd() . '/' . DirectoryList::MEDIA . '/' . $path . $p->getId())) {
				$dh = opendir($d);
				$ff = [];
				while (false !== ($f = readdir($dh))) {
					$ff[] = 'wysiwyg/catalog-carousel-images/' . $p->getId() . '/' . $f;
				}
				$r = df_sort(df_trim_text_left(df_eta(preg_grep('/\.jpg|\.png|\.gif$/i', $ff)), $path));
				$r = array_combine($r, df_mvar_n($r));
			}
		}
		return $r;
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
