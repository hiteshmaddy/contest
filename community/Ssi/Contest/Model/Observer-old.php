 <?php
    class Ssi_Contest_Model_Observer {
        
        public function customerRegisterSuccess(Varien_Event_Observer $observer) {
        $AccountController = $observer->getEvent()->getAccountController();
        $customer = $observer->getEvent()->getCustomer();
        $response1 = Mage::app()->getResponse(); // observers have event args
        $redirectUrl = 'http://122.248.249.90/sattvademo/index.php/contest/';       
        $response1->setRedirect($url);
        Mage::app()->getRequest()->setParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_SUCCESS_URL, $redirectUrl);

      }
    }