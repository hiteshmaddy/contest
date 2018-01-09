<?php

class Ssi_Contest_Block_Adminhtml_Contest_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'contest';             
        $this->_controller = 'adminhtml_contest';
        
       // $this->_updateButton('save', 'label', Mage::helper('contest')->__('Save Contest'));
        $this->_updateButton('delete', 'label', Mage::helper('contest')->__('Delete Record'));
		
        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
        $this->_removeButton('save');  
        $this->_removeButton('reset');   
        $this->_removeButton('saveandcontinue'); 
    }

    public function getHeaderText()
    {
        if( Mage::registry('contest') && Mage::registry('contest')->getId() ) {
            return Mage::helper('contest')->__("Edit '%s'", $this->htmlEscape(Mage::registry('contest')->getTitle()));
        } else {
            return Mage::helper('contest')->__('Contest');
        }
    }
}