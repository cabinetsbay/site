<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 02/10/2019
 * Time: 20:40
 */

namespace Sharapov\Cabinetsbay\Block;

class HomePage extends \Magento\Framework\View\Element\Template
{

	const XML_CONFIG_POPULAR_PRODUCTS = 'cabinetsbay_settings/general/popular_products';

	private $scopeConfig;

	/**
	 * Notification constructor.
	 *
	 * @param \Magento\Framework\View\Element\Template\Context $context
	 * @param \Magento\Checkout\Model\Session                  $checkoutSession
	 * @param array                                            $data
	 */
	function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		array $data = []
	) {
		parent::__construct($context, $data);
		$this->scopeConfig = $scopeConfig;
	}

	/**
	 * @return array
	 */
	function getPopularProducts(): array
	{
		$ids = $this->scopeConfig->getValue(self::XML_CONFIG_POPULAR_PRODUCTS,
			\Magento\Store\Model\ScopeInterface::SCOPE_STORE);

		$ids = ($ids) ? explode(",", $ids) : [];
		$ids = array_slice($ids, 0, 3);
		$popularCategories = [];

		$objectManager
			= \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
		$categoryFactory
			= $objectManager->get('\Magento\Catalog\Model\CategoryFactory');// Instance of Category Model

		foreach ($ids as $id) {
			array_push($popularCategories,
				$categoryFactory->create()->load($id));
		}

		unset($categoryFactory, $objectManager, $ids);

		return $popularCategories;
	}
}
