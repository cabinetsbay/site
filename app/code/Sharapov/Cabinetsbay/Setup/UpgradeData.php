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
			df_map(
				[__CLASS__, 'a']
				,['cb_assembly', 'cb_specs', 'cb_styles']
				,[['is_visible_on_front' => true, 'wysiwyg_enabled' => true]]
			);
			self::a('cb_kitchen_set', [
				'is_visible_on_front' => true
			]);
			self::a('cb_kitchen_style', [
				'is_visible_on_front' => true
			]);
			self::a('cb_kitchen_type', [
				'type'                  => 'varchar',
				'label'                 => 'Construction Type',
				'input'                 => 'text',
				'required'              => false,
				'sort_order'            => 225,
				'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
				'group'                 => 'General Information',
				'wysiwyg_enabled'       => true,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'is_filterable_in_grid' => false,
			]);
			self::a('cb_kitchen_price', [
				'is_visible_on_front' => true
			]);
			self::a('cb_door_sample_link', [
				'is_visible_on_front' => true
			]);
		}
		$setup->endSetup();
	}

	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @param array(string => string|int|bool) $v
	 */
	private static function a(string $k, array $v):void {df_eav_setup()->updateAttribute(C::ENTITY, $k, $v);}
}