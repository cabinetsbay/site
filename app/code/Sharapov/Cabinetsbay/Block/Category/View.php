<?php
namespace Sharapov\Cabinetsbay\Block\Category;
use Magento\Catalog\Model\Category as C;
use Magento\Framework\App\Filesystem\DirectoryList;
class View extends \Magento\Catalog\Block\Category\View {
	/**
	 * 2024-01-02
	 * @used-by vendor/cabinetsbay/catalog/view/frontend/templates/category/tabs/overview.phtml (https://github.com/cabinetsbay/site/issues/105)
	 * @return array(string => string)
	 */
	function images():array {$r = []; /** @var array(string => string)  $r */
		$path = 'wysiwyg/catalog-carousel-images/'; /** @var string $path */
		if ($p = $this->l3()) {
			if (is_dir($d = getcwd() . '/' . DirectoryList::MEDIA . '/' . $path . $p->getId())) {
				$dh = opendir($d);
				$ff = [];
				while (false !== ($f = readdir($dh))) {
					$ff[] = 'wysiwyg/catalog-carousel-images/' . $p->getId() . '/' . $f;
				}
				$r = df_sort(df_trim_text_left(df_eta(preg_grep('/\.jpg|\.png|\.gif$/i', $ff)), $path));
				$r = array_combine($r, df_mvar_n($r));
			}
		}
		return $r;
	}

	/**
	 * 2024-03-13 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * 1) "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * 2) I use `(int)` because @uses \Magento\Framework\Model\AbstractModel::getId() return a string.
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 */
	function isPA():bool {return 4036 === (int)$this->getCurrentCategory()->getId();}

	/**
	 * 2024-03-13 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * 1) "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * 2) I use `(int)` because @uses \Magento\Framework\Model\AbstractModel::getId() return a string.
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 */
	function isRTA():bool {return 3411 === (int)$this->getCurrentCategory()->getId();}

	/**
	 * 2024-03-10 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @see cb_category_is_l2()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 */
	function level():int {return df_category_level($this->getCurrentCategory());}

	/**
	 * 2024-01-02
	 * 2024-03-10
	 * 1.1) https://3v4l.org/3ssAP
	 * 1.2) https://www.php.net/manual/migration71.new-features.php#migration71.new-features.nullable-types
	 * 2.1) Level 0: «Root Catalog».
	 * 2.2) Level 1: «Default Category».
	 * 2.3) Level 2:
	 * 		«Ready to Assemble Cabinets»
	 * 		«Pre-Assembled Cabinets»
	 * 		«Cabinet Organizers & Hardware»
	 * 2.4) Level 3: «Steam White Shaker».
	 * @used-by self::images()
	 * @used-by self::l3a()
	 * @used-by self:l3p()
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/view.phtml
	 * @used-by vendor/cabinetsbay/catalog/view/frontend/templates/category/tabs/overview.phtml (https://github.com/cabinetsbay/site/issues/105)
	 */
	function l3():?C {return dfc($this, function() {return df_category_ancestor_at_level($this->getCurrentCategory(), 3);});}

	/**
	 * 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by vendor/cabinetsbay/catalog/view/frontend/templates/category/tabs.phtml (https://github.com/cabinetsbay/site/issues/105)
	 * @used-by vendor/cabinetsbay/catalog/view/frontend/templates/category/tabs/matching-styles.phtml (https://github.com/cabinetsbay/site/issues/105)
	 */
	function l3a(string $n):string {return df_cms_filter_page((string)$this->l3()[$n]);}

	/**
	 * @uses df_category()
	 * @used-by vendor/cabinetsbay/catalog/view/frontend/templates/category/tabs.phtml (https://github.com/cabinetsbay/site/issues/105)
	 * @return C[]
	 */
	function l3p():array {
		$c = $this->l3(); /** @var C $c */
		$s = $c['cb_matching_products']; /** @var string $s */
		return df_map('df_category', df_try(
			function() use($s):array {return df_csv_parse_int($s);}
			,function() use($c, $s) {df_error(
				"The value «{$s}» is invalid for the atrribute `cb_matching_products` of the current category ({$c->getId()})."
				. "\nExcepted a comma-separated list of natural numbers."
			);}
		));
	}

	/**
	 * 2024-03-25 Dmitrii Fediuk https://upwork.com/fl/mage2pro
	 * "Refactor the `Sharapov_Cabinetsbay` module": https://github.com/cabinetsbay/site/issues/98
	 * @used-by app/design/frontend/Cabinetsbay/cabinetsbay_default/Magento_Catalog/templates/category/header.phtml (https://github.com/cabinetsbay/site/issues/105)
	 */
	function title():string {return dfc($this, function():string {
		$c = $this->getCurrentCategory(); /** @var C $c */
		# 2024-03-11 Dmitrii Fediuk https://upwork.com/fl/mage2pro
		# "On frontend category pages of levels 3 and below,
		# the name of a higher level category is mistakenly used for the H1 tag": https://github.com/cabinetsbay/site/issues/107
		// 2024-04-20 "Move `<sub>` out of `<h1>` on the frontend category pages": https://github.com/cabinetsbay/site/issues/141
		return df_cc_n(df_tag('h1', 'page-title', $c->getName()), df_tag('sub', 'cb-title', $c->getParentCategory()->getName()));
	});}
}