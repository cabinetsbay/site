<?php
namespace WeltPixel\GA4\Model;

/**
 * Class \WeltPixel\GA4\Model\ServerSideStorage
 */
class ServerSideStorage extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry
    )
    {
        parent::__construct($context, $registry);
    }
}
