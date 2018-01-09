<?php

class Ssi_Contest_Block_Adminhtml_Contest_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    /* call parent constructor */
    public function _construct() {      
        parent::_construct();
        $this->setId('contestGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
    
    /* Get the collection from database table */
    protected function _prepareCollection() {
        $collection = Mage::getModel('contest/contest')->getCollection();                
        //$collection->load(true);
        //var_dump($collection);
        $this->setCollection($collection);         
        return parent::_prepareCollection();
    }
    
    /* Prepare column for grid */
    protected function _prepareColumns()
    {
      $this->addColumn('id', array(
          'header'    => Mage::helper('contest')->__('ID'),
          'align'     =>'center',
          'width'     => '10px',
          'index'     => 'id',
      ));

      $this->addColumn('name', array(
          'header'    => Mage::helper('contest')->__('Name'),
          'align'     =>'left',
          'width'     => '30px',
          'index'     => 'name',
      ));
      
      $this->addColumn('gender', array(
          'header'    => Mage::helper('contest')->__('Gender'),
          'align'     =>'left',
          'width'     => '20px',
          'index'     => 'gender',
      ));
      
      $this->addColumn('email', array(
          'header'    => Mage::helper('contest')->__('Email'),
          'align'     =>'left',
          'width'     => '40px',
          'index'     => 'email',
      ));
      
      $this->addColumn('contactnumber', array(
          'header'    => Mage::helper('contest')->__('ContactNumber'),
          'align'     =>'left',
          'width'     => '15px',
          'index'     => 'contactnumber',
      ));
      
      $this->addColumn('city', array(
          'header'    => Mage::helper('contest')->__('City'),
          'align'     =>'left',
          'width'     => '30px',
          'index'     => 'city',
      ));
      
      $this->addColumn('state', array(
          'header'    => Mage::helper('contest')->__('State'),
          'align'     =>'left',
          'width'     => '30px',
          'index'     => 'state',
      ));
      
      $this->addColumn('pincode', array(
          'header'    => Mage::helper('contest')->__('Pincode'),
          'align'     =>'left',
          'width'     => '30px',
          'index'     => 'pincode',
        ));
      
        $this->addColumn('question', array(
          'header'    => Mage::helper('contest')->__('Question'),
          'align'     =>'left',
          'width'     => '150px',
          'index'     => 'question',
      ));   
        
      $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('contest')->__('Action'),
                'width'     => '25',
                'align'     => 'center',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('contest')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));  
	
	$this->addExportType('*/*/exportCsv', Mage::helper('contest')->__('CSV'));
    return parent::_prepareColumns();
  }
  protected function _prepareMassaction() {
        
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('contest')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('code')->__('Are you sure?')
        ));
        
        return $this;   
    }

    public function getRowUrl($row) {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }  
}
