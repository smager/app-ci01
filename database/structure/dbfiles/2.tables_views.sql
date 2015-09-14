CREATE TABLE IF NOT EXISTS `dbstructures` (
  `dbstruct_id` int(11) NOT NULL AUTO_INCREMENT,
  `object_name` varchar(50) NOT NULL,
  `object_type` varchar(15) NOT NULL,
  `seq_no` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`dbstruct_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `page_templates` (
  `page_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`page_template_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `javascripts` (
  `js_id` int(11) NOT NULL AUTO_INCREMENT,
  `version_id` int(11) DEFAULT NULL,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`js_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `role_desc` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `role_code` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  UNIQUE KEY `roles_uk` (`role_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Menus'

CREATE TABLE IF NOT EXISTS `role_menus` (
  `role_menu_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`role_menu_id`),
  UNIQUE KEY `role_menus_uk` (`role_id`,`menu_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='role_menus'

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_password` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `empl_id` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `active` int(5) NOT NULL DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_uk` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users'

CREATE TABLE IF NOT EXISTS `user_locations` (
  `user_loc_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(5) DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_loc_id`),
  UNIQUE KEY `user_locations_uk` (`user_id`,`loc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User Locations Access'

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `menu_url` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `menu_type_id` int(5) DEFAULT NULL,
  `system_id` int(5) DEFAULT NULL,
  `seq_no` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_id`),
  UNIQUE KEY `menu_uk` (`menu_name`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Menu'

CREATE TABLE IF NOT EXISTS `menu_types` (
  `menu_type_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `menu_type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `seq_no` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`menu_type_id`),
  UNIQUE KEY `menu_types_uk` (`menu_type`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Menu Types'

  CREATE TABLE IF NOT EXISTS `add_on_rate` (
    `holiday_pct`    decimal(5,2),
    `sunday_pct`     decimal(5,2),
    `created_by`     int(5),
    `created_date`   datetime,
    `updated_by`     int(5),
    `updated_date`   datetime
  )
    COMMENT='Add on pct rate Reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

 CREATE TABLE IF NOT EXISTS `adj_types` (
  `adj_type_id`   int(5) unsigned NOT NULL auto_increment,
  `adj_type`      varchar(20) NOT NULL default '',
  `adj_math`      varchar(1) NOT NULL default '',
  `posted`        int(5) NOT NULL default '0',     
  `created_by`    int(5),
  `created_date`  datetime,
  `updated_by`    int(5),
  `updated_date`  datetime,
  PRIMARY KEY `adj_types_pk`  (`adj_type_id`),
  UNIQUE KEY `adj_types_uk` (`adj_type`)
)
  COMMENT='Supply Adjustment'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

CREATE TABLE IF NOT EXISTS `bank_ref` (
 `bank_ref_id`           int(5) unsigned NOT NULL auto_increment,
 `bank_acctno`           varchar(30) NOT NULL default '',
 `bank_acctname`         varchar(50) NOT NULL default '', 
 `bank_name`             varchar(50) NOT NULL default '',
 `acct_amount`           decimal(10,2),
 `depo_pct_share`        int(5),
 `priority_no`           int(5),
 `active`                int(5) NOT NULL default '1', 
 `created_by`            int(5),
 `created_date`          datetime,
 `updated_by`            int(5),
 `updated_date`          datetime,
 PRIMARY KEY `bank_ref_pk` (`bank_ref_id` ),
 UNIQUE KEY `bank_ref_pk_uk` (`bank_acctno`)

)
  COMMENT='Bank Accounts Reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id`      int(5) unsigned NOT NULL auto_increment,
  `brand_name`    varchar(64) NOT NULL default '', 
  `created_by`    int(5),
  `created_date`  datetime,
  `updated_by`    int(5),
  `updated_date`  datetime,
  PRIMARY KEY  `brands_pk`  (`brand_id`),
  UNIQUE KEY  `brands_uk` (`brand_name`)
)
  COMMENT='Brands'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `conv_units` (
  `conv_id`        int(5) unsigned NOT NULL auto_increment,
  `from_unit_id`   varchar(64) NOT NULL default '',
  `conv_unit_id`   varchar(64) NOT NULL default '',
  `conv_unit_qty`  decimal(5,2),
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY  `conv_units_pk`  (`conv_id`),
  UNIQUE KEY  `conv_units_uk` (`from_unit_id`,`conv_unit_id`,`conv_unit_qty` )
)
  COMMENT='Unit of Measures Conversions'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

CREATE TABLE `deductions_ref` (
  `deduction_ref_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `deduction_code` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `deduction_desc` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `deduction_pct` decimal(7,2) DEFAULT NULL,
  `default_amt` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`deduction_ref_id`),
  UNIQUE KEY `deductions_ref_uk` (`deduction_code`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Deductions Reference file'

CREATE TABLE IF NOT EXISTS `denomination_ref` (
  `denomination` decimal(7,2) NOT NULL DEFAULT '0.00',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`denomination`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Money Denomination Reference'

CREATE TABLE IF NOT EXISTS `employees` (
  `empl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `empl_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `store_loc_id` int(5) DEFAULT NULL,
  `position_id` int(5) DEFAULT NULL,
  `active` int(5) NOT NULL DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `daily_rate` decimal(7,2) DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `sss_no` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `pagibig_no` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `ti_no` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `philhealth_no` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`empl_id`),
  UNIQUE KEY `employees_uk` (`empl_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Employees'

CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `event_desc` VARCHAR(50) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`event_id`),
  UNIQUE KEY `events_uk` (`event_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Events reference'

CREATE TABLE IF NOT EXISTS `inv_summ` (
  `inv_summ_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `inv_summ_year` int(5) DEFAULT NULL,
  `inv_summ_month` int(5) DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `beg_qty` decimal(10,2) DEFAULT NULL,
  `dr_qty` decimal(10,2) DEFAULT NULL,
  `used_qty` decimal(10,2) DEFAULT NULL,
  `adj_plus_qty` decimal(10,2) DEFAULT NULL,
  `adj_minus_qty` decimal(10,2) DEFAULT NULL,
  `end_qty` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`inv_summ_id`),
  UNIQUE KEY `inv_summ_uk` (`inv_summ_year`,`inv_summ_month`,`loc_id`,`supply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Inventory Summary'

CREATE TABLE IF NOT EXISTS `locations` (
  `loc_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `location` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `loc_group_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`loc_id`),
  UNIQUE KEY `locations_uk` (`location`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Locations'

CREATE TABLE IF NOT EXISTS `loc_pc` (
  `loc_pc_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `pc_no` int(5) DEFAULT NULL,
  `pc_date` datetime DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  PRIMARY KEY (`loc_pc_id`),
  UNIQUE KEY `loc_pc_uk` (`pc_no`,`loc_id`,`store_loc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Physical Count header per location'

CREATE TABLE IF NOT EXISTS `loc_pc_dtls` (
  `loc_pc_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `loc_pc_id` int(5) DEFAULT NULL,
  `loc_supply_brand_id` int(5) DEFAULT NULL,
  `store_loc_supply_id` int(5) DEFAULT NULL,
  `pc_qty` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`loc_pc_dtl_id`),
  UNIQUE KEY `loc_pc_dtls_uk` (`loc_pc_id`,`loc_supply_brand_id`,`store_loc_supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Physical Count details per location'

CREATE TABLE IF NOT EXISTS `loc_supplies` (
  `loc_supply_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `loc_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `reorder_level` int(5) DEFAULT NULL,
  `max_level` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`loc_supply_id`),
  UNIQUE KEY `loc_supplies_uk` (`loc_id`,`supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=85 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Location Supplies'

CREATE TABLE IF NOT EXISTS `loc_supply_brands` (
  `loc_supply_brand_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `loc_supply_id` int(5) DEFAULT NULL,
  `supply_brand_id` int(5) DEFAULT NULL,
  `stock_qty` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`loc_supply_brand_id`),
  UNIQUE KEY `loc_supply_brands_uk` (`loc_supply_id`,`supply_brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Location Supplies per brand'

CREATE TABLE IF NOT EXISTS `po` (
  `po_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `po_no` int(5) DEFAULT NULL,
  `po_date` datetime DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `supplier_id` int(5) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`po_id`),
  UNIQUE KEY `receiving_uk` (`po_no`,`loc_id`,`supplier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='order header'

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `position_desc` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`position_id`),
  UNIQUE KEY `positions_uk` (`position_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Positions'

CREATE TABLE IF NOT EXISTS `po_dtls` (
  `po_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `po_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `po_qty` decimal(10,2) DEFAULT NULL,
  `bal_qty` decimal(10,2) DEFAULT NULL,
  `unit_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`po_dtl_id`),
  UNIQUE KEY `po_dtls_uk` (`po_id`,`supply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='orders details'

CREATE TABLE IF NOT EXISTS `receiving` (
  `receiving_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `dr_no` int(5) DEFAULT NULL,
  `dr_date` datetime DEFAULT NULL,
  `po_id` int(5) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`receiving_id`),
  UNIQUE KEY `receiving_uk` (`dr_no`,`po_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Receiving of orders header'

CREATE TABLE IF NOT EXISTS `receiving_dtls` (
  `receiving_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `receiving_id` int(5) DEFAULT NULL,
  `po_dtl_id` int(5) DEFAULT NULL,
  `supply_brand_id` int(5) DEFAULT NULL,
  `dr_qty` decimal(10,2) DEFAULT NULL,
  `bal_qty` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`receiving_dtl_id`),
  UNIQUE KEY `receiving_dtls_uk` (`receiving_id`,`po_dtl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Receving of orders details'

CREATE TABLE IF NOT EXISTS `revision_logs` (
  `revision_id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(100) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `filetype` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`revision_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `role_procs` (
  `role_proc_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `proc_id` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `allow_write` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`role_proc_id`),
  UNIQUE KEY `role_procs_uk` (`role_id`,`proc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Role Procedure Access'

CREATE TABLE IF NOT EXISTS `sales_summ` (
  `sales_summ_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sales_summ_year` int(5) DEFAULT NULL,
  `sales_summ_month` int(5) DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `sales_amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sales_summ_id`),
  UNIQUE KEY `sales_summ_uk` (`sales_summ_year`,`sales_summ_month`,`store_loc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Sales Summary'

CREATE TABLE IF NOT EXISTS `sales_summ` (
  `sales_summ_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sales_summ_year` int(5) DEFAULT NULL,
  `sales_summ_month` int(5) DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `sales_amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sales_summ_id`),
  UNIQUE KEY `sales_summ_uk` (`sales_summ_year`,`sales_summ_month`,`store_loc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Sales Summary'

CREATE TABLE IF NOT EXISTS `sales_supply_summ` (
  `sales_supply_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `sales_supply_year` int(5) DEFAULT NULL,
  `sales_supply_month` int(5) DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `sales_amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sales_supply_id`),
  UNIQUE KEY `sales_supply_uk` (`sales_supply_year`,`sales_supply_month`,`store_loc_id`,`supply_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Sales Summary per Supply'

CREATE TABLE IF NOT EXISTS `select_options` (
  `select_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `text` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `condition_text` varchar(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`select_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1

CREATE TABLE IF NOT EXISTS `stock_transfer` (
  `st_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `st_no` int(5) DEFAULT NULL,
  `st_date` datetime DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `loc_id_to` int(5) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`st_id`),
  UNIQUE KEY `stock_transfer_uk` (`st_no`,`loc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Transfer header to other warehouse'

CREATE TABLE IF NOT EXISTS `stock_transfer_dtls` (
  `st_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `st_id` int(5) DEFAULT NULL,
  `st_qty` decimal(7,2) DEFAULT NULL,
  `loc_supply_brand_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`st_dtl_id`),
  UNIQUE KEY `stock_transfer_dtls_uk` (`st_id`,`loc_supply_brand_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Transfer details to other warehouse'

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_id`),
  UNIQUE KEY `stores_uk` (`store_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='stores'

CREATE TABLE IF NOT EXISTS `store_bank_depo` (
  `store_bank_depo_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_id` int(5) DEFAULT NULL,
  `sales_date` datetime DEFAULT NULL,
  `act_depo_date` datetime DEFAULT NULL,
  `depo_amt` decimal(7,2) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_bank_depo_id`),
  UNIQUE KEY `store_bank_depo_uk` (`store_loc_id`,`sales_date`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Bank Deposits'

CREATE TABLE IF NOT EXISTS `store_bank_depo_dtls` (
  `store_bank_depo_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_bank_depo_id` int(5) DEFAULT NULL,
  `bank_ref_id` int(5) DEFAULT NULL,
  `depo_pct_share` int(5) DEFAULT NULL,
  `depo_amount` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_bank_depo_dtl_id`),
  UNIQUE KEY `store_bank_depo_dtls_uk` (`store_bank_depo_id`,`bank_ref_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Bank Deposits Details'

CREATE TABLE IF NOT EXISTS `store_bank_depo_summ` (
  `bank_depo_summ_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `bank_depo_summ_year` int(5) DEFAULT NULL,
  `bank_depo_summ_month` int(5) DEFAULT NULL,
  `bank_ref_id` int(5) DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `depo_amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bank_depo_summ_id`),
  UNIQUE KEY `bank_depo_summ_uk` (`bank_depo_summ_year`,`bank_depo_summ_month`,`bank_ref_id`,`store_loc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Bank Deposits Summary'

CREATE TABLE IF NOT EXISTS `store_bank_wd` (
  `store_bank_wd_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_id` int(5) DEFAULT NULL,
  `bank_ref_id` int(5) DEFAULT NULL,
  `tran_no` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `cheque_no` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `wd_date` datetime DEFAULT NULL,
  `wd_amount` decimal(7,2) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_bank_wd_id`),
  UNIQUE KEY `store_bank_wd_uk` (`store_loc_id`,`bank_ref_id`,`wd_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Bank Withdraws'

CREATE TABLE IF NOT EXISTS `store_bank_wd_summ` (
  `bank_wd_summ_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `bank_wd_summ_year` int(5) DEFAULT NULL,
  `bank_wd_summ_month` int(5) DEFAULT NULL,
  `bank_ref_id` int(5) DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `wd_amount` decimal(10,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bank_wd_summ_id`),
  UNIQUE KEY `bank_wd_summ_uk` (`bank_wd_summ_year`,`bank_wd_summ_month`,`bank_ref_id`,`store_loc_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Bank Withdrawal Summary'

CREATE TABLE IF NOT EXISTS `store_daily_cash` (
  `store_daily_cash_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_id` int(5) DEFAULT NULL,
  `tran_date` datetime DEFAULT NULL,
  `ttl_cash_box_amt` decimal(7,2) DEFAULT NULL,
  `ttl_return_amt` decimal(7,2) DEFAULT NULL,
  `ttl_cash_sales_amt` decimal(7,2) DEFAULT NULL,
  `posted_dcash` int(5) NOT NULL DEFAULT '0',
  `posted_dsales` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `ttl_stock_sales_amt` decimal(7,2) DEFAULT NULL,
  `depo_amt` decimal(7,2) DEFAULT NULL,
  `ttl_exp_amt` decimal(7,2) DEFAULT NULL,
  `ttl_sales_exp_amt` decimal(7,2) DEFAULT NULL,
  `fr_store_daily_cash_id` int(5) DEFAULT NULL,
  `empl_id` int(5) DEFAULT NULL,
  `event_id` int(5) DEFAULT NULL,
  `short_excess_amt` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`store_daily_cash_id`),
  UNIQUE KEY `store_daily_cash_uk` (`store_loc_id`,`tran_date`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Daily Cash Header'

CREATE TABLE IF NOT EXISTS `store_daily_cash_dtls` (
  `store_daily_cash_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_daily_cash_id` int(5) DEFAULT NULL,
  `denomination` decimal(7,2) DEFAULT NULL,
  `denomination_qty` int(5) DEFAULT NULL,
  `cash_amount` decimal(7,2) DEFAULT NULL,
  `return_denomination_qty` int(5) DEFAULT NULL,
  `return_amount` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_daily_cash_dtl_id`),
  UNIQUE KEY `store_daily_cash_dtls_uk` (`store_daily_cash_id`,`denomination`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Daily Cash Details'

CREATE TABLE IF NOT EXISTS `store_loc` (
  `store_loc_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `loc_id` int(5) DEFAULT NULL,
  `store_id` int(5) DEFAULT NULL,
  `is_cart` int(5) NOT NULL DEFAULT '0',
  `active` int(5) NOT NULL DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_loc_id`),
  UNIQUE KEY `store_loc_uk` (`loc_id`,`store_id`,`store_loc`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store locations'

CREATE TABLE IF NOT EXISTS `store_loc_exp` (
  `store_loc_exp_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_id` int(5) DEFAULT NULL,
  `exp_date` datetime DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_loc_exp_id`),
  UNIQUE KEY `store_loc_exp_uk` (`exp_date`,`store_loc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Location Expenses'

CREATE TABLE IF NOT EXISTS `store_loc_exp_dtls` (
  `store_loc_exp_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_exp_id` int(5) DEFAULT NULL,
  `exp_desc` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `exp_amt` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `or_no` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `fr_sales` int(1) DEFAULT '0',
  PRIMARY KEY (`store_loc_exp_dtl_id`),
  UNIQUE KEY `store_loc_exp_dtls_uk` (`store_loc_exp_id`,`exp_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Location Expense Details'

CREATE TABLE IF NOT EXISTS `store_loc_supplies` (
  `store_loc_supply_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_id` int(5) DEFAULT NULL,
  `stock_daily_qty` decimal(5,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `loc_supply_id` int(5) DEFAULT NULL,
  `prev_qty` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`store_loc_supply_id`),
  UNIQUE KEY `store_loc_supplies_uk` (`store_loc_id`,`loc_supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Location Supplies reference'

CREATE TABLE IF NOT EXISTS `store_loc_supply_daily` (
  `store_loc_supply_daily_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_loc_supply_id` int(5) DEFAULT NULL,
  `stock_date` date DEFAULT NULL,
  `beg_qty` decimal(7,2) DEFAULT '0.00',
  `remaining_qty` decimal(7,2) DEFAULT '0.00',
  `is_qty` decimal(7,2) DEFAULT '0.00',
  `out_qty` decimal(7,2) DEFAULT '0.00',
  `end_qty` decimal(7,2) DEFAULT '0.00',
  `unit_price` decimal(7,2) DEFAULT '0.00',
  `unit_cost` decimal(7,2) DEFAULT '0.00',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_loc_supply_daily_id`),
  UNIQUE KEY `store_loc_supply_daily_uk` (`store_loc_supply_id`,`stock_date`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store Location Supplies daily stocks'

CREATE TABLE IF NOT EXISTS `store_supplies` (
  `store_supply_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `store_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`store_supply_id`),
  UNIQUE KEY `store_supplies_uk` (`store_id`,`supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Store supplies reference'

CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `contact_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `contact_no` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `active` int(5) NOT NULL DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supplier_id`),
  UNIQUE KEY `suppliers_uk` (`supplier_name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='suppliers'

CREATE TABLE IF NOT EXISTS `supplies` (
  `supply_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `supply_code` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  `supply_desc` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `supply_type_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `unit_id` int(5) DEFAULT NULL,
  `supply_srp` decimal(7,2) DEFAULT NULL,
  `seq_no` int(5) DEFAULT NULL,
  `weight_serve` decimal(7,2) DEFAULT NULL,
  `supply_cost` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`supply_id`),
  UNIQUE KEY `supplies_uk` (`supply_code`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='supplies'

CREATE TABLE IF NOT EXISTS `supply_adj` (
  `supply_adj_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `adj_date` datetime DEFAULT NULL,
  `loc_id` int(5) DEFAULT NULL,
  `adj_type_id` int(5) DEFAULT NULL,
  `adj_remarks` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `supply_brand_id` int(5) DEFAULT NULL,
  `adj_qty` decimal(5,2) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supply_adj_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Supply Adjustment'

CREATE TABLE IF NOT EXISTS `supply_brands` (
  `supply_brand_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(5) DEFAULT NULL,
  `supply_id` int(5) DEFAULT NULL,
  `conv_id` int(5) DEFAULT NULL,
  `supply_cost` decimal(7,2) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supply_brand_id`),
  UNIQUE KEY `supply_brands_uk` (`brand_id`,`supply_id`,`conv_id`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Supply Brands'

CREATE TABLE IF NOT EXISTS `supply_is` (
  `supply_is_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `is_no` int(5) DEFAULT NULL,
  `is_date` datetime DEFAULT NULL,
  `store_loc_id` int(5) DEFAULT NULL,
  `posted` int(5) NOT NULL DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supply_is_id`),
  UNIQUE KEY `supply_is_uk` (`is_no`,`store_loc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Issuance header to stores'

CREATE TABLE IF NOT EXISTS `supply_is_dtls` (
  `supply_is_dtl_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `supply_is_id` int(5) DEFAULT NULL,
  `supply_is_qty` decimal(7,2) DEFAULT NULL,
  `loc_supply_brand_id` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supply_is_dtl_id`),
  UNIQUE KEY `supply_is_dtls_uk` (`supply_is_id`,`loc_supply_brand_id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Stock Issuance details to stores'

CREATE TABLE IF NOT EXISTS `supply_types` (
  `supply_type_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `supply_type` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`supply_type_id`),
  UNIQUE KEY `supply_types_uk` (`supply_type`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Types of Supply'

CREATE TABLE IF NOT EXISTS `systems` (
  `system_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `system_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `system_desc` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`system_id`),
  UNIQUE KEY `systems_uk` (`system_name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Systems'

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `unit_sdesc` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `unit_desc` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`unit_id`),
  UNIQUE KEY `units_uk` (`unit_desc`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Unit of Measures'


/*VIEWS*/


create or replace view menu_v as
select *
from menu 
order by menu_type_id, seq_no;

CREATE OR REPLACE VIEW conv_units_v AS
select a.*, if(a.from_unit_id=a.conv_unit_id, b.unit_sdesc, concat(conv_unit_qty, ' ', c.unit_sdesc, ' per ',  b.unit_sdesc)) as cu_desc
FROM conv_units a, units b, units c
WHERE a.from_unit_id = b.unit_id
AND a.conv_unit_id = c.unit_id;

CREATE OR REPLACE VIEW supplies_v AS
select *, getUnitSDesc(unit_id) unit_desc, getSupplyType(supply_type_id) supply_type 
from  supplies;

CREATE OR REPLACE VIEW store_supplies_v AS
select store_id, store_supply_id, a.supply_id, b.supply_code
from store_supplies a, supplies b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW store_supplies2_v AS
select "" as store_id, "" as store_supply_id, supply_id, supply_code
from supplies;

CREATE OR REPLACE VIEW supplies2_v AS
select "" as loc_id, ""  as loc_supply_id, b.supply_id, b.seq_no, b.supply_code, "" as reorder_level, "" as max_level, b.unit_desc, "" as ttl_stocks
from store_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW loc_supplies_v AS
select a.loc_id, a.loc_supply_id, a.supply_id, b.seq_no, b.supply_code, a.reorder_level, a.max_level, b.unit_desc, getStockCount(loc_supply_id) as ttl_stocks, 
from loc_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW loc_supplies2_v AS
select a.*, b.seq_no, b.supply_code, b.unit_desc, getStockCount(loc_supply_id) as ttl_stocks
from loc_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW supply_brands_v AS
select a.supply_brand_id, a.supply_id, a.brand_id, b.brand_name, a.conv_id, a.supply_cost, if(a.brand_id=1,c.supply_code, concat(c.supply_code ,' ', b.brand_name)) as supply, d.cu_desc, conv_unit_qty 
from supply_brands a, brands b, supplies c, conv_units_v d
WHERE a.brand_id = b.brand_id
AND a.supply_id = c.supply_id
AND a.conv_id = d.conv_id;

CREATE OR REPLACE VIEW user_locations_v AS
select a.user_loc_id, a.loc_id, a.user_id, b.location
from user_locations a, locations b
WHERE a.loc_id = b.loc_id;

CREATE OR REPLACE VIEW user_locations2_v AS
select "" as user_loc_id, b.loc_id, "" as user_id, b.location
from user_locations a, locations b
WHERE a.loc_id = b.loc_id;

CREATE OR REPLACE VIEW supply_v AS
select a.supply_brand_id, a.supply_id, a.brand_id, b.brand_name, a.conv_id, a.supply_cost, if(a.brand_id=1,c.supply_code, concat(c.supply_code ,' ', b.brand_name)) as supply 
from supply_brands a, brands b, supplies c
WHERE a.brand_id = b.brand_id
AND a.supply_id = c.supply_id;

CREATE OR REPLACE VIEW supply_brands2_v AS
select "" as supply_brand_id, "" as supply_id, brand_id,  brand_name, "" as conv_id, "" as supply_cost, "" as supply, "" as cu_desc
from  brands;

CREATE OR REPLACE VIEW store_supply_brands_v AS
select a.store_id, a.store_supply_id, a.supply_id, b.supply, b.supply_cost
from store_supplies a, supply_brands_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW store_loc_supplies_v AS
select a.store_loc_supply_id, a.store_loc_id, c.store_id, b.supply_id, a.loc_supply_id, b.supply_code, b.unit_desc, stock_daily_qty, prev_qty,
getSupplyUprice(b.supply_id) as unit_price, getSupplyUcost(b.supply_id) as unit_cost,"" as loc_supply_brand_id
from store_loc_supplies a, loc_supplies_v b, store_loc c
WHERE a.store_loc_id = c.store_loc_id
AND a.loc_supply_id = b.loc_supply_id
order by b.seq_no;


CREATE OR REPLACE VIEW store_loc_supplies2_v AS
select "" as store_loc_supply_id, "" as store_loc_id, a.store_id, a.supply_id, "" as loc_supply_id, b.supply_code, b.unit_desc, "" as stock_daily_qty, "" as prev_qty,
getSupplyUprice(b.supply_id) as unit_price, getSupplyUcost(b.supply_id) as unit_cost, "" as loc_supply_brand_id
from  store_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;


CREATE OR REPLACE VIEW supply_is_unposted_v AS
select *
from supply_is
where posted=0;

CREATE OR REPLACE VIEW supply_is_dtls_unposted_v AS
select a.*
from supply_is_dtls a, store_loc_supplies_v b, supply_is c
where a.supply_is_id=c.supply_is_id
and c.store_loc_id =b.store_loc_id
and c.posted=0;

CREATE OR REPLACE VIEW supply_is_dtls_v AS
select a.*, b.store_loc_id, b.is_date, c.supply_code, c.brand_name, c.cu_desc, c.loc_supply_id, c.supply_id, 
getSupplyUprice(supply_id) as unit_price, getSupplyUcost(supply_id) as unit_cost
from supply_is_dtls a, supply_is b, loc_supply_brands_v c
where a.supply_is_id=b.supply_is_id
AND a.loc_supply_brand_id = c.loc_supply_brand_id;

CREATE OR REPLACE VIEW supply_is_dtls_grp_v AS
 SELECT store_loc_id, supply_is_id, is_date, loc_supply_id, unit_price, unit_cost, sum(supply_is_qty) as SumISQty
   FROM supply_is_dtls_v
  GROUP BY store_loc_id, supply_is_id, is_date, loc_supply_id, unit_price, unit_cost;


CREATE OR REPLACE VIEW po_unposted_v AS
select *
from po
where posted=0;

CREATE OR REPLACE VIEW powithbal_v AS
select *, getSupplier(supplier_id) as supplier, getLocation(loc_id) as location from po
where ifnull(getPOBalCount(po_id),0) > 0
AND posted=1;

CREATE OR REPLACE VIEW dr_powithbal_v AS
SELECT a.*
 FROM powithbal_v a
 WHERE not exists (select b.po_id FROM receiving b where posted=0 and b.po_id = a.po_id);



create or replace view po_dtls_v as
select a.*, b.supply_code, b.unit_desc 
from po_dtls a, supplies_v b
where a.supply_id = b.supply_id;

create or replace view po_dtlswithbal_v as
select a.*, b.supply_code, b.unit_desc 
from po_dtls a, supplies_v b
where bal_qty > 0 and a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW po_receiving_unposted_v AS
SELECT a.*
 FROM powithbal_v a
 WHERE not exists (select b.po_id FROM receiving b where posted=0 and b.po_id = a.po_id);

CREATE OR REPLACE VIEW receiving_unposted_v AS 
select a.*, b.supplier, b.location,  b.po_no
FROM receiving a, powithbal_v b
where a.posted=0
AND a.po_id = b.po_id;

CREATE OR REPLACE VIEW supply_brands_po_dtls_v AS
select a.*,b.supply_brand_id, b.brand_name, b.cu_desc
from po_dtls_v a, supply_brands_v b
where a.supply_id = b.supply_id;

create or replace view receiving_dtls_po_v as
select a.*, b.supply_code, b.unit_desc, getPOLocId(b.po_id) loc_id, b.brand_name, b.cu_desc, (a.bal_qty - a.dr_qty) as end_qty
from receiving_dtls a, supply_brands_po_dtls_v b
where a.po_dtl_id = b.po_dtl_id
and a.supply_brand_id = b.supply_brand_id;

CREATE OR REPLACE VIEW loc_pc_dtls_v as
SELECT a.*, b.loc_id, b.store_loc_id,  b.tran_date
FROM loc_pc_dtls a, loc_pc b
WHERE a.loc_pc_id=b.loc_pc_id;

CREATE OR REPLACE VIEW loc_pc_dtls_by_store_loc_v AS
SELECT a.*,c.loc_id, c.store_loc_id, c.pc_date, b.supply_code, b.unit_desc
FROM loc_pc_dtls a, store_loc_supplies_v b, loc_pc c
WHERE a.store_loc_supply_id = b.store_loc_supply_id
AND a.loc_pc_id=c.loc_pc_id;


create or replace view is_dtls_v as
select a.*, b.supply_code, b.brand_name, b.cu_desc 
from supply_is_dtls a, loc_supply_brands_v b
where a.loc_supply_brand_id = b.loc_supply_brand_id;

create or replace view supply_is_v as
select a.*, b.store_loc 
FROM supply_is a, store_loc b
WHERE a.store_loc_id = b.store_loc_id
AND posted_used=0;

CREATE OR REPLACE VIEW stock_transfer_unposted_v AS 
select *
FROM stock_transfer
where posted=0

create or replace view stock_transfer_dtls_v as
select a.*, b.stock_qty
from stock_transfer_dtls a, loc_supply_brands_v b
where a.loc_supply_brand_id = b.loc_supply_brand_id;

CREATE OR REPLACE VIEW store_daily_cash_dtls_v as
SELECT a.*, b.store_loc_id,  b.tran_date
FROM store_daily_cash_dtls a, store_daily_cash b
WHERE a.store_daily_cash_id=b.store_daily_cash_id;

CREATE OR REPLACE VIEW store_loc_exp_dtls_v as
SELECT a.*, b.store_loc_id,  b.exp_date
FROM store_loc_exp_dtls a, store_loc_exp b
WHERE a.store_loc_exp_id=b.store_loc_exp_id
AND fr_sales=0;

CREATE OR REPLACE VIEW store_loc_sales_exp_dtls_v as
SELECT a.*, b.store_loc_id,  b.exp_date
FROM store_loc_exp_dtls a, store_loc_exp b
WHERE a.store_loc_exp_id=b.store_loc_exp_id
AND fr_sales=1;

CREATE OR REPLACE VIEW store_loc_supply_daily_v AS
select a.*, b.store_loc_id, b.supply_code, b.unit_desc, 
ifnull(a.unit_price,0) * ifnull(a.out_qty,0) as sales_amount, 
ifnull(a.unit_cost,0) * ifnull(a.out_qty,0) as cost_amount, 
CONCAT(b.supply_code, ' (', a.remaining_qty, b.unit_desc, ')') as supply
from store_loc_supply_daily a, store_loc_supplies_v b
where a.store_loc_supply_id=b.store_loc_supply_id;


CREATE OR REPLACE VIEW revisions_latest_v as
select * from revision_logs
where revision_id in (select distinct getlatestrevid(filename) as revision_id from revision_logs);

CREATE OR REPLACE VIEW store_daily_cash_v as
SELECT *, getEmplName(empl_id) as empl_name  FROM store_daily_cash;

CREATE OR REPLACE VIEW loc_pc_dtls_group_v AS
SELECT loc_pc_id, getLocSupplyIdByBrandId(loc_supply_brand_id) AS loc_supply_id, sum(pc_qty * getSupplyConvQty(loc_supply_brand_id)) as sum_stock_qty
FROM loc_pc_dtls
GROUP BY loc_pc_id, getLocSupplyIdByBrandId(loc_supply_brand_id);

CREATE OR REPLACE VIEW store_bank_depo_dtls_v as
SELECT a.*, b.bank_name, b.depo_pct_share 
  FROM store_bank_depo_v a, bank_ref b
 WHERE a.bank_ref_id = a.bank_ref_id;

CREATE OR REPLACE VIEW sales_staffs_v as
SELECT * FROM employees
where position_id = 4;