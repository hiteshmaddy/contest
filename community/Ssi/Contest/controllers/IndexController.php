<?php
class Ssi_Contest_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
//        if(!Mage::getSingleton('customer/session')->isLoggedIn()) {  // if not logged in
//            header("Status: 301");
//            header('Location: '.Mage::getUrl('customer/account/login'));  // send to the login page
//            exit; 
//        }
        $this->loadLayout(); 
        $block = $this->getLayout()
                ->createBlock('Mage_Core_Block_Template','contest',array('template'=>'contest/contest.phtml')                            
            );        
        $this->getLayout()->getBlock('root')->setTemplate('page/customcolumn.phtml');
        $this->getLayout()->getBlock('content')->append($block);
        $this->renderLayout();
    }
}