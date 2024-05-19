<?php
namespace Sharapov\Cabinetsbay\Setup;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Catalog\Model\Category as C;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleContextInterface as IContext;
use Magento\Framework\Setup\ModuleDataSetupInterface as ISetup;
use Magento\Framework\Setup\UpgradeDataInterface;
# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
class UpgradeData implements UpgradeDataInterface {
	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 */
	function upgrade(ISetup $setup, IContext $context) {
		$setup->startSetup();
		if(version_compare($context->getVersion(), '1.0.1') < 0) {
			self::a('cb_kitchen_type', ['input' => 'text', 'type' => 'varchar']);
			df_map(
				[__CLASS__, 'a']
				,['cb_assembly', 'cb_specs', 'cb_styles']
				,[['is_visible_on_front' => true, 'wysiwyg_enabled' => true]]
			);
			df_map(
				[__CLASS__, 'a']
				,['cb_door_sample_link', 'cb_kitchen_price', 'cb_kitchen_set', 'cb_kitchen_style']
				,[['is_visible_on_front' => true]]
			);
		}
		$setup->endSetup();
	}

	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by self::upgrade()
	 * @param array(string => string|int|bool) $v
	 */
	private static function a(string $k, array $v):void {df_eav_setup()->updateAttribute(C::ENTITY, $k, $v);}
}