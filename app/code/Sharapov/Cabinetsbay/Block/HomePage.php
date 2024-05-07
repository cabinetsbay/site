<?php
namespace Sharapov\Cabinetsbay\Block;
# 2024-05-06 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Theme/templates/homepage.phtml`":
# https://github.com/cabinetsbay/site/issues/146
class HomePage extends \Magento\Framework\View\Element\Template {
	/**
	 * 2024-05-07 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Theme/templates/homepage.phtml`":
	 * https://github.com/cabinetsbay/site/issues/146
	 */
	function getPopularProducts():array {
		$ids = array_slice(df_csv_parse_int(df_cfg('cabinetsbay_settings/general/popular_products')), 0, 3);
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
