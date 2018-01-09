<?php

class Ssi_Contest_Adminhtml_ContestController extends Mage_Adminhtml_Controller_action {

    protected function _initAction() {       
        
        $this->loadLayout()
            ->_setActiveMenu('Ssi/contest')
            ->_title($this->__('Ssi'))->_title($this->__('Contest'))
            ->_addBreadcrumb($this->__('Ssi'), $this->__('Ssi'))
            ->_addBreadcrumb($this->__('Contest'), $this->__('Contest'));
        return $this;
    }

    public function indexAction() {
        
        $this->_initAction(); 
       
        $this->renderLayout();
    }

    public function newAction() {
        $this->_forward('edit');
    }
    
    public function editAction()
    {
       $id  = $this->getRequest()->getParam('id');
       $model  = Mage::getModel('contest/contest')->load($id);

        if ($model->getId() || $id == 0) {
                $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
                if (!empty($data)) {
                        $model->setData($data);
                }
                Mage::register('contest_data', $model);
                $this->loadLayout();
                $this->_setActiveMenu('Ssi/contest');
                $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Contest'), Mage::helper('adminhtml')->__('Contest Manager'));                               
                $this->_addContent($this->getLayout()->createBlock('contest/adminhtml_contest_edit'));
                $this->renderLayout();
        } else {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('contest')->__('Record does not exist'));
                $this->_redirect('*/*/');
        }
    }
    
   

    public function deleteAction() {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('contest/contest');

                $model->setId($this->getRequest()->getParam('id'))
                        ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Record was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }  
    
     protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('ssi_contest');
    }
	
	public function exportCsvAction()
    {
        $fileName   = 'contest.csv';
        $content    = $this->getLayout()->createBlock('contest/adminhtml_contest_grid')
        ->getCsvFile();
        $this->_prepareDownloadResponse($fileName, $content);
    }
    
    protected function _sendUploadResponse($fileName, $content, $contentType='application/octet-stream')
    {
        $this->_prepareDownloadResponse($fileName, $content, $contentType);
    }

}
