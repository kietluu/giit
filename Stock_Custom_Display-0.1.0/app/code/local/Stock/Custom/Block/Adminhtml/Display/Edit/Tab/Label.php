<?php

/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 15/10/2015
 * Time: 16:41
 */
class Stock_Custom_Block_Adminhtml_Display_Edit_Tab_Label extends Mage_Adminhtml_Block_Widget_Form
	implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

	/**
	 * Return Tab label
	 *
	 * @return string
	 */
	public function getTabLabel()
	{
		return Mage::helper('stock_custom')->__('Labels');
	}

	/**
	 * Return Tab title
	 *
	 * @return string
	 */
	public function getTabTitle()
	{
		return Mage::helper('stock_custom')->__('Labels');
	}

	/**
	 * Can show tab in tabs
	 *
	 * @return boolean
	 */
	public function canShowTab()
	{
		return true;
	}

	/**
	 * Tab is hidden
	 *
	 * @return boolean
	 */
	public function isHidden()
	{
		return false;
	}


	protected function _prepareForm()
	{
		$model = Mage::registry('stock_custom');
		$form = new Varien_Data_Form();

		$form->setHtmlIdPrefix('display_');

		$fieldset = $form->addFieldset('base_fieldset', array(
			'legend' => Mage::helper('stock_custom')->__('Default'),
			'class' => 'fieldset-wide'
		));


		$fieldset->addField('text_default', 'text', array(
			'name' => 'text_default',
			'label' => Mage::helper('stock_custom')->__('Text'),
			'title' => Mage::helper('stock_custom')->__('Text'),
		));

//		$fieldset->addField('image_default', 'image', array(
//			'label' => Mage::helper('stock_custom')->__('Image'),
//			'title' => Mage::helper('stock_custom')->__('Image'),
//		));

		$fieldset_outstock = $form->addFieldset('outstock_fieldset', array(
			'legend' => Mage::helper('stock_custom')->__('Out of stock'),
			'class' => 'fieldset-wide'
		));

		$fieldset_outstock->addField('text_out_stock', 'text', array(
			'name' => 'text_out_stock',
			'label' => Mage::helper('stock_custom')->__('Text'),
			'title' => Mage::helper('stock_custom')->__('Text'),
		));

//		$fieldset_outstock->addField('image_out_stock', 'image', array(
//			'label' => Mage::helper('stock_custom')->__('Image'),
//			'title' => Mage::helper('stock_custom')->__('Image'),
//		));


		$form->setValues($model->getData());
		$this->setForm($form);

		Mage::dispatchEvent('adminhtml_stock_custom_edit_tab_main_prepare_form', array('form' => $form));

		return parent::_prepareForm();
	}
}