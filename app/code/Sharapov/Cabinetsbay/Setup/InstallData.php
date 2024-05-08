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
		$eav = df_eav_setup(); /** @var EavSetup $eav */
		$attrs = [
			A::ASSEMBLY => [
				'group'                 => 'General Information',
				'input'                 => 'textarea',
				'is_filterable_in_grid' => false,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'label'                 => 'Cabinet Assembly Content',
				'required'              => false,
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
			,A::SPECS => [
				'group'                 => 'General Information',
				'input'                 => 'textarea',
				'is_filterable_in_grid' => false,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'label'                 => 'Product Specifications Content',
				'required'              => false,
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
			,A::STYLES => [
				'group'                 => 'General Information',
				'input'                 => 'textarea',
				'is_filterable_in_grid' => false,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'label'                 => 'Matching Styles Content',
				'required'              => false,
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
		];
		foreach ($attrs as $k => $v) {/** @var string $k */ /** @var array(string => string|int|bool) $v */
			$eav->addAttribute(C::ENTITY, $k, $v + ['global' => IScopedAttribute::SCOPE_STORE]);
		}
		$eav->addAttribute(C::ENTITY, A::KITCHEN_SET, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Kitchen Set',
			'required'              => false,
			'sort_order'            => 180,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_PRICE, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Price',
			'required'              => false,
			'sort_order'            => 190,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_COLOR, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Color (numeric value: lower - the lighter, higher - the darker)',
			'required'              => false,
			'sort_order'            => 200,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_STYLE, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Style',
			'required'              => false,
			'sort_order'            => 210,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_TYPE, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Construction Type',
			'required'              => false,
			'sort_order'            => 225,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::DOOR_SAMPLE_LINK, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Door sample link',
			'required'              => false,
			'sort_order'            => 220,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::MATCHING_PRODUCTS, [
			'group'                 => 'General Information',
			'input'                 => 'text',
			'is_filterable_in_grid' => false,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'label'                 => 'Matching Products IDs (comma-separated)',
			'required'              => false,
			'sort_order'            => 50,
			'type'                  => 'varchar'
		]);
		$setup->endSetup();
	}
}
