<?php
/**
 * Created by PhpStorm.
 * User: kietluu
 * Date: 09/10/2015
 * Time: 09:23
 */
class Stock_Custom_Model_Resource_Display_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract{
	public function _construct()
	{
		$this->_init('stock_custom/display');
	}
}