<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 16:55
 */

/**
 * Stock Custom edit form display
 */
class Stock_Custom_Block_Adminhtml_Display_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
	/**
	 * Initialize form
	 * Add standard buttons
	 * Update label standard buttons
	 * Add "Save and Continue" button
	 */
	public function __construct()
	{

		$this->_blockGroup = 'stock_custom';
		$this->_controller = 'adminhtml_display';

		parent::__construct();
	}

	/**
	 * Getter for form header text
	 *
	 * @return string
	 */
	public function getHeaderText()
	{
		$display = Mage::registry('stock_custom');
		if ($display->getId()) {
			return Mage::helper('stock_custom')->__('Edit stock display');
		} else {
			return Mage::helper('stock_custom')->__('New stock display');
		}
	}

}