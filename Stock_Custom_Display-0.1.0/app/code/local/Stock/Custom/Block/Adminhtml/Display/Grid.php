<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 16:35
 */

/**
 * Stock Custom Grid
 *
 * @category Stock
 * @package Stock_Custom_Adminhtml
 */
class Stock_Custom_Block_Adminhtml_Display_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	/**
	 * Initialize grid
	 * Set sort settings
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setDefaultSort('id');
		$this->setId('stock_custom_display_grid');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	/**
	 * Set collection
	 *
	 * @return Stock_Custom_Block_Adminhtml_Display_Grid
	 */
	protected function _prepareCollection()
	{
		$collection = Mage::getModel('stock_custom/display')->getCollection();
		foreach ($collection as $link) {
			if ($link->getStoreId() && $link->getStoreId() != 0) {
				$link->setStoreId(explode(',', $link->getStoreId()));
			} else {
				$link->setStoreId(array('0'));
			}
		}
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareMassaction()
	{
		$this->setMassactionIdField('id');
		$this->getMassactionBlock()->setFormFieldName('display_ids');

		$this->getMassactionBlock()->addItem('delete', array(
			'label' => Mage::helper('stock_custom')->__('Delete'),
			'url' => $this->getUrl('*/*/massDelete'),
			'confirm' => Mage::helper('stock_custom')->__('Are you sure?')
		));

		Mage::dispatchEvent('adminhtml_catalog_product_grid_prepare_massaction', array('block' => $this));
		return $this;
	}

	/**
	 * Add grid columns
	 * @return Stock_Custom_Block_Adminhtml_Display_Grid
	 */
	protected function _prepareColumns()
	{

		$this->addColumn('id',
			array(
				'header' => $this->__('ID'),
				'align' => 'right',
				'width' => '30px',
				'index' => 'id'
			)
		);

		$this->addColumn('title',
			array(
				'header' => $this->__('Title'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'title'
			)
		);

		$this->addColumn('title',
			array(
				'header' => $this->__('Title'),
				'width' => '250px',
				'index' => 'title'
			)
		);

		$this->addColumn('type', array(
			'header' => Mage::helper('stock_custom')->__('Status'),
			'index' => 'type',
			'type' => 'options',
			'width' => '100px',
			'options' => array(
				0 => Mage::helper('stock_custom')->__('Text only'),
				1 => Mage::helper('stock_custom')->__('Text and Image'),
				2 => Mage::helper('stock_custom')->__('Image only')
			),
		));

		if (!Mage::app()->isSingleStoreMode()) {
			$this->addColumn('store_id', array(
				'header' => Mage::helper('stock_custom')->__('Store View'),
				'index' => 'store_id',
				'type' => 'store',
				'width' => '160px',
				'store_all' => true,
				'store_view' => true,
				'sortable' => true,
				'filter_condition_callback'
				=> array($this, '_filterStoreCondition'),
			));
		}

		$this->addColumn('is_active', array(
			'header' => Mage::helper('stock_custom')->__('Status'),
			'index' => 'is_active',
			'type' => 'options',
			'width' => '60px',
			'options' => array(
				1 => Mage::helper('stock_custom')->__('Active'),
				0 => Mage::helper('stock_custom')->__('Inactive')
			),
		));

		$this->addColumn('create_date',
			array(
				'header' => $this->__('Create Date'),
				'align' => 'right',
				'width' => '50px',
				'index' => 'create_date'
			)
		);

		parent::_prepareColumns();
		return $this;
	}


	/**
	 * Retrieve row click URL
	 *
	 * @param Varien_Object $row
	 *
	 * @return string
	 */
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}