<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\GiftMessage\Block\Message\Multishipping\Plugin;

/**
 * Multishipping items box plugin
 */
class ItemsBox
{
    /**
     * Gift message helper
     *
     * @var \Magento\GiftMessage\Helper\Message
     */
    protected $helper;

    /**
     * Construct
     *
     * @param \Magento\GiftMessage\Helper\Message $helper
     */
    public function __construct(\Magento\GiftMessage\Helper\Message $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Get items box message text for multishipping
     *
     * @param \Magento\Multishipping\Block\Checkout\Shipping $subject
     * @param callable $proceed
     * @param \Magento\Framework\Object $addressEntity
     *
     * @return string
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundGetItemsBoxTextAfter(
        \Magento\Multishipping\Block\Checkout\Shipping $subject,
        \Closure $proceed,
        \Magento\Framework\Object $addressEntity
    ) {
        $itemsBoxText = $proceed($addressEntity);
        return $itemsBoxText . $this->helper->getInline('multishipping_address', $addressEntity);
    }
}
