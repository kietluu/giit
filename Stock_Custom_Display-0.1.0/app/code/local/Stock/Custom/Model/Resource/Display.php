<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 14/10/2015
 * Time: 15:43
 */
class Stock_Custom_Model_Resource_Display extends  Mage_Core_Model_Resource_Db_Abstract{
    protected function _construct()
    {
        $this->_init('stock_custom/display', 'id');
    }
}