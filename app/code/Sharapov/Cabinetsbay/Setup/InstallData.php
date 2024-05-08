<?php
# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
namespace Sharapov\Cabinetsbay\Setup;
use CabinetsBay\Catalog\Category\Attribute as A;
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
   * @param EavSetupFactory $eavSetupFactory
   * @pram \Magento\Framework\Module\Manager $moduleManager
   */
  function __construct(EavSetupFactory $eavSetupFactory, \Magento\Framework\Module\Manager $moduleManager) {
	$this->eavSetupFactory = $eavSetupFactory;
	$this->moduleManager = $moduleManager;
  }

  function install(
	ModuleDataSetupInterface $setup,
	ModuleContextInterface $context
  ) {
	/**
	 * Forced verification of the Backend module
	 */
	if(!$this->moduleManager->isEnabled('Sharapov_Cabinetsbay')) {
	  throw new \Magento\Framework\Validator\Exception(__('Sharapov_Cabinetsbay module must be enabled.'));
	}

	$setup->startSetup();

	$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  A::SPECS,
	  [
		'type'                  => 'text',
		'label'                 => 'Product Specifications Content',
		'input'                 => 'textarea',
		'required'              => false,
		'sort_order'            => 40,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  A::ASSEMBLY,
	  [
		'type'                  => 'text',
		'label'                 => 'Cabinet Assembly Content',
		'input'                 => 'textarea',
		'required'              => false,
		'sort_order'            => 40,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  A::STYLES,
	  [
		'type'                  => 'text',
		'label'                 => 'Matching Styles Content',
		'input'                 => 'textarea',
		'required'              => false,
		'sort_order'            => 40,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  'cb_kitchen_set',
	  [
		'type'                  => 'varchar',
		'label'                 => 'Kitchen Set',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 180,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  'cb_kitchen_price',
	  [
		'type'                  => 'varchar',
		'label'                 => 'Price',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 190,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  A::KITCHEN_COLOR,
	  [
		'type'                  => 'varchar',
		'label'                 => 'Color (numeric value: lower - the lighter, higher - the darker)',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 200,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  'cb_kitchen_style',
	  [
		'type'                  => 'varchar',
		'label'                 => 'Style',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 210,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  'cb_kitchen_type',
	  [
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
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  A::DOOR_SAMPLE_LINK,
	  [
		'type'                  => 'varchar',
		'label'                 => 'Door sample link',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 220,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'wysiwyg_enabled'       => true,
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$eavSetup->addAttribute(
	  \Magento\Catalog\Model\Category::ENTITY,
	  'cb_matching_products',
	  [
		'type'                  => 'varchar',
		'label'                 => 'Matching Products IDs (comma-separated)',
		'input'                 => 'text',
		'required'              => false,
		'sort_order'            => 50,
		'global'                => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
		'group'                 => 'General Information',
		'is_used_in_grid'       => true,
		'is_visible_in_grid'    => true,
		'is_filterable_in_grid' => false,
	  ]
	);

	$setup->endSetup();
  }
}
