<?php
class Ssi_Contest_Block_Adminhtml_Contest extends Mage_Adminhtml_Block_Widget_Grid_Container
{
  public function __construct()
  {    
      
        $this->_blockGroup = 'contest';
        $this->_controller = 'adminhtml_contest';
        $this->_headerText = $this->__('Contestants');
       
        parent::__construct(); 
        $this->_removeButton('add');      
  }
  
}