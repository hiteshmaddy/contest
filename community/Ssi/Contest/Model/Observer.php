<?php

class Ssi_Contest_Model_Observer {

    public function customerRegisterSuccess(Varien_Event_Observer $observer) {
        //$AccountController = $observer->getEvent()->getAccountController();
        $customer = $observer->getEvent()->getCustomer();
        $email = $customer->getEmail();
        $name = $customer->getName();

        $customer_address = Mage::getModel('customer/customer')->load($customer->getId());
        $customerAddress = array();
        foreach ($customer->getAddresses() as $address) {
            $customerAddress = $address->toArray();
        }

        $city = $customerAddress['city'];
        $state = $customerAddress['region'];
        $pincode = $customerAddress['postcode'];
        $contactnumber = $customerAddress['telephone'];
        $address = $customerAddress['street'];
        // echo $question = Mage::getSingleton('core/session')->getQuestion();
        // exit;
        $question = Mage::getModel('core/cookie')->get('Question');
        $connection = Mage::getSingleton('core/resource')->getConnection('core_write');

        $sql = $connection->select()
                ->from('contest', array('*')) // select * from tablename or use array('id','title') selected values
                ->where('email= ?', $email);
        $rows = $connection->fetchAll($sql);

        if (!$rows) {
            $connection->beginTransaction();

            $fields = array();
            $fields['name'] = strip_tags($name);
            $fields['gender'] = strip_tags($gender);
            $fields['email'] = strip_tags($email);
            $fields['contactnumber'] = strip_tags($contactnumber);
            $fields['city'] = strip_tags($city);
            $fields['state'] = strip_tags($state);
            $fields['pincode'] = strip_tags($pincode);
            $fields['question'] = strip_tags($question);

            if ($connection->insert('contest', $fields))
                ;
            $connection->commit();
            Mage::getModel('core/cookie')->delete('Question');
        }
    }

    public function customerLogin(Varien_Event_Observer $observer) {
        $customer = $observer->getEvent()->getCustomer();
        $email = $customer->getEmail();
        $name = $customer->getName();

        $customer_address = Mage::getModel('customer/customer')->load($customer->getId());
        $customerAddress = array();
        foreach ($customer->getAddresses() as $address) {
            $customerAddress = $address->toArray();
        }

        $city = $customerAddress['city'];
        $state = $customerAddress['region'];
        $pincode = $customerAddress['postcode'];
        $contactnumber = $customerAddress['telephone'];
        $address = $customerAddress['street'];

        $question = Mage::getModel('core/cookie')->get('Question');

        $questionp = $_POST['Question'];


        if (isset($question) && $question != '') {

            $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
            $sql = $connection->select()
                    ->from('contest', array('*')) // select * from tablename or use array('id','title') selected values
                    ->where('email= ?', $email);
            $rows = $connection->fetchAll($sql);

            if (!$rows) {
                $connection->beginTransaction();

                $fields = array();
                $fields['name'] = strip_tags($name);
                $fields['gender'] = strip_tags($gender);
                $fields['email'] = strip_tags($email);
                $fields['contactnumber'] = strip_tags($contactnumber);
                $fields['city'] = strip_tags($city);
                $fields['state'] = strip_tags($state);
                $fields['pincode'] = strip_tags($pincode);
                $fields['question'] = strip_tags($question);

                $connection->insert('contest', $fields);
                $connection->commit();
                Mage::getModel('core/cookie')->delete('Question');
            } else if (isset($questionp) && $questionp != '') {
                $connection = Mage::getSingleton('core/resource')->getConnection('core_write');
                $sql = $connection->select()
                        ->from('contest', array('*')) // select * from tablename or use array('id','title') selected values
                        ->where('email= ?', $email);
                $rows = $connection->fetchAll($sql);

                if (!$rows) {
                    $connection->beginTransaction();

                    $fields = array();
                    $fields['name'] = strip_tags($name);
                    $fields['gender'] = strip_tags($gender);
                    $fields['email'] = strip_tags($email);
                    $fields['contactnumber'] = strip_tags($contactnumber);
                    $fields['city'] = strip_tags($city);
                    $fields['state'] = strip_tags($state);
                    $fields['pincode'] = strip_tags($pincode);
                    $fields['question'] = strip_tags($questionp);

                    $connection->insert('contest', $fields);
                    $connection->commit();
                    Mage::getModel('core/cookie')->delete('Question');
                }
            }
        }
    }

}
