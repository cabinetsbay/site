<?php
namespace Sharapov\Cabinetsbay\Setup;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Catalog\Model\Category as C;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface as IScopedAttribute;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
class InstallData implements InstallDataInterface {
	/**
	 * 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 */
	function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
		df_assert_module_enabled('Sharapov_Cabinetsbay');
		$setup->startSetup();
		# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
		# `array_map([__CLASS__, 'f'], [1, 2, 3])` for a private `f` is allowed: https://3v4l.org/29Zim
		df_map_k([__CLASS__, 'aLong'], [
			A::ASSEMBLY => 'Cabinet Assembly Content'
			,A::SPECS => 'Product Specifications Content'
			,A::STYLES => 'Matching Styles Content'
		]);
		df_map_k([__CLASS__, 'aShort'], [
			A::KITCHEN_SET => [180, 'Kitchen Set']
			,A::KITCHEN_PRICE => [190, 'Price']
			,A::KITCHEN_COLOR => [200, 'Color (numeric value: lower - the lighter, higher - the darker)']
			,A::KITCHEN_STYLE => [210, 'Style']
			,A::KITCHEN_TYPE => [225, 'Construction Type']
			,A::DOOR_SAMPLE_LINK => [220, 'Door sample link']
			,A::MATCHING_PRODUCTS => [50, 'Matching Products IDs (comma-separated)']
		]);
		$setup->endSetup();
	}

	/**
	 * 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by self::aLong()
	 * @used-by self::aShort()
	 * @param array(string => string|int|bool) $v
	 */
	private static function a(string $k, array $v):void {
		df_eav_setup()->addAttribute(C::ENTITY, $k, $v + [
			'global' => IScopedAttribute::SCOPE_STORE
			,'group' => 'General Information'
			,'is_filterable_in_grid' => false
			,'is_used_in_grid' => true
			,'is_visible_in_grid' => true
			,'required' => false
		]);
	}

	/**
	 * 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 */
	private static function aLong(string $k, string $l):void {self::a($k, [
		'input' => 'textarea', 'label' => $l, 'sort_order' => 40, 'type'  => 'text', 'wysiwyg_enabled' => true
	]);}

	/**
	 * 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @param array(string => string|int|bool) $v
	 */
	private static function aShort(string $k, array $v):void {self::a($k, [
		'input' => 'text', 'label' => $v[1], 'sort_order' => $v[0], 'type' => 'varchar'
	]);}
}