<?php
namespace Sharapov\Cabinetsbay\Setup;
use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
# 2024-05-08 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
class UpgradeData implements UpgradeDataInterface {
  /**
   * EAV setup factory
   * @var EavSetupFactory
   */
  private $eavSetupFactory;

  /**
   * Init
   *
   * @param EavSetupFactory $eavSetupFactory
   */
  function __construct(EavSetupFactory $eavSetupFactory) {
	$this->eavSetupFactory = $eavSetupFactory;
  }

  /**
   * {@inheritdoc}
   * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
   */
  function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context) {
	$setup->startSetup();

	/** @var EavSetup $eavSetup */
	$eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

	if(version_compare($context->getVersion(), '1.0.1') < 0) {
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_specs',
		[
		  'is_visible_on_front' => true,
		  'wysiwyg_enabled'     => true
		]
	  );
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_assembly',
		[
		  'is_visible_on_front' => true,
		  'wysiwyg_enabled'     => true
		]
	  );
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_styles',
		[
		  'is_visible_on_front' => true,
		  'wysiwyg_enabled'     => true
		]
	  );
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_kitchen_set',
		[
		  'is_visible_on_front' => true
		]
	  );
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_kitchen_style',
		[
		  'is_visible_on_front' => true
		]
	  );
	  $eavSetup->updateAttribute(
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
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_kitchen_price',
		[
		  'is_visible_on_front' => true
		]
	  );
	  $eavSetup->updateAttribute(
		\Magento\Catalog\Model\Category::ENTITY,
		'cb_door_sample_link',
		[
		  'is_visible_on_front' => true
		]
	  );
	}

	$setup->endSetup();
  }
}
