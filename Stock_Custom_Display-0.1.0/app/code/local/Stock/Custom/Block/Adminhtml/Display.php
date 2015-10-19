<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 16:22
 */
class Stock_Custom_Block_Adminhtml_Display extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
	{
		$this->_blockGroup = Mage::helper('stock_custom')->__('stock_custom');
		$this->_controller = Mage::helper('stock_custom')->__('adminhtml_display');
		$this->_headerText = Mage::helper('stock_custom')->__('Custom Stock Display');
		parent::__construct();
	}
}