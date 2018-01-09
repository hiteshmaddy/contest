<?php

$installer = $this;

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('contest')};
CREATE TABLE {$this->getTable('contest')} (
 `id` int(11) NOT NULL AUTO_INCREMENT,   
 `name` varchar(50) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT 'Male',
  `email` varchar(150) DEFAULT NULL,
  `contactnumber` varchar(12) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `question` varchar(500) DEFAULT NULL,  
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
  ");

$installer->endSetup(); 