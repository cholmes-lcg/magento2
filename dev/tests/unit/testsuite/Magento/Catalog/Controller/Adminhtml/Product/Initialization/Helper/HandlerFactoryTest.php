<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper;

class HandlerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var HandlerFactory
     */
    protected $_model;

    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    protected $_objectManagerMock;

    protected function setUp()
    {
        $this->_objectManagerMock = $this->getMock('\Magento\Framework\ObjectManagerInterface');
        $this->_model = new HandlerFactory($this->_objectManagerMock);
    }

    public function testCreateWithInvalidType()
    {
        $this->setExpectedException(
            '\InvalidArgumentException',
            'Magento\Framework\Object does not implement ' .
            'Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper\HandlerInterface'
        );
        $this->_objectManagerMock->expects($this->never())->method('create');
        $this->_model->create('Magento\Framework\Object');
    }

    public function testCreateWithValidType()
    {
        $this->_objectManagerMock->expects(
            $this->once()
        )->method(
            'create'
        )->with(
            '\Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper\Plugin\Handler\Composite'
        )->will(
            $this->returnValue('object')
        );
        $this->assertEquals(
            'object',
            $this->_model->create(
                '\Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper\Plugin\Handler\Composite'
            )
        );
    }
}
