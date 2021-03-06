<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

/**
 * Newsletter templates grid block action item renderer
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magento\Newsletter\Block\Adminhtml\Template\Grid\Renderer;

class Action extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Action
{
    /**
     * Renderer for "Action" column in Newsletter templates grid
     *
     * @param \Magento\Framework\Object $row
     * @return string
     */
    public function render(\Magento\Framework\Object $row)
    {
        if ($row->isValidForSend()) {
            $actions[] = [
                'url' => $this->getUrl('*/queue/edit', ['template_id' => $row->getId()]),
                'caption' => __('Queue Newsletter...'),
            ];
        }

        $actions[] = [
            'url' => $this->getUrl('*/*/preview', ['id' => $row->getId()]),
            'popup' => true,
            'caption' => __('Preview'),
        ];

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
}
