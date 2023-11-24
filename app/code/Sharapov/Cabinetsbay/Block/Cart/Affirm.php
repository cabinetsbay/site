<?php
/**
 * @copyright Sharapov A. <alexander@sharapov.biz>
 * @link      http://www.sharapov.biz/
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License
 * Date: 28.10.2019
 * Time: 23:42
 */

namespace Sharapov\Cabinetsbay\Block\Cart;

class Affirm extends \Magento\Catalog\Block\Category\View {
  public function getGrandTotal() {
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
    return $cart->getQuote()->getGrandTotal();
  }
}
