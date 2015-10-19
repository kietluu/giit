<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 16:16
 */

/**
 * Backend Stock Custom Display controller
 *
 * @category    Stock
 * @package     Stock_Custom_Adminhtml
 */
class Stock_Custom_Adminhtml_Displaycontroller extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction()
	{
		$this->loadLayout()
			->_setActiveMenu('catalog/stock_custom_display')
			->_title($this->__('Catalog'))->_title($this->__('Custom Stock Display'))
			->_addBreadcrumb(
				$this->__('Catalog'),
				$this->__('Catalog')
			)
			->_addBreadcrumb(
				$this->__('Custom Stock Display'),
				$this->__('Custom Stock Display')
			);
		return $this;
	}

	public function indexAction()
	{
		$this->_title($this->__('Catalog'))->_title($this->__('Stock Custom Display'));
		$this->_initAction()
			->renderLayout();
	}

	public function newAction()
	{
		$this->_forward('edit');
	}

	public function editAction()
	{

		$this->_title($this->__('Catalog'))->_title($this->__('Stock Custom Display'));

		$id = $this->getRequest()->getParam('id');
		$model = Mage::getModel('stock_custom/display');

		if ($id) {
			$model->load($id);
			if (!$model->getId()) {
				Mage::getSingleton('adminhtml/session')->addError(
					Mage::helper('stock_custom')->__('This stock display no longer exists.')
				);
				$this->_redirect('*/*');
				return;
			}
		}

		$this->_title($model->getId() ? $model->getName() : $this->__('New Stock Custom Display'));
		// set entered data if was error when we do save
		$data = Mage::getSingleton('adminhtml/session')->getDisplayData(true);

		if (!empty($data)) {
			$model->setData($data);
		} elseif (!$model->getId()) {
			$model->setData(array(
				'text_default' => '%qty% items left',
				'text_out_stock' => 'Product is not available now',
				'store_id' => 0,
				'create_date' => Mage::getModel('core/date')->date(),
				'is_active' => 1
			));
		}

		Mage::register('stock_custom', $model);

		$this->_initAction()
			->_addBreadcrumb(
				$id ? $this->__('Edit Stock Display') : $this->__('New Stock Display'),
				$id ? $this->__('Edit Stock Display') : $this->__('New Stock Display'))
			->_addContent(
				$this->getLayout()
					->createBlock('stock_custom/adminhtml_display_edit')
					->setData('action', $this->getUrl('*/stock_custom/save'))
			)
			->renderLayout();
	}

	public function saveAction()
	{
		if ($this->getRequest()->getPost()) {
			try {
				$model = Mage::getModel('stock_custom/display');
				$data = $this->getRequest()->getPost();

				// save store_id
				if (isset($data['stores'])) {
					if (in_array('0', $data['stores'])) {
						$data['store_id'] = '0';
					} else {
						$data['store_id'] = implode(",", $data['stores']);
					}
					unset($data['stores']);
				}

				$model->setData($data);

				Mage::getSingleton('adminhtml/session')->setPageData($model->getData());

				$model->save();
				Mage::getSingleton('adminhtml/session')->addSuccess(
					Mage::helper('stock_custom')->__('The stock display has been saved.')
				);
				Mage::getSingleton('adminhtml/session')->setPageData(false);
			} catch (Mage_Core_Exception $e) {
				$this->_getSession()->addError($e->getMessage());
			} catch (Exception $e) {
				$this->_getSession()->addError(
					Mage::helper('catalogrule')->__('An error occurred while saving the stock display data. Please review the log and try again.')
				);
				Mage::logException($e);
				Mage::getSingleton('adminhtml/session')->setPageData($data);
				$this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
				return;
			}
		}
		$this->_redirect('*/*/');
	}

	public function deleteAction()
	{
		try {
			$id = $this->getRequest()->getParam('id');
			if ($id) {
				if ($registry = Mage::getModel('stock_custom/display')->load($id)) {
					$registry->delete();
					$successMessage = Mage::helper('stock_custom')->__('Stock display has been succesfully deleted.');
					Mage::getSingleton('core/session')->addSuccess($successMessage);
					$this->_redirect('*/*/');
				} else {
					throw new Exception("There was a problem deleting the stock display!");
				}
			}
		} catch (Exception $e) {
			Mage::getSingleton('core/session')->addError($e->getMessage());
			$this->_redirect('*/*/');
		}
	}

	public function massDeleteAction()
	{
		$displayIds = $this->getRequest()->getParam('display_ids');
		if (!is_array($displayIds)) {
			$this->_getSession()->addError($this->__('Please select product(s).'));
		} else {
			if (!empty($displayIds)) {
				try {
					foreach ($displayIds as $displayId) {
						$display = Mage::getSingleton('stock_custom/display')->load($displayId);
						Mage::dispatchEvent('stock_custom_controller_display_delete', array('display' => $display));
						$display->delete();
					}
					$this->_getSession()->addSuccess(
						$this->__('Total of %d record(s) have been deleted.', count($displayIds))
					);
				} catch (Exception $e) {
					$this->_getSession()->addError($e->getMessage());
				}
			}
		}
		$this->_redirect('*/*/index');
	}

	protected function _isAllowed()
	{
		return Mage::getSingleton('admin/session')->isAllowed('catalog/stock_custom_display');
	}
}