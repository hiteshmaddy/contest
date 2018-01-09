<?php

class Ssi_Contest_Model_Contest extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('contest/contest');
    }
}