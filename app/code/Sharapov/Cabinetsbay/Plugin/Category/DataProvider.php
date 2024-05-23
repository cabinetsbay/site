<?php
# 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
namespace Sharapov\Cabinetsbay\Plugin\Category;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Catalog\Model\Category\DataProvider as Sb;
final class DataProvider {
	/**
	 * 2024-05-23 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by self::STUB()
	 */
	function afterPrepareMeta(Sb $sb, $result) {return array_merge_recursive($result, $this->_prepareFieldsMeta(
		['content' => [
			A::ASSEMBLY, A::KITCHEN_COLOR, A::KITCHEN_PRICE, A::KITCHEN_SET, A::KITCHEN_STYLE, A::KITCHEN_TYPE,
			A::MATCHING_PRODUCTS, A::SPECS, A::STYLES
		]]
		,$sb->getAttributesMeta(df_eav_category())
	));}

	/**
	 * Prepare fields meta based on xml declaration of form and fields metadata
	 *
	 * @param array $fieldsMap
	 * @param array $fieldsMeta
	 * @return array
	 */
	protected function _prepareFieldsMeta($fieldsMap, $fieldsMeta)
	{
		$result = [];
		foreach ($fieldsMap as $fieldSet => $fields) {
			foreach ($fields as $field) {
				if (isset($fieldsMeta[$field])) {
					$result[$fieldSet]['children'][$field]['arguments']['data']['config'] = $fieldsMeta[$field];
				}
			}
		}
		return $result;
	}
}