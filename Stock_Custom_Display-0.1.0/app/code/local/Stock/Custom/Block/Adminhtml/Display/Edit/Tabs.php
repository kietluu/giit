<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 15/10/2015
 * Time: 11:09
 */
class Stock_Custom_Block_Adminhtml_Display_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs{
	public function __construct()
	{
		parent::__construct();
		$this->setId('stock_custom_display_tabs');
		$this->setDestElementId('edit_form');
		$this->setTitle(Mage::helper('stock_custom')->__('Stock Custom Display'));
	}
}