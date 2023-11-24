<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 23.01.2020
 * Time: 01:04
 */

namespace Sharapov\Cabinetsbay\Block\Product;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\CatalogWidget\Model\Rule;
use Magento\Framework\App\Http\Context;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Url\EncoderInterface;
use Magento\Framework\View\LayoutFactory;
use Magento\Rule\Model\Condition\Sql\Builder;
use Magento\Widget\Helper\Conditions;
use WeltPixel\MobileDetect\Library\MobileDetect;

/**
 * Catalog Products List widget block
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class ProductsList extends \Magento\CatalogWidget\Block\Product\ProductsList {
  /**
   * Mobile Detector
   * @var MobileDetect
   */
  protected $_mobileDetector;

  /**
   * @param \Magento\Catalog\Block\Product\Context $context
   * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
   * @param \Magento\Catalog\Model\Product\Visibility $catalogProductVisibility
   * @param \Magento\Framework\App\Http\Context $httpContext
   * @param \Magento\Rule\Model\Condition\Sql\Builder $sqlBuilder
   * @param \Magento\CatalogWidget\Model\Rule $rule
   * @param \Magento\Widget\Helper\Conditions $conditionsHelper
   * @param array $data
   * @param Json|null $json
   * @param LayoutFactory|null $layoutFactory
   * @param \Magento\Framework\Url\EncoderInterface|null $urlEncoder
   * @SuppressWarnings(PHPMD.ExcessiveParameterList)
   */
  public function __construct(
    \Magento\Catalog\Block\Product\Context $context,
    CollectionFactory $productCollectionFactory,
    Visibility $catalogProductVisibility,
    Context $httpContext,
    Builder $sqlBuilder,
    Rule $rule,
    Conditions $conditionsHelper,
    CategoryRepositoryInterface $categoryRepository,
    array $data = [],
    Json $json = null,
    LayoutFactory $layoutFactory = null,
    EncoderInterface $urlEncoder = null
  ) {
    $this->_mobileDetector = new MobileDetect();
    parent::__construct($context, $productCollectionFactory, $catalogProductVisibility, $httpContext, $sqlBuilder,
                        $rule, $conditionsHelper, $data, $json, $layoutFactory, $urlEncoder, $categoryRepository);
  }

  /**
   * Retrieve current view mode
   * @return string
   */
  public function getMode() {
    if($this->isMobile()) {

      // Force grid view on mobile
      return 'grid';
    }

    return 'list';
  }

  public function isMobile() {
    return $this->_mobileDetector->isMobile() || $this->_mobileDetector->isTablet();
  }
}
