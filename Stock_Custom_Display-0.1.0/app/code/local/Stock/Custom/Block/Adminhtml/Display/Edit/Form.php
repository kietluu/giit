<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 15/10/2015
 * Time: 11:12
 */
class Stock_Custom_Block_Adminhtml_Display_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
	public function __construct()
	{
		parent::__construct();
		$this->setId('stock_custom_form');
		$this->setTitle(Mage::helper('stock_custom')->__('Stock Display Information'));
	}

	protected function _prepareForm()
	{
		$form = new Varien_Data_Form(array(
			'id' => 'edit_form',
			'action' => $this->getUrl('*/*/save', array('id' => $this->getRequest()->getParam('id'))),
			'method' => 'post'));
		$form->setUseContainer(true);
		$this->setForm($form);
		return parent::_prepareForm();
	}
}