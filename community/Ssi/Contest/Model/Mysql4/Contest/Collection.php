<?php

class Ssi_Contest_Model_Mysql4_Contest_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('contest/contest');
    }
}