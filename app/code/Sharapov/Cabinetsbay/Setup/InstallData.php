<?php
# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
namespace Sharapov\Cabinetsbay\Setup;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Catalog\Model\Category as C;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface as IScopedAttribute;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
class InstallData implements InstallDataInterface {
  /**
   * EAV setup factory
   * @var EavSetupFactory
   */
  private $eavSetupFactory;

  /**
   * @var \Magento\Framework\Module\Manager
   */
  protected $moduleManager;

  /**
   * Init
   *
   * @param EavSetupFactory $eavFactory
   * @pram \Magento\Framework\Module\Manager $moduleManager
   */
	function __construct(EavSetupFactory $eavFactory, \Magento\Framework\Module\Manager $moduleManager) {
		$this->eavSetupFactory = $eavFactory;
		$this->moduleManager = $moduleManager;
	}

	function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
	if(!$this->moduleManager->isEnabled('Sharapov_Cabinetsbay')) {
	  throw new \Magento\Framework\Validator\Exception(__('Sharapov_Cabinetsbay module must be enabled.'));
	}
	$setup->startSetup();
	$eav = $this->eavSetupFactory->create(['setup' => $setup]);
	$eav->addAttribute(C::ENTITY, A::SPECS, [
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
	]);
	$eav->addAttribute(C::ENTITY, A::ASSEMBLY, [
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
	]);
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

	$eav->addAttribute(
	  C::ENTITY,
	  A::DOOR_SAMPLE_LINK,
	  [
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
	  ]
	);

	$eav->addAttribute(
	  C::ENTITY,
	  'cb_matching_products',
	  [
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
	  ]
	);

	$setup->endSetup();
  }
}
