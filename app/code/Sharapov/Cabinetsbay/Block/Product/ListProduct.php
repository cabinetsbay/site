<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 29.10.2019
 * Time: 22:01
 */

namespace Sharapov\Cabinetsbay\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Block\Product\Context;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\Data\Helper\PostHelper;
use Magento\Framework\Url\Helper\Data;
use WeltPixel\MobileDetect\Library\MobileDetect;

class ListProduct extends \Magento\Catalog\Block\Product\ListProduct {

  /**
   * Mobile Detector
   * @var MobileDetect
   */
  protected $_mobileDetector;

  /**
   * @param Context $context
   * @param PostHelper $postDataHelper
   * @param Resolver $layerResolver
   * @param CategoryRepositoryInterface $categoryRepository
   * @param Data $urlHelper
   * @param array $data
   */
  function __construct(
	Context $context,
	PostHelper $postDataHelper,
	Resolver $layerResolver,
	CategoryRepositoryInterface $categoryRepository,
	Data $urlHelper,
	array $data = []
  ) {
	$this->_mobileDetector = new MobileDetect();
	parent::__construct(
	  $context,
	  $postDataHelper,
	  $layerResolver,
	  $categoryRepository,
	  $urlHelper
	);
	// Workaround to show NOINDEX,FOLLOW for inner catalog pages
	if(isset($_GET['p']) and is_numeric($_GET['p']) and $_GET['p'] > 1) {
	  $this->pageConfig->setRobots('NOINDEX,FOLLOW');
	}
  }

  function getCurrentCategory() {
	return $this->getLayer()->getCurrentCategory();
  }

	/**
	 * 2024-03-10 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @see \Sharapov\Cabinetsbay\Block\Category\View::level()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/product/list.phtml
	 */
	function level():int {return df_category_level($this->getCurrentCategory());}

  function isMobile() {
	return $this->_mobileDetector->isMobile() || $this->_mobileDetector->isTablet();
  }

  /**
   * Retrieve current view mode
   * @return string
   */
  function getMode() {
	if($this->isMobile()) {

	  // Force grid view on mobile
	  return 'grid';
	}

	return parent::getMode();
  }
}
