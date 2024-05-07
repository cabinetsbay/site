<?php
namespace Sharapov\Cabinetsbay\Block;
use Magento\Catalog\Model\ResourceModel\Category\Collection as CC;
# 2024-05-06 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Theme/templates/homepage.phtml`":
# https://github.com/cabinetsbay/site/issues/146
class HomePage extends \Magento\Framework\View\Element\Template {
	/**
	 * 2024-05-07 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * Refactor `app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Theme/templates/homepage.phtml`":
	 * https://github.com/cabinetsbay/site/issues/146
	 */
	function popular():CC {return
		df_category_c(array_slice(df_csv_parse_int(df_cfg('cabinetsbay_settings/general/popular_products')), 0, 3))
			->addAttributeToSelect(['cb_door_sample_link', 'cb_kitchen_price', 'cb_kitchen_set', 'image', 'name'])
			->joinUrlRewrite()
	;}
}
