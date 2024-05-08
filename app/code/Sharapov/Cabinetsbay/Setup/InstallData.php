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
				'input'                 => 'textarea',
				'label'                 => 'Cabinet Assembly Content',
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
			,A::SPECS => [
				'input'                 => 'textarea',
				'label'                 => 'Product Specifications Content',
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
			,A::STYLES => [
				'input'                 => 'textarea',
				'label'                 => 'Matching Styles Content',
				'sort_order'            => 40,
				'type'                  => 'text',
				'wysiwyg_enabled'       => true
			]
		];
		foreach ($attrs as $k => $v) {/** @var string $k */ /** @var array(string => string|int|bool) $v */
			$eav->addAttribute(C::ENTITY, $k, $v + [
				'global' => IScopedAttribute::SCOPE_STORE
				,'group' => 'General Information'
				,'is_filterable_in_grid' => false
				,'is_used_in_grid' => true
				,'is_visible_in_grid' => true
				,'required' => false
			]);
		}
		$eav->addAttribute(C::ENTITY, A::KITCHEN_SET, [
			'input'                 => 'text',
			'label'                 => 'Kitchen Set',
			'sort_order'            => 180,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_PRICE, [
			'input'                 => 'text',
			'label'                 => 'Price',
			'sort_order'            => 190,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_COLOR, [
			'input'                 => 'text',
			'label'                 => 'Color (numeric value: lower - the lighter, higher - the darker)',
			'sort_order'            => 200,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_STYLE, [
			'input'                 => 'text',
			'label'                 => 'Style',
			'sort_order'            => 210,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::KITCHEN_TYPE, [
			'input'                 => 'text',
			'label'                 => 'Construction Type',
			'sort_order'            => 225,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::DOOR_SAMPLE_LINK, [
			'input'                 => 'text',
			'label'                 => 'Door sample link',
			'sort_order'            => 220,
			'type'                  => 'varchar',
			'wysiwyg_enabled'       => true
		]);
		$eav->addAttribute(C::ENTITY, A::MATCHING_PRODUCTS, [
			'input'                 => 'text',
			'label'                 => 'Matching Products IDs (comma-separated)',
			'sort_order'            => 50,
			'type'                  => 'varchar'
		]);
		$setup->endSetup();
	}
}