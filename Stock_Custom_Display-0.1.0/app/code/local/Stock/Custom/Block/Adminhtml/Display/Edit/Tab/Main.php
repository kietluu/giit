<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 15/10/2015
 * Time: 11:14
 */

/**
 * Stock Custom General Information Tab
 *
 * @category Stock
 * @package Stock_Custom_Adminhtml
 */
class Stock_Custom_Block_Adminhtml_Display_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
	implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

	/**
	 * Return Tab label
	 *
	 * @return string
	 */
	public function getTabLabel()
	{
		return Mage::helper('stock_custom')->__('General');
	}

	/**
	 * Return Tab title
	 *
	 * @return string
	 */
	public function getTabTitle()
	{
		return Mage::helper('stock_custom')->__('General');
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
			'legend' => Mage::helper('stock_custom')->__('General Information'),
			'class' => 'fieldset-wide'
		));

		if ($model->getId()) {
			$fieldset->addField('id', 'hidden', array(
				'name' => 'id',
			));
		}else{
			$fieldset->addField('create_date', 'hidden', array(
				'name' => 'create_date',
			));
		}

		$fieldset->addField('title', 'text', array(
			'name' => 'title',
			'label' => Mage::helper('stock_custom')->__('Stock Display Title'),
			'title' => Mage::helper('stock_custom')->__('Stock Display Title'),
			'required' => true,
		));

		$fieldset->addField('is_active', 'select', array(
			'label' => Mage::helper('stock_custom')->__('Status'),
			'title' => Mage::helper('stock_custom')->__('Status'),
			'name' => 'is_active',
			'options' => array(
				1 => Mage::helper('stock_custom')->__('Active'),
				0 => Mage::helper('stock_custom')->__('Inactive'),
			),
		));

		$fieldset->addField('type', 'select', array(
			'label' => Mage::helper('stock_custom')->__('Type'),
			'title' => Mage::helper('stock_custom')->__('Type'),
			'name' => 'type',
			'options' => array(
				'0' => Mage::helper('stock_custom')->__('Text only'),
				'1' => Mage::helper('stock_custom')->__('Text and image'),
				'2' => Mage::helper('stock_custom')->__('Image only'),
			),
		));

		if (!Mage::app()->isSingleStoreMode()) {
			$fieldset->addField('store_id', 'multiselect', array(
				'name' => 'stores[]',
				'label' => Mage::helper('stock_custom')->__('Store View'),
				'title' => Mage::helper('stock_custom')->__('Store View'),
				'required'  => true,
				'values' => Mage::getSingleton('adminhtml/system_store')
							->getStoreValuesForForm(false, true),
			));
		} else {
			$fieldset->addField('store_id', 'hidden', array(
				'name' => 'stores[]',
				'value' => Mage::app()->getStore(true)->getId()
			));
		}

		$form->setValues($model->getData());
		$this->setForm($form);

		Mage::dispatchEvent('adminhtml_stock_custom_edit_tab_main_prepare_form', array('form' => $form));

		return parent::_prepareForm();
	}
}