<?php
namespace Sharapov\Cabinetsbay\Setup;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Catalog\Model\Category as C;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface as IScopedAttribute;
/**
 * 22024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
 * @final Unable to use the PHP «final» keyword here because of the M2 code generation.
 */
class UpgradeData extends \Df\Framework\Upgrade\Data {
	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @override
	 * @see \Df\Framework\Upgrade::_process()
	 * @used-by \Df\Framework\Upgrade::process()
	 */
	final protected function _process():void {
		if ($this->isInitial()) {
			$this->p100();
		}
		elseif ($this->v('1.0.1')) {
			$this->p101();
		}
	}

	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by self::_process()
	 */
	private function p100():void {
		$a = function(string $k, array $v):void {$this->sEav()->addAttribute(C::ENTITY, $k, $v + [
			'global' => IScopedAttribute::SCOPE_STORE
			,'group' => 'General Information'
			,'is_filterable_in_grid' => false
			,'is_used_in_grid' => true
			,'is_visible_in_grid' => true
			,'required' => false
		]);};
		df_map_k([
			A::ASSEMBLY => 'Cabinet Assembly Content'
			,A::SPECS => 'Product Specifications Content'
			,A::STYLES => 'Matching Styles Content'
		], function(string $k, string $l) use($a):void {$a($k, [
			'input' => 'textarea', 'label' => $l, 'sort_order' => 40, 'type'  => 'text', 'wysiwyg_enabled' => true
		]);});
		df_map_k([
			A::KITCHEN_SET => [180, 'Kitchen Set']
			,A::KITCHEN_PRICE => [190, 'Price']
			,A::KITCHEN_COLOR => [200, 'Color (numeric value: lower - the lighter, higher - the darker)']
			,A::KITCHEN_STYLE => [210, 'Style']
			,A::KITCHEN_TYPE => [225, 'Construction Type']
			,A::DOOR_SAMPLE_LINK => [220, 'Door sample link']
			# 2024-05-23 Dmitrii Fediuk https://upwork.com/fl/mage2pro
			# https://github.com/cabinetsbay/catalog/labels/matching-products
			,A::MATCHING_PRODUCTS => [50, 'Matching Products IDs (comma-separated)']
		], function(string $k, array $v) use($a):void {$a($k, [
			'input' => 'text', 'label' => $v[1], 'sort_order' => $v[0], 'type' => 'varchar'
		]);});
	}

	/**
	 * 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by self::_process()
	 */
	private function p101():void {
		$a = function(string $k, array $v):void {$this->sEav()->updateAttribute(C::ENTITY, $k, $v);};
		$a(A::KITCHEN_TYPE, ['input' => 'text', 'type' => 'varchar']);
		df_map($a, [A::ASSEMBLY, A::SPECS, A::STYLES] ,[['is_visible_on_front' => true, 'wysiwyg_enabled' => true]]);
		df_map(
			$a
			,[A::DOOR_SAMPLE_LINK, A::KITCHEN_PRICE, A::KITCHEN_SET, A::KITCHEN_STYLE]
			,[['is_visible_on_front' => true]]
		);
	}
}