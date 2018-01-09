 <?php
    class Ssi_Contest_Model_Observer {
        
        public function customerRegisterSuccess(Varien_Event_Observer $observer) {
        //$AccountController = $observer->getEvent()->getAccountController();
        //$customer = $observer->getEvent()->getCustomer();  
              echo "<pre>";
                    print_r($_SESSION);
                    echo "</pre>";
                    exit;
        $email = Mage::getSingleton('core/session')->getEmail();
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
    
        $sql = $connection->select()
                            ->from('contest', array('*')) // select * from tablename or use array('id','title') selected values
                            ->where('email= ?', $email);
        $rows = $connection->fetchAll($sql);

        if (!$rows) {       
            $connection->beginTransaction();

            $fields = array();
            $fields['name'] = strip_tags(Mage::getSingleton('core/session')->getName());
            $fields['gender'] = strip_tags(Mage::getSingleton('core/session')->getGender());
            $fields['email'] = strip_tags(Mage::getSingleton('core/session')->getEmail());
            $fields['contactnumber'] = strip_tags(Mage::getSingleton('core/session')->getContactNumber());
            $fields['city'] = strip_tags(Mage::getSingleton('core/session')->getCity());
            $fields['state'] = strip_tags(Mage::getSingleton('core/session')->getState());
            $fields['pincode'] = strip_tags(Mage::getSingleton('core/session')->getPinCode());
            $fields['question'] = strip_tags( Mage::getSingleton('core/session')->getQuestion());
            $connection->insert('contest', $fields);
        }
       // Mage::app()->getRequest()->setParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_SUCCESS_URL, $redirectUrl);
      }
    }