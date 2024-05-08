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
				'type'                  => 'text',
				'label'                 => 'Cabinet Assembly Content',
				'input'                 => 'textarea',
				'required'              => false,
				'sort_order'            => 40,
				'global'                => IScopedAttribute::SCOPE_STORE,
				'group'                 => 'General Information',
				'wysiwyg_enabled'       => true,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'is_filterable_in_grid' => false,
			]
			,A::SPECS => [
				'type'                  => 'text',
				'label'                 => 'Product Specifications Content',
				'input'                 => 'textarea',
				'required'              => false,
				'sort_order'            => 40,
				'global'                => IScopedAttribute::SCOPE_STORE,
				'group'                 => 'General Information',
				'wysiwyg_enabled'       => true,
				'is_used_in_grid'       => true,
				'is_visible_in_grid'    => true,
				'is_filterable_in_grid' => false,
			]
		];
		foreach ($attrs as $k => $v) {/** @var string $k */ /** @var array(string => string|int|bool) $v */
			$eav->addAttribute(C::ENTITY, $k, $v);
		}
		$eav->addAttribute(C::ENTITY, A::STYLES, [
			'type'                  => 'text',
			'label'                 => 'Matching Styles Content',
			'input'                 => 'textarea',
			'required'              => false,
			'sort_order'            => 40,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_SET, [
			'type'                  => 'varchar',
			'label'                 => 'Kitchen Set',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 180,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_PRICE, [
			'type'                  => 'varchar',
			'label'                 => 'Price',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 190,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_COLOR, [
			'type'                  => 'varchar',
			'label'                 => 'Color (numeric value: lower - the lighter, higher - the darker)',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 200,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_STYLE, [
			'type'                  => 'varchar',
			'label'                 => 'Style',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 210,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_TYPE, [
			'type'                  => 'varchar',
			'label'                 => 'Construction Type',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 225,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::DOOR_SAMPLE_LINK, [
			'type'                  => 'varchar',
			'label'                 => 'Door sample link',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 220,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'wysiwyg_enabled'       => true,
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$eav->addAttribute(C::ENTITY, A::MATCHING_PRODUCTS, [
			'type'                  => 'varchar',
			'label'                 => 'Matching Products IDs (comma-separated)',
			'input'                 => 'text',
			'required'              => false,
			'sort_order'            => 50,
			'global'                => IScopedAttribute::SCOPE_STORE,
			'group'                 => 'General Information',
			'is_used_in_grid'       => true,
			'is_visible_in_grid'    => true,
			'is_filterable_in_grid' => false,
		]);
		$setup->endSetup();
	}
}
