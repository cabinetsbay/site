<?php
namespace Sharapov\Cabinetsbay\Plugin\Category;
use CabinetsBay\Catalog\Category\Attribute as A;
use Magento\Eav\Model\Config;
# 2024-05-19 Dmitrii Fediuk https://upwork.com/fl/mage2pro
# "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
class DataProvider {
	/**
	 * @var Config
	 */
	private $eavConfig;

	function __construct(
		Config $eavConfig
	)
	{
		$this->eavConfig = $eavConfig;
	}

	/**
	 * @param \Magento\Catalog\Model\Category\DataProvider $subject
	 * @param                                              $result
	 *
	 * @return array
	 * @throws \Magento\Framework\Exception\LocalizedException
	 */
	function afterPrepareMeta(\Magento\Catalog\Model\Category\DataProvider $subject, $result)
	{
		$meta = array_merge_recursive($result, $this->_prepareFieldsMeta(
			$this->_getFieldsMap(),
			$subject->getAttributesMeta($this->eavConfig->getEntityType('catalog_category'))
		));

		return $meta;
	}

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

	/**
	 * Rewrite this in all subclassess, provide the list with category attributes
	 * @return array
	 */
	protected function _getFieldsMap() {return ['content' => [
		A::ASSEMBLY, A::KITCHEN_COLOR, A::KITCHEN_PRICE, A::KITCHEN_SET, A::KITCHEN_STYLE, A::KITCHEN_TYPE,
		A::MATCHING_PRODUCTS, A::SPECS, A::STYLES
	]];}
}