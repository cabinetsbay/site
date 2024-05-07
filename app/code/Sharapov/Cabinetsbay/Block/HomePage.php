<?php
namespace Sharapov\Cabinetsbay\Block;
# 2024-05-06 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Theme/templates/homepage.phtml`":
# https://github.com/cabinetsbay/site/issues/146
class HomePage extends \Magento\Framework\View\Element\Template {
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
	function getPopularProducts():array {
		$ids = df_cfg('cabinetsbay_settings/general/popular_products');
		$ids = ($ids) ? explode(",", $ids) : [];
		$ids = array_slice($ids, 0, 3);
		$popularCategories = [];
		$objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of Object Manager
		$categoryFactory = $objectManager->get('\Magento\Catalog\Model\CategoryFactory');// Instance of Category Model
		foreach ($ids as $id) {
			array_push($popularCategories,
				$categoryFactory->create()->load($id));
		}
		unset($categoryFactory, $objectManager, $ids);
		return $popularCategories;
	}
}
