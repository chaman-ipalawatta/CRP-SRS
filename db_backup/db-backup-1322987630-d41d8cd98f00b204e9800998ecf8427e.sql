DROP DATABASE `crp_srs`;
CREATE DATABASE `crp_srs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `crp_srs`;




CREATE TABLE `comp_oil_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `oil_type` varchar(45) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO comp_oil_type VALUES("1","PAG60","a");
INSERT INTO comp_oil_type VALUES("2","Ester","a");
INSERT INTO comp_oil_type VALUES("3","PAG100","a");





CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `tele1` varchar(10) DEFAULT NULL,
  `tele2` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `notes` text,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("1","Chaman Ipalawatta","49A Woodland Avenue, Kohuwala, Nugegoda","0112811471","0112828944","0773633327","chaman@gmail.com","","2011-01-01","2011-01-01","a");
INSERT INTO customer VALUES("2","Suraj Ipalawatta","28 Alwis Place, Attidiya, Dehiwala ","0112724076","","0777378126","suraj.ipalawatta@gmail.com","","2011-01-01","2011-01-01","a");
INSERT INTO customer VALUES("3","Sarath Wijesinghe","52/44 Maradana Road, Hendala, Wattala","0112933919","","0717224689","sarath@aqua.lk","","2011-01-01","2011-01-01","a");
INSERT INTO customer VALUES("4","Udesh Rodrigo","40 Nimala Mariya Mawatha, Hendala, Wattala","0112930514","","","info@rodrigoelectricals.com","","2011-01-01","2011-01-01","a");
INSERT INTO customer VALUES("5","Shanaka Kulasinghe","50 Temple Road, Maharagama","","","0777683704","skulasinghe@gmail.com","","2011-01-01","2011-01-01","a");
INSERT INTO customer VALUES("6","Sunil Piyathilaka","650 Main Road, Dondra","","","0771256399","","Suresh\'s cousin","2011-11-02","2011-11-02","a");





CREATE TABLE `make` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO make VALUES("1","Audi","a");
INSERT INTO make VALUES("2","Toyota","a");
INSERT INTO make VALUES("3","Nissans","a");
INSERT INTO make VALUES("4","Tata","d");
INSERT INTO make VALUES("5","Honda","a");
INSERT INTO make VALUES("6","Kia","a");
INSERT INTO make VALUES("7","Ford","a");
INSERT INTO make VALUES("8","Hyundai","a");





CREATE TABLE `model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `make_id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`),
  KEY `fk_model_make` (`make_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO model VALUES("1","1","A4-2011","a");
INSERT INTO model VALUES("2","1","A6-2011","a");
INSERT INTO model VALUES("3","2","121-G","a");
INSERT INTO model VALUES("4","2","141-X","a");
INSERT INTO model VALUES("5","3","B14","a");
INSERT INTO model VALUES("6","3","B15","a");
INSERT INTO model VALUES("9","3","March-K10-1992","a");
INSERT INTO model VALUES("8","1","TTS Coupe-2011","d");
INSERT INTO model VALUES("10","3","March-K11-1997","a");
INSERT INTO model VALUES("11","3","March-K12-2006","a");
INSERT INTO model VALUES("12","7","Laser-BG-1300cc-1992","a");
INSERT INTO model VALUES("13","5","Civic-1983","a");
INSERT INTO model VALUES("14","5","Civic-Gen2-1987","a");
INSERT INTO model VALUES("15","5","Civic-FN-Gen8-2011","a");
INSERT INTO model VALUES("16","8","Elantra-2011","a");
INSERT INTO model VALUES("17","8","Sonata-2010","a");
INSERT INTO model VALUES("18","8","Sonata-2011","d");
INSERT INTO model VALUES("19","8","Accent-2011","a");
INSERT INTO model VALUES("20","6","Rio-2011","a");
INSERT INTO model VALUES("21","6","Rio-LX-2007","a");





CREATE TABLE `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `odometer` int(11) DEFAULT NULL,
  `service_desc` text,
  `next_service` date DEFAULT NULL,
  `notes` text,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  `next_serv_informed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_service_vehicle1` (`vehicle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO service VALUES("1","6","188124","Checked the system for any leaks. None found. Did a full clean up.","2011-11-10","Need to check on the compressor oil on next service ","2011-10-04","2011-11-04","a","1");
INSERT INTO service VALUES("2","6","190019","Checked the compressor oil. Its good for another 10000Kms. Did a full system check. No issues.","2011-04-02","","2011-10-07","2011-11-07","a","1");
INSERT INTO service VALUES("3","3","23410","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2012-04-27","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2011-10-07","2011-11-08","a","0");
INSERT INTO service VALUES("4","5","101221","Replaced the dryer.","2011-11-11","","2011-11-07","2011-11-07","a","1");
INSERT INTO service VALUES("5","4","76012","Replaced the compressor.","2011-11-11","Overall system check on next service.","2011-11-07","2011-11-07","a","0");
INSERT INTO service VALUES("6","2","90902","Fixed the condenser and replaced the filter.","2012-01-10","","2011-11-07","2011-11-07","a","0");
INSERT INTO service VALUES("7","1","122110","Changed the gas type to 134R.","2012-02-11","","2011-11-07","2011-11-07","d","0");
INSERT INTO service VALUES("8","3","36113","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2012-05-12","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2011-11-08","2011-11-08","a","0");
INSERT INTO service VALUES("9","3","45310","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2012-04-21","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2011-11-08","2011-11-08","a","0");
INSERT INTO service VALUES("10","3","188124","sfsdflk assdf sdfsd fsd hgjhj er t tcfvcb xdfd asdsa cxvbv cvbc cvbv cvbvc cvbvc cxx xghjhndd sdvxcxcvb","2012-05-12","sfsdflk assdf sdfsd fsd hgjhj er t tcfvcb xdfd asdsa cxvbv cvbc cvbv cvbvc cvbvc cxx xghjhndd sdvxcxcvb","2011-01-13","2011-11-11","a","0");
INSERT INTO service VALUES("11","3","188124","ldsfkgj dsfg dfgfg  dfgdfg","0000-00-00","dfg dg dfg dfg dfg dfg ","2011-01-13","2011-11-11","a","0");





CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_id` int(11) NOT NULL,
  `comp_oil_type_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `plate_no` varchar(12) DEFAULT NULL,
  `notes` text,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'a',
  PRIMARY KEY (`id`),
  KEY `fk_vehicle_model1` (`model_id`),
  KEY `fk_vehicle_comp_oil_type1` (`comp_oil_type_id`),
  KEY `fk_vehicle_customer1` (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO vehicle VALUES("1","12","1","1","18-3397","","2011-11-02","2011-11-02","a");
INSERT INTO vehicle VALUES("2","2","3","3","WP-KA-9999","","2011-11-02","2011-11-02","a");
INSERT INTO vehicle VALUES("3","11","2","5","WP-HK-2321","Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed hendrerit nisl at velit accumsan aliquam laoreet felis tincidunt. Nam purus diam, egestas eu placerat id, bibendum vitae felis. Ut sollicitudin justo lorem. Ut sit amet tortor dui. Aliquam a ligula vel ante sodales semper eu sit amet mauris. Nunc porttitor ultrices velit. Cras ullamcorper commodo lectus.\n\n\n\nIn et vehicula ipsum. Morbi eros sapien, imperdiet in pretium a, posuere eu odio. Aliquam erat volutpat. Nam scelerisque orci nec to","2011-11-02","2011-11-08","a");
INSERT INTO vehicle VALUES("4","13","2","6","16-SRI-9721","","2011-11-02","2011-11-02","a");
INSERT INTO vehicle VALUES("5","4","3","2","WP-KA-1199","","2011-11-02","2011-11-02","a");
INSERT INTO vehicle VALUES("6","9","2","5","SP-KD-1121","","2011-11-04","2011-11-04","a");



