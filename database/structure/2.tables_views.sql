/*
host: oracleexpertscebu.com
database: zsi_sims
user/pwd: zsi / lyncor@tan
*/

CREATE TABLE IF NOT EXISTS `systems` (
  `system_id` int(5) unsigned NOT NULL auto_increment,
  `system_name` varchar(64) NOT NULL default '',
  `system_desc` varchar(100) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `systems_pk`  (`system_id`),
  UNIQUE KEY  `systems_uk` (`system_name`)
)
  COMMENT='Systems'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `menu_types` (
  `menu_type_id` int(5) unsigned NOT NULL auto_increment,
  `menu_type` varchar(64) NOT NULL default '',
  `seq_no` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `menu_types_pk`  (`menu_type_id`),
  UNIQUE KEY  `menu_types_uk` (`menu_type`)
)
  COMMENT='Menu Types'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;


CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(5) unsigned NOT NULL auto_increment,
  `menu_name` varchar(64) NOT NULL default '',
  `menu_url` varchar(100) NOT NULL default '',
  `menu_type_id` int(5),
  `system_id` int(5),
  `seq_no` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `menu_pk`  (`menu_id`),
  UNIQUE KEY `menu_uk` (`menu_name`)
)
  COMMENT='Menu'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` int(5) unsigned NOT NULL auto_increment,
  `role_code` varchar(5) NOT NULL default '',
  `role_desc` varchar(64) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `roles_pk`  (`role_id`),
  UNIQUE KEY `roles_uk` (`role_desc`)
)
  COMMENT='Menus'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `role_menus` (
  `role_menu_id` int(5) unsigned NOT NULL auto_increment, 
  `menu_id` int(5),
  `role_id` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `role_menus_pk` (`role_menu_id`),
  UNIQUE KEY `role_menus_uk` (`role_id`,`menu_id`)
)
  COMMENT='role_menus'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

CREATE TABLE IF NOT EXISTS `denomination_ref` (
  `denomination`   decimal(5,2),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `denomination_pk` (`denomination`)
)
  COMMENT='Money Denomination Reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

  CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int(5) unsigned NOT NULL auto_increment,
  `brand_name` varchar(64) NOT NULL default '', 
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `brands_pk`  (`brand_id`),
  UNIQUE KEY  `brands_uk` (`brand_name`)
)
  COMMENT='Brands'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  
  CREATE TABLE IF NOT EXISTS `add_on_rate` (
    `holiday_pct`   decimal(5,2),
    `sunday_pct`   decimal(5,2),
    `created_by` int(5),
    `created_date` datetime,
    `updated_by` int(5),
    `updated_date` datetime
  )
    COMMENT='Add on pct rate Reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id`     int(5) unsigned NOT NULL auto_increment,
  `supplier_name`   varchar(64) NOT NULL default '',
  `contact_name`   varchar(64) NOT NULL default '',
  `contact_no`   varchar(64) NOT NULL default '',
  `active` int(5) NOT NULL default '1',   
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `suppliers_pk`  (`supplier_id`),
  UNIQUE KEY `suppliers_uk` (`supplier_name`)
)
  COMMENT='suppliers'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
  

CREATE TABLE IF NOT EXISTS `supply_types` (
  `supply_type_id` int(5) unsigned NOT NULL auto_increment,
  `supply_type` varchar(64) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `supply_types_pk`  (`supply_type_id`),
  UNIQUE KEY  `supply_types_uk` (`supply_type`)
)
  COMMENT='Types of Supply'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 
 
CREATE TABLE IF NOT EXISTS `supplies` (
  `supply_id`     int(5) unsigned NOT NULL auto_increment,
  `supply_code`   varchar(10) NOT NULL default '',
  `supply_desc`   varchar(64) NOT NULL default '',
  `supply_type_id` int(5),
  `unit_id`        int(5),  
  `supply_srp`     decimal(7,2),
  `weight_serve`   decimal(7,2), 
  `seq_no`        int(5), 
  `created_by`     int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `supplies_pk`  (`supply_id`),
  UNIQUE KEY `supplies_uk` (`supply_code`)
)
  COMMENT='supplies'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

CREATE TABLE IF NOT EXISTS `supply_brands` (
  `supply_brand_id` int(5) unsigned NOT NULL auto_increment,
  `brand_id` int(5),
  `supply_id` int(5),
  `conv_id` int(5),
  `supply_cost`  decimal(5,2),  
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `supply_brands_pk`  (`supply_brand_id`),
  UNIQUE KEY `supply_brands_uk` (`brand_id`,`supply_id`,`conv_id`)
)
  COMMENT='Supply Brands'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(5) unsigned NOT NULL auto_increment,
  `position_desc` varchar(64) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `positions_pk`  (`position_id`),
  UNIQUE KEY `positions_uk` (`position_desc`)
)
  COMMENT='Positions'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id` int(5) unsigned NOT NULL auto_increment,
  `unit_sdesc` varchar(10) NOT NULL default '',
  `unit_desc` varchar(64) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `units_pk`  (`unit_id`),
  UNIQUE KEY  `units_uk` (`unit_desc`)
)
  COMMENT='Unit of Measures'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

CREATE TABLE IF NOT EXISTS `conv_units` (
  `conv_id` int(5) unsigned NOT NULL auto_increment,
  `from_unit_id` varchar(64) NOT NULL default '',
  `conv_unit_id` varchar(64) NOT NULL default '',
  `conv_unit_qty`  decimal(5,2),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY  `conv_units_pk`  (`conv_id`),
  UNIQUE KEY  `conv_units_uk` (`from_unit_id`,`conv_unit_id`,`conv_unit_qty` )
)
  COMMENT='Unit of Measures Conversions'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id` int(5) unsigned NOT NULL auto_increment,
  `store_name` varchar(100) NOT NULL default '',
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `stores_pk`  (`store_id`),
  UNIQUE KEY `stores_uk` (`store_name`)
)
  COMMENT='stores'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `locations` (
  `loc_id` int(5) unsigned NOT NULL auto_increment,
  `location` varchar(100) NOT NULL default '',
  `loc_group_id` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `locations_pk`  (`loc_id`),
  UNIQUE KEY `locations_uk` (`location`)
)
  COMMENT='Locations/Warehouses'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `store_loc` (
  `store_loc_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc` varchar(100) NOT NULL default '',
  `loc_id` int(5),
  `store_id` int(5),
  `is_cart` int(5) NOT NULL default '0', 
  `active` int(5) NOT NULL default '1', 
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `store_loc_pk`  (`store_loc_id`),
  UNIQUE KEY `store_loc_uk` (`loc_id`,`store_id`, `store_loc`)
)
  COMMENT='Store locations'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `employees` (
  `empl_id` int(5) unsigned NOT NULL auto_increment,
  `empl_name` varchar(64) NOT NULL default '',
  `loc_id` int(5),
  `store_loc_id` int(5),
  `position_id` int(5),
  `daily_rate` decimal(7,2),
  `active` int(5) NOT NULL default '1', 
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `employees_pk` (`empl_id`),
  UNIQUE KEY `employees_uk` (`empl_name`)
)
  COMMENT='Employees'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;


CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(5) unsigned NOT NULL,
  `user_password` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_name` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `empl_id` int(5) DEFAULT NULL,
  `role_id` int(5) DEFAULT NULL,
  `active` int(5) NOT NULL DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(5) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_locations` (
  `user_loc_id` int(5) unsigned NOT NULL auto_increment,
  `user_id` int(5),
  `loc_id` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `user_locations_pk`  (`user_loc_id`),
  UNIQUE KEY `user_locations_uk` (`user_id`,`loc_id`)
)
  COMMENT='User Locations Access'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

 CREATE TABLE IF NOT EXISTS `store_supplies` (
  `store_supply_id` int(5) unsigned NOT NULL auto_increment,
  `store_id` int(5),
  `supply_id`    int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `store_supplies_pk`  (`store_supply_id`),
  UNIQUE KEY `store_supplies_uk` (`store_id`,`supply_id`)
)
  COMMENT='Store supplies reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;     

CREATE TABLE IF NOT EXISTS `loc_supplies` (
  `loc_supply_id` int(5) unsigned NOT NULL auto_increment,
  `loc_id` int(5),
  `supply_id` int(5),
  `reorder_level` int(5),
  `max_level` int(5),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `loc_supplies_pk`  (`loc_supply_id`),
  UNIQUE KEY `loc_supplies_uk` (`loc_id`,`supply_id`)
)
  COMMENT='Location Supplies'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

CREATE TABLE IF NOT EXISTS `loc_supply_brands` (
  `loc_supply_brand_id` int(5) unsigned NOT NULL auto_increment,
  `loc_supply_id` int(5),
  `supply_brand_id` int(5),  
  `stock_qty` decimal(10,2),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `loc_supply_brands_pk`  (`loc_supply_brand_id`),
  UNIQUE KEY `loc_supply_brands_uk` (`loc_supply_id`,`supply_brand_id`)
)
  COMMENT='Location Supplies per brand'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `po` (
  `po_id` int(5) unsigned NOT NULL auto_increment,
  `po_no`  int(5),
  `po_date` datetime,
  `loc_id` int(5),
  `supplier_id` int(5),
  `posted` int(5) NOT NULL default '0',     
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `po_pk`  (`po_id`),
  UNIQUE KEY `po_uk` (`po_no`, `loc_id`,`po_id`)
)
  COMMENT='order header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   

 CREATE TABLE IF NOT EXISTS `po_dtls` (
  `po_dtl_id` int(5) unsigned NOT NULL auto_increment,
  `po_id`              int(5),
  `supply_id`          int(5),
  `po_qty`             decimal(10,2),
  `bal_qty`            decimal(10,2),
  `unit_id`            int(5),
  `created_by`         int(5),
  `created_date`       datetime,
  `updated_by`         int(5),
  `updated_date`       datetime,
  PRIMARY KEY `po_dtls_pk`  (`po_dtl_id`),
  UNIQUE KEY `po_dtls_uk` (`po_id`,`supply_id`)
)
  COMMENT='orders details'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `receiving` (
  `receiving_id` int(5) unsigned NOT NULL auto_increment,
  `dr_no`  int(5),
  `dr_date` datetime,
  `po_id`  int(5),
  `posted` int(5) NOT NULL default '0',     
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `receiving_pk`  (`receiving_id`),
  UNIQUE KEY `receiving_uk` (`dr_no`, `loc_id`,`po_id`)
)
  COMMENT='Receiving of orders header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   

 CREATE TABLE IF NOT EXISTS `receiving_dtls` (
  `receiving_dtl_id` int(5) unsigned NOT NULL auto_increment,
  `receiving_id` int(5),
  `po_dtl_id`    int(5),
  `supply_brand_id`  int(5),
  `dr_qty`       decimal(10,2),
  `bal_qty`      decimal(10,2),
  `created_by`  int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `receiving_dtls_pk`  (`receiving_dtl_id`),
  UNIQUE KEY `receiving_dtls_uk` (`receiving_id`,`po_dtl_id`)
)
  COMMENT='Receving of orders details'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

  CREATE TABLE IF NOT EXISTS `store_daily_cash` (
  `store_daily_cash_id`           int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`                  int(5),
  `tran_date`                     datetime,
  `ttl_cash_box_amt`              decimal(7,2),
  `ttl_return_amt`                decimal(7,2),
  `ttl_cash_sales_amt`            decimal(7,2),
  `posted_dcash` int(5)           NOT NULL default '0',  
  `posted_dsales` int(5)          NOT NULL default '0',  
  `created_by`                    int(5),
  `created_date`                  datetime,
  `updated_by`                    int(5),
  `updated_date`                  datetime,
  PRIMARY KEY `store_daily_cash_pk`(`store_daily_cash_id`),
  UNIQUE KEY `store_daily_cash_uk` (`store_loc_id`,`tran_date`)
)
  COMMENT='Store Daily Cash Header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

   CREATE TABLE IF NOT EXISTS `store_daily_cash_dtls` (
  `store_daily_cash_dtl_id`         int(5) unsigned NOT NULL auto_increment,
  `store_daily_cash_id`             int(5),
  `denomination`                    decimal(7,2),
  `denomination_qty`                int(5),
  `cash_amount`                     decimal(7,2),
  `return_denomination_qty`         int(5),
  `return_amount`                   decimal(7,2),
  `created_by`                      int(5),
  `created_date`                    datetime,
  `updated_by`                      int(5),
  `updated_date`                    datetime,
  PRIMARY KEY `store_daily_cash_dtls_pk`  (`store_daily_cash_dtl_id`),
  UNIQUE KEY `store_daily_cash_dtls_uk` (`store_daily_cash_id`,`denomination`)
)
  COMMENT='Store Daily Cash Details'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `adj_types` (
  `adj_type_id` int(5) unsigned NOT NULL auto_increment,
  `adj_type`      varchar(20) NOT NULL default '',
  `adj_math`      varchar(1) NOT NULL default '',
  `posted` int(5) NOT NULL default '0',     
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `adj_types_pk`  (`adj_type_id`),
  UNIQUE KEY `adj_types_uk` (`adj_type`)
)
  COMMENT='Supply Adjustment'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   

 CREATE TABLE IF NOT EXISTS `supply_adj` (
  `supply_adj_id` int(5) unsigned NOT NULL auto_increment,
  `adj_date` datetime,
  `loc_id` int(5),
  `adj_type_id` int(5),
  `adj_remarks`      varchar(200) NOT NULL default '',
  `supply_brand_id` int(5),
  `adj_qty` decimal(5,2),
  `posted` int(5) NOT NULL default '0',     
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `adj_pk`  (`supply_adj_id`)
)
  COMMENT='Supply Adjustment'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   


 CREATE TABLE IF NOT EXISTS `store_loc_supplies` (
  `store_loc_supply_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc_id` int(5),
  ,loc_supply_id int(5),
  `stock_daily_qty`   decimal(5,2),
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `store_loc_supplies_pk`  (`store_loc_supply_id`),
  UNIQUE KEY `store_loc_supplies_uk` (`store_loc_id`,`loc_supply_id`)
)
  COMMENT='Store Location Supplies reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   
  
  CREATE TABLE IF NOT EXISTS `store_loc_supply_brands` (
  `store_loc_supply_brand_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc_supply_id`    int(5),
  `loc_supply_brand_id`    int(5),
  `stock_qty`              decimal(7,2),
  `created_by`             int(5),
  `created_date`           datetime,
  `updated_by`             int(5),
  `updated_date`           datetime,
  PRIMARY KEY `store_loc_supply_brands_pk`  (`store_loc_supply_brand_id`),
  UNIQUE KEY `store_loc_supply_brands_uk` (`store_loc_supply_id`,`loc_supply_brand_id`)
)
  COMMENT='Store Location Supplies per brand stocks'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
  
  CREATE TABLE IF NOT EXISTS `store_loc_exp` (
   `store_loc_exp_id`   int(5) unsigned NOT NULL auto_increment,
   `store_loc_id`  int(5),
   `exp_date` datetime,
   `exp_amt` datetime,
   `posted` int(5) NOT NULL default '0',     
   `created_by`    int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `store_loc_pk`  (`store_loc_exp_id`),
   UNIQUE KEY `store_loc_uk` (`exp_date`,`store_loc_id`)
 )
   COMMENT='Store Location Expenses'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


  CREATE TABLE IF NOT EXISTS `loc_pc` (
   `loc_pc_id`   int(5) unsigned NOT NULL auto_increment,
   `pc_no`          int(5),
   `pc_date`        datetime,
   `loc_id`         int(5),
   `posted` int(5) NOT NULL default '0',    
   `created_by`    int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `loc_pc_pk`  (`loc_pc_id`),
   UNIQUE KEY `loc_pc_uk` (`pc_no`,`loc_id`)
 )
   COMMENT='Stock Physical Count header per location'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

  CREATE TABLE IF NOT EXISTS `loc_pc_dtls` (
   `loc_pc_dtl_id`        int(5) unsigned NOT NULL auto_increment,
   `loc_pc_id`            int(5),
   `loc_supply_brand_id`  int(5),
   `pc_qty`               decimal(7,2),
   `created_by`           int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `loc_pc_dtls_pk`  (`loc_pc_dtl_id`),
   UNIQUE KEY `loc_pc_dtls_uk` (`loc_pc_id`,`loc_supply_brand_id`)
 )
   COMMENT='Stock Physical Count details per location'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

 
  CREATE TABLE IF NOT EXISTS `supply_is` (
   `supply_is_id`   int(5) unsigned NOT NULL auto_increment,
   `is_no`  int(5),
   `is_date` datetime,
   `store_loc_id`  int(5),
   `posted_is` int(5) NOT NULL default '0',    
   `posted_used` int(5) NOT NULL default '0',     
   `created_by`    int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `supply_is_pk`  (`supply_is_id`),
   UNIQUE KEY `supply_is_uk` (`is_no`,`store_loc_id`)
 )
   COMMENT='Stock Issuance header to stores'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

  CREATE TABLE IF NOT EXISTS `supply_is_dtls` (
   `supply_is_dtl_id`        int(5) unsigned NOT NULL auto_increment,
   `supply_is_id`            int(5),
   `supply_is_qty`           decimal(7,2),
   `loc_supply_brand_id`     int(5),
   `prev_qty`                decimal(7,2),
   `used_qty`                decimal(7,2),
   `returned_qty`            decimal(7,2),
   `end_qty`                 decimal(7,2),
   `created_by`              int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `supply_is_dtls_pk`  (`supply_is_dtl_id`),
   UNIQUE KEY `supply_is_dtls_uk` (`supply_is_id`,`loc_supply_brand_id`)
 )
   COMMENT='Stock Issuance details to stores'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `inv_summ` (
  `inv_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `inv_summ_year`       int(5),
  `inv_summ_month`    int(5),
  `loc_id`                     int(5),
  `supply_id`               int(5),
  `beg_qty`                decimal(10,2),
  `dr_qty`                  decimal(10,2),
  `used_qty`              decimal(10,2),
  `adj_plus_qty`          decimal(10,2),
  `adj_minus_qty`         decimal(10,2),
  `end_qty`               decimal(10,2),
  `created_by`          int(5),
  `created_date`      datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `inv_summ_pk`  (`inv_summ_id`),
  UNIQUE KEY `inv_summ_uk` (`inv_summ_year`,`inv_summ_month`,`loc_id`,`supply_id`)
)
  COMMENT='Inventory Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `sales_summ` (
  `sales_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `sales_summ_year`       int(5),
  `sales_summ_month`    int(5),
  `store_loc_id`               int(5),
  `sales_amount`            decimal(10,2),
  `created_by`               int(5),
  `created_date`           datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `sales_summ_pk`  (`sales_summ_id`),
  UNIQUE KEY `sales_summ_uk` (`sales_summ_year`,`sales_summ_month`,`store_loc_id`)
)
  COMMENT='Store Sales Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `sales_supply_summ` (
  `sales_supply_id`           int(5) unsigned NOT NULL auto_increment,
  `sales_supply_year`       int(5),
  `sales_supply_month`    int(5),
  `store_loc_id`               int(5),
  `supply_id`                   int(5),
  `sales_amount`            decimal(10,2),
  `created_by`                int(5),
  `created_date`             datetime,
  `updated_by`              int(5),
  `updated_date`          datetime,
  PRIMARY KEY `sales_supply_pk`  (`sales_supply_id`),
  UNIQUE KEY `sales_supply_uk` (`sales_supply_year`,`sales_supply_month`,`store_loc_id`, `supply_id`)
)
  COMMENT='Store Sales Summary per Supply'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

CREATE TABLE IF NOT EXISTS `bank_ref` (
 `bank_ref_id`           int(5) unsigned NOT NULL auto_increment,
 `bank_acctno` varchar(30) NOT NULL default '',
 `bank_acctname` varchar(50) NOT NULL default '', 
 `bank_name` varchar(50) NOT NULL default '',
 `acct_amount`              decimal(10,2),
 `depo_pct_share`         int(5),
 `depo_amt_share`        decimal(10,2),
 `priority_no`                   int(5),
  `active` int(5) NOT NULL default '1', 
  `created_by` int(5),
  `created_date` datetime,
  `updated_by` int(5),
  `updated_date` datetime,
  PRIMARY KEY `bank_ref_pk` (`bank_ref_id` ),
 UNIQUE KEY `bank_ref_pk_uk` (`bank_acctno`)

)
  COMMENT='Bank Accounts Reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
 
   CREATE TABLE IF NOT EXISTS `store_bank_depo` (
  `store_bank_depo_id`     int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`                 int(5),
  `bank_ref_id`                 int(5),
  `tran_no`                       varchar(50),
  `depo_date`                  datetime,  
  `depo_amount`              decimal(7,2),
  `posted` int(5) NOT NULL default '0',      
  `created_by`          int(5),
  `created_date`      datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `store_bank_depo_pk`  (`store_bank_depo_id`),
  UNIQUE KEY `store_bank_depo_uk` (`store_loc_id`,`bank_ref_id`,`depo_date`)
)
  COMMENT='Store Bank Deposits'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

   CREATE TABLE IF NOT EXISTS `store_bank_wd` (
  `store_bank_wd_id`     int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`               int(5),
  `bank_ref_id`              int(5),
  `tran_no`                      varchar(50),
  `cheque_no`                 varchar(50),
  `wd_date`                    datetime,  
  `wd_amount`                decimal(7,2),
  `posted` int(5) NOT NULL default '0',      
  `created_by`          int(5),
  `created_date`      datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `store_bank_wd_pk`  (`store_bank_wd_id`),
  UNIQUE KEY `store_bank_wd_uk` (`store_loc_id`,`bank_ref_id`,`wd_date`)
)
  COMMENT='Store Bank Withdraws'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `store_bank_depo_summ` (
  `bank_depo_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `bank_depo_summ_year`       int(5),
  `bank_depo_summ_month`    int(5),
  `bank_ref_id`              int(5),
  `store_loc_id`               int(5),
  `depo_amount`            decimal(10,2),
  `created_by`               int(5),
  `created_date`           datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `bank_depo_summ_pk`  (`bank_depo_summ_id`),
  UNIQUE KEY `bank_depo_summ_uk` (`bank_depo_summ_year`,`bank_depo_summ_month`,`bank_ref_id`,`store_loc_id`)
)
  COMMENT='Store Bank Deposits Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `store_bank_wd_summ` (
  `bank_wd_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `bank_wd_summ_year`       int(5),
  `bank_wd_summ_month`    int(5),
  `bank_ref_id`              int(5),
 `store_loc_id`               int(5),
  `wd_amount`            decimal(10,2),
  `created_by`               int(5),
  `created_date`           datetime,
  `updated_by`        int(5),
  `updated_date`     datetime,
  PRIMARY KEY `bank_wd_summ_pk`  (`bank_wd_summ_id`),
  UNIQUE KEY `bank_wd_summ_uk` (`bank_wd_summ_year`,`bank_wd_summ_month`,`bank_ref_id`,`store_loc_id`)
)
  COMMENT='Store Bank Withdrawal Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `page_templates` (
  `page_template_id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`page_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE `select_options` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;



/* Views */
create or replace view menu_v as
select *
from menu 
order by menu_type_id, seq_no;

CREATE OR REPLACE VIEW conv_units_v AS
select a.conv_id, if(a.from_unit_id=a.conv_unit_id, b.unit_sdesc, concat(conv_unit_qty, ' ', c.unit_sdesc, ' per ',  b.unit_sdesc)) as cu_desc
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
select a.loc_id, a.loc_supply_id, a.supply_id, b.seq_no, b.supply_code, a.reorder_level, a.max_level, b.unit_desc, getStockCount(loc_supply_id) as ttl_stocks
from loc_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;


CREATE OR REPLACE VIEW loc_supplies2_v AS
select a.*, b.seq_no, b.supply_code, b.unit_desc, getStockCount(loc_supply_id) as ttl_stocks
from loc_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW loc_supply_brands_v AS
select a.*, b.supply_id, b.seq_no, b.supply_code, b.loc_id, c.brand_name, c.cu_desc
from loc_supply_brands a, loc_supplies_v b, supply_brands_v c
WHERE a.loc_supply_id = b.loc_supply_id
AND a.supply_brand_id = c.supply_brand_id
ORDER BY seq_no;


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

CREATE OR REPLACE VIEW supply_brands_v AS
select a.supply_brand_id, a.supply_id, a.brand_id, b.brand_name, a.conv_id, a.supply_cost, if(a.brand_id=1,c.supply_code, concat(c.supply_code ,' ', b.brand_name)) as supply, d.cu_desc 
from supply_brands a, brands b, supplies c, conv_units_v d
WHERE a.brand_id = b.brand_id
AND a.supply_id = c.supply_id
AND a.conv_id = d.conv_id;

CREATE OR REPLACE VIEW supply_brands2_v AS
select "" as supply_brand_id, "" as supply_id, brand_id,  brand_name, "" as conv_id, "" as supply_cost, "" as supply, "" as cu_desc
from  brands;

CREATE OR REPLACE VIEW store_supply_brands_v AS
select a.store_id, a.store_supply_id, a.supply_id, b.supply, b.supply_cost
from store_supplies a, supply_brands_v b
WHERE a.supply_id = b.supply_id;


CREATE OR REPLACE VIEW loc_supplies_v AS
select a.*,b.supply_id, b.supply_code, b.unit_desc, getStockCount(loc_supply_id) as ttl_stocks
from loc_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW store_loc_supplies_v AS
select a.store_loc_supply_id, a.store_loc_id, c.store_id, b.supply_id, a.loc_supply_id, b.supply_code, b.unit_desc, stock_daily_qty, 
getStoreLocTotalStocks(store_loc_supply_id) as store_stocks, b.ttl_stocks
from store_loc_supplies a, loc_supplies_v b, store_loc c
WHERE a.store_loc_id = c.store_loc_id
AND a.loc_supply_id = b.loc_supply_id;


CREATE OR REPLACE VIEW store_loc_supplies2_v AS
select "" as store_loc_supply_id, "" as store_loc_id, a.store_id, a.supply_id, "" as loc_supply_id, b.supply_code, b.unit_desc, "" as stock_daily_qty, "" as store_stocks, "" as ttl_stocks
from  store_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW supply_is_unposted_v AS
select *
from supply_is
where posted_is=0;

CREATE OR REPLACE VIEW po_unposted_v AS
select *
from po
where posted=0;

CREATE OR REPLACE VIEW supply_is_dtls_unposted_v AS
select a.*
from supply_is_dtls a, store_loc_supplies_v b, supply_is c
where a.supply_is_id=c.supply_is_id
and c.store_loc_id =b.store_loc_id
and c.posted=0;

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

CREATE OR REPLACE VIEW loc_pc_dtls_v AS
SELECT a.*, b.seq_no, b.supply_code, b.brand_name, b.cu_desc
FROM loc_pc_dtls a, loc_supply_brands_v b
WHERE a.loc_supply_brand_id = b.loc_supply_brand_id;

CREATE OR REPLACE VIEW StoreLocSupplyBrandsSum_v AS
SELECT store_loc_supply_id, SUM(stock_qty) as ttl_stocks
FROM store_loc_supply_brands
GROUP BY store_loc_supply_id;

create or replace view is_dtls_v as
select a.*, b.supply_code, b.brand_name, b.cu_desc 
from supply_is_dtls a, loc_supply_brands_v b
where a.loc_supply_brand_id = b.loc_supply_brand_id;