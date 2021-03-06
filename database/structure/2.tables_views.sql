/*
host: oracleexpertscebu.com
database: zsi_sims
user/pwd: zsi / lyncor@tan
*/

CREATE TABLE IF NOT EXISTS `systems` (
  `system_id`      int(5) unsigned NOT NULL auto_increment,
  `system_name`    varchar(64) NOT NULL default '',
  `system_desc`    varchar(100) NOT NULL default '',
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY  `systems_pk`  (`system_id`),
  UNIQUE KEY  `systems_uk` (`system_name`)
)
  COMMENT='Systems'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `menu_types` (
  `menu_type_id` int(5) unsigned NOT NULL auto_increment,
  `menu_type`    varchar(64) NOT NULL default '',
  `seq_no`       int(5),
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY  `menu_types_pk`  (`menu_type_id`),
  UNIQUE KEY  `menu_types_uk` (`menu_type`)
)
  COMMENT='Menu Types'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;


CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id`      int(5) unsigned NOT NULL auto_increment,
  `menu_name`    varchar(64) NOT NULL default '',
  `menu_url`     varchar(100) NOT NULL default '',
  `menu_type_id` int(5),
  `system_id`    int(5),
  `seq_no`       int(5),
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `menu_pk`  (`menu_id`),
  UNIQUE KEY `menu_uk` (`menu_name`)
)
  COMMENT='Menu'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id`      int(5) unsigned NOT NULL auto_increment,
  `role_code`    varchar(5) NOT NULL default '',
  `role_desc`    varchar(64) NOT NULL default '',
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `roles_pk`  (`role_id`),
  UNIQUE KEY `roles_uk` (`role_desc`)
)
  COMMENT='Menus'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `role_menus` (
  `role_menu_id` int(5) unsigned NOT NULL auto_increment, 
  `menu_id`      int(5),
  `role_id`      int(5),
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `role_menus_pk` (`role_menu_id`),
  UNIQUE KEY `role_menus_uk` (`role_id`,`menu_id`)
)
  COMMENT='role_menus'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

CREATE TABLE IF NOT EXISTS `denomination_ref` (
  `denomination`   decimal(5,2),
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY `denomination_pk` (`denomination`)
)
  COMMENT='Money Denomination Reference'
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
  
CREATE TABLE IF NOT EXISTS `suppliers` (
  `supplier_id`     int(5) unsigned NOT NULL auto_increment,
  `supplier_name`   varchar(64) NOT NULL default '',
  `contact_name`    varchar(64) NOT NULL default '',
  `contact_no`      varchar(64) NOT NULL default '',
  `active`          int(5) NOT NULL default '1',   
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `suppliers_pk`  (`supplier_id`),
  UNIQUE KEY `suppliers_uk` (`supplier_name`)
)
  COMMENT='suppliers'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
  

CREATE TABLE IF NOT EXISTS `supply_types` (
  `supply_type_id` int(5) unsigned NOT NULL auto_increment,
  `supply_type`    varchar(64) NOT NULL default '',
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY  `supply_types_pk`  (`supply_type_id`),
  UNIQUE KEY  `supply_types_uk` (`supply_type`)
)
  COMMENT='Types of Supply'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 
 
CREATE TABLE IF NOT EXISTS `supplies` (
  `supply_id`      int(5) unsigned NOT NULL auto_increment,
  `supply_code`    varchar(25) NOT NULL default '',
  `supply_desc`    varchar(64) NOT NULL default '',
  `supply_type_id` int(5),
  `unit_id`        int(5),  
  `supply_cost`    decimal(7,2),
  `supply_srp`     decimal(7,2),
  `weight_serve`   decimal(7,2), 
  `seq_no`         int(5), 
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY `supplies_pk`  (`supply_id`),
  UNIQUE KEY `supplies_uk` (`supply_code`)
)
  COMMENT='supplies'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

CREATE TABLE IF NOT EXISTS `supply_brands` (
  `supply_brand_id` int(5) unsigned NOT NULL auto_increment,
  `brand_id`        int(5),
  `supply_id`       int(5),
  `conv_id`         int(5),
  `supply_cost`     decimal(5,2),  
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `supply_brands_pk`  (`supply_brand_id`),
  UNIQUE KEY `supply_brands_uk` (`brand_id`,`supply_id`,`conv_id`)
)
  COMMENT='Supply Brands'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `positions` (
  `position_id`   int(5) unsigned NOT NULL auto_increment,
  `position_desc` varchar(64) NOT NULL default '',
  `created_by`    int(5),
  `created_date`  datetime,
  `updated_by`    int(5),
  `updated_date`  datetime,
  PRIMARY KEY `positions_pk`  (`position_id`),
  UNIQUE KEY `positions_uk` (`position_desc`)
)
  COMMENT='Positions'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `units` (
  `unit_id`       int(5) unsigned NOT NULL auto_increment,
  `unit_sdesc`    varchar(10) NOT NULL default '',
  `unit_desc`     varchar(64) NOT NULL default '',
  `created_by`    int(5),
  `created_date`  datetime,
  `updated_by`    int(5),
  `updated_date`  datetime,
  PRIMARY KEY  `units_pk`  (`unit_id`),
  UNIQUE KEY  `units_uk` (`unit_desc`)
)
  COMMENT='Unit of Measures'
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

CREATE TABLE IF NOT EXISTS `stores` (
  `store_id`     int(5) unsigned NOT NULL auto_increment,
  `store_name`   varchar(100) NOT NULL default '',
  `supplier_id`  int(5),  
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `stores_pk`  (`store_id`),
  UNIQUE KEY `stores_uk` (`store_name`)
)
  COMMENT='stores'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `locations` (
  `loc_id`       int(5) unsigned NOT NULL auto_increment,
  `location`     varchar(100) NOT NULL default '',
  `loc_group_id` int(5),
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `locations_pk`  (`loc_id`),
  UNIQUE KEY `locations_uk` (`location`)
)
  COMMENT='Locations/Warehouses'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `store_loc` (
  `store_loc_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc`    varchar(100) NOT NULL default '',
  `loc_id`       int(5),
  `store_id`     int(5),
  `is_cart`      int(5) NOT NULL default '0', 
  `active`       int(5) NOT NULL default '1', 
  `last_posted_dcash` datetime,
  `last_posted_dsales` datetime,
  `created_by`   int(5),
  `created_date` datetime,
  `updated_by`   int(5),
  `updated_date` datetime,
  PRIMARY KEY `store_loc_pk`  (`store_loc_id`),
  UNIQUE KEY `store_loc_uk` (`loc_id`,`store_id`, `store_loc`)
)
  COMMENT='Store locations'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

  CREATE TABLE IF NOT EXISTS `deductions_ref` (
  `deduction_ref_id`  int(5) unsigned NOT NULL auto_increment,
  `deduction_code`    varchar(64) NOT NULL default '', 
  `deduction_desc`    varchar(64) NOT NULL default '', 
  `deduction_pct`     decimal(7,2),
  `default_amt`       decimal(7,2),
  `created_by`        int(5),
  `created_date`      datetime,
  `updated_by`        int(5),
  `updated_date`      datetime,
  PRIMARY KEY  `deductions_ref_pk`  (`deduction_ref_id`),
  UNIQUE KEY  `deductions_ref_uk` (`deduction_code`)
)
  COMMENT='Deductions Reference file'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

CREATE TABLE IF NOT EXISTS `employees` (
  `empl_id`        int(5) unsigned NOT NULL auto_increment,
  `empl_idno`      varchar(10) NOT NULL default '',,
  `empl_name`      varchar(64) NOT NULL default '',
  `loc_id`         int(5),
  `store_loc_id`   int(5),
  `position_id`    int(5),
  `daily_rate`     decimal(7,2),
  `sss_no`         varchar(20),
  `pagibig_no`     varchar(20),
  `tin`            varchar(20),
  `philhealth_no`  varchar(20),
  `civil_status`   varchar(20),
  `active`         int(5) NOT NULL default '1', 
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY `employees_pk` (`empl_id`),
  UNIQUE KEY `employees_name` (`empl_name`),
  UNIQUE KEY `employees_idno` (`empl_idno`)
)
  COMMENT='Employees'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;


CREATE TABLE IF NOT EXISTS `users` (
  `user_id`         int(5) unsigned NOT NULL,
  `user_password`   varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_name`       varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `empl_id`         int(5) DEFAULT NULL,
  `role_id`         int(5) DEFAULT NULL,
  `active`          int(5) NOT NULL DEFAULT '1',
  `created_by`      int(5) DEFAULT NULL,
  `created_date`    datetime DEFAULT NULL,
  `updated_by`      int(5) DEFAULT NULL,
  `updated_date`    datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `user_locations` (
  `user_loc_id`    int(5) unsigned NOT NULL auto_increment,
  `user_id`        int(5),
  `loc_id`         int(5),
  `created_by`     int(5),
  `created_date`   datetime,
  `updated_by`     int(5),
  `updated_date`   datetime,
  PRIMARY KEY `user_locations_pk`  (`user_loc_id`),
  UNIQUE KEY `user_locations_uk` (`user_id`,`loc_id`)
)
  COMMENT='User Locations Access'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

 CREATE TABLE IF NOT EXISTS `store_supplies` (
  `store_supply_id` int(5) unsigned NOT NULL auto_increment,
  `store_id`        int(5),
  `supply_id`       int(5),
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `store_supplies_pk`  (`store_supply_id`),
  UNIQUE KEY `store_supplies_uk` (`store_id`,`supply_id`)
)
  COMMENT='Store supplies reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;     

CREATE TABLE IF NOT EXISTS `loc_supplies` (
  `loc_supply_id`   int(5) unsigned NOT NULL auto_increment,
  `loc_id`          int(5),
  `supply_id`       int(5),
  `reorder_level`   int(5),
  `max_level`       int(5),
  `ordered_qty`     int(5),  
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `loc_supplies_pk`  (`loc_supply_id`),
  UNIQUE KEY `loc_supplies_uk` (`loc_id`,`supply_id`)
)
  COMMENT='Location Supplies'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
  

CREATE TABLE IF NOT EXISTS `loc_supply_brands` (
  `loc_supply_brand_id` int(5) unsigned NOT NULL auto_increment,
  `loc_supply_id`       int(5),
  `supply_brand_id`     int(5),  
  `stock_qty`           decimal(10,2),
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `loc_supply_brands_pk`  (`loc_supply_brand_id`),
  UNIQUE KEY `loc_supply_brands_uk` (`loc_supply_id`,`supply_brand_id`)
)
  COMMENT='Location Supplies per brand'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `po` (
  `po_id`           int(5) unsigned NOT NULL auto_increment,
  `po_no`           int(5),
  `po_date`         datetime,
  `loc_id`          int(5),
  `supplier_id`     int(5),
  `posted`          int(5) NOT NULL default '0',    
  `status`          VACHAR(1) default 'O',      
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
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
  `cancelled_qty`      decimal(10,2),
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

 CREATE TABLE IF NOT EXISTS `payroll` (
  `payroll_id`      int(5) unsigned NOT NULL auto_increment,
  `payroll_date_fr` datetime,
  `payroll_date_to` datetime,
  `posted`          int(5) NOT NULL default '0',     
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `receiving_pk`  (`payroll_id`),
  UNIQUE KEY `receiving_uk` (`payroll_date_fr`, `payroll_date_to`)
)
  COMMENT='Payroll header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 
  
 CREATE TABLE IF NOT EXISTS `payroll_dtls` (
  `payroll_dtl_id`  int(5) unsigned NOT NULL auto_increment,
  `payroll_id`      int(5),
  `empl_id`         int(5),
  `no_day`          decimal(6,2),
  `no_holidays`     int(5),
  `daily_rate`      decimal(7,2),
  `holiday_rate`    decimal(7,2),
  `gross_pay_amt`   decimal(7,2),
  `ttl_ded`         decimal(7,2),
  `net_pay_amt`     decimal(7,2),  
  `posted`          int(5) NOT NULL default '0',     
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `receiving_pk`  (`payroll_id`),
  UNIQUE KEY `receiving_uk` (`payroll_date_fr`, `payroll_date_to`)
)
  COMMENT='Payroll header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 
  


 CREATE TABLE IF NOT EXISTS `receiving` (
  `receiving_id`    int(5) unsigned NOT NULL auto_increment,
  `dr_no`           int(5),
  `dr_date`         datetime,
  `po_id`           int(5),
  `posted`          int(5) NOT NULL default '0',     
  `created_by`      int(5),
  `created_date`    datetime,
  `updated_by`      int(5),
  `updated_date`    datetime,
  PRIMARY KEY `receiving_pk`  (`receiving_id`),
  UNIQUE KEY `receiving_uk` (`dr_no`, `po_id`)
)
  COMMENT='Receiving of orders header'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   

 CREATE TABLE IF NOT EXISTS `receiving_dtls` (
  `receiving_dtl_id`   int(5) unsigned NOT NULL auto_increment,
  `receiving_id`       int(5),
  `po_dtl_id`          int(5),
  `supply_brand_id`    int(5),
  `dr_qty`             decimal(10,2),
  `bal_qty`            decimal(10,2),
  `created_by`         int(5),
  `created_date`       datetime,
  `updated_by`         int(5),
  `updated_date`       datetime,
  PRIMARY KEY `receiving_dtls_pk`  (`receiving_dtl_id`),
  UNIQUE KEY `receiving_dtls_uk` (`receiving_id`,`po_dtl_id`)
)
  COMMENT='Receving of orders details'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

  CREATE TABLE IF NOT EXISTS `store_daily_cash` (
  `store_daily_cash_id`           int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`                  int(5),
  `tran_date`                     datetime,
  `fr_store_daily_cash_id`        int(5),
  `emp_id`                        int(5), 
  `event_id`                      int(5),  
  `ttl_cash_box_amt`              decimal(7,2),
  `ttl_return_amt`                decimal(7,2),
  `ttl_cash_sales_amt`            decimal(7,2),
  `ttl_stock_sales_amt`           decimal(7,2),
  `ttl_exp_amt`                   decimal(7,2),
  `depo_amt`                      decimal(7,2),
  `short_excess_amt`              decimal(7,2),
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

  CREATE TABLE IF NOT EXISTS `store_loc_exp` (
   `store_loc_exp_id`     int(5) unsigned NOT NULL auto_increment,
   `store_loc_id`         int(5),
   `store_daily_cash_id`  int(5),
   `exp_date`             datetime,
   `posted`               int(5) NOT NULL default '0',     
   `created_by`           int(5),
   `created_date`         datetime,
   `updated_by`           int(5),
   `updated_date`         datetime,
   PRIMARY KEY `store_loc_exp_pk`  (`store_loc_exp_id`),
   UNIQUE KEY `store_loc_exp_uk` (`exp_date`,`store_loc_id`)
 )
   COMMENT='Store Location Expenses'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
   
   
  CREATE TABLE IF NOT EXISTS `store_loc_exp_dtls` (
   `store_loc_exp_dtl_id`   int(5) unsigned NOT NULL auto_increment,
   `store_loc_exp_id`       int(5),
   `exp_desc`               VARCHAR(100),
   `exp_amt`                decimal(7,2),
   `or_no`                  VARCHAR(20),
   `fr_cb_amt`              int(1) NOT NULL default '0',
   `created_by`             int(5),
   `created_date`           datetime,
   `updated_by`             int(5),
   `updated_date`           datetime,
   PRIMARY KEY `store_loc_exp_dtls_pk`  (`store_loc_exp_dtl_id`),
   UNIQUE KEY `store_loc_exp_dtls_uk` (`store_loc_exp_id`,`exp_desc`)
 )
   COMMENT='Store Location Expense Details'
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
 
   CREATE TABLE IF NOT EXISTS `store_bank_depo` (
  `store_bank_depo_id`  int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`        int(5),
  `sales_date`          datetime,  
  `act_depo_date`       datetime,  
  `depo_amt`            decimal(7,2),
  `posted`              int(5) NOT NULL default '0',      
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `store_bank_depo_pk`  (`store_bank_depo_id`),
  UNIQUE KEY `store_bank_depo_uk` (`store_loc_id`,`sales_date`)
)
  COMMENT='Store Bank Deposits'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


   CREATE TABLE IF NOT EXISTS `store_bank_depo_dtls` (
  `store_bank_depo_dtl_id`  int(5) unsigned NOT NULL auto_increment,
  `store_bank_depo_id`  int(5),
  `bank_ref_id`         int(5),
  `depo_pct_share`      int(5),
  `depo_amount`         decimal(7,2),
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `store_bank_depo_dtls_pk`  (`store_bank_depo_dtl_id`),
  UNIQUE KEY `store_bank_depo_dtls_uk` (`store_bank_depo_id`,`bank_ref_id`)
)
  COMMENT='Store Bank Deposits Details'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `adjustments_ref` (
  `adjmt_id`   int(5) unsigned NOT NULL auto_increment,
  `adjmt_desc` varchar(20) NOT NULL default '',
  `posted`        int(5) NOT NULL default '0',     
  `created_by`    int(5),
  `created_date`  datetime,
  `updated_by`    int(5),
  `updated_date`  datetime,
  PRIMARY KEY `adjustments_ref_pk`  (`adjmt_id`),
  UNIQUE KEY `adjustments_ref_uk` (`adjmt_desc`)
)
  COMMENT='Supply Adjustment'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
  
CREATE TABLE IF NOT EXISTS `stock_adjustments` (
  `stock_adjmt_id`        int(5) unsigned NOT NULL auto_increment,
  `stock_adjmt_no`        int(5),
  `adjmt_date`            datetime,
  `loc_id`                int(5),
  `store_loc_id`          int(5),
  `adjmt_id`              int(5),
  `adjmt_remarks`         varchar(200) NOT NULL default '',
  `loc_supply_brand_id`   int(5),
  `store_loc_supply_daily_id`   int(5), 
  `curr_qty`              decimal(5,2),
  `adjmt_qty`             decimal(5,2),
  `diff_qty`              decimal(5,2),
  `posted`                int(5) NOT NULL default '0',     
  `created_by`            int(5),
  `created_date`          datetime,
  `updated_by`            int(5),
  `updated_date`          datetime,
  PRIMARY KEY `stock_adjustments_pk`  (`stock_adjmt_id`),
  UNIQUE KEY `stock_adjustments_uk` (`stock_adjmt_no`)
)
  COMMENT='Stock Adjustment'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
 
  
 CREATE TABLE IF NOT EXISTS `events` (
  `event_id` int(5) unsigned NOT NULL auto_increment,
  `event_desc`          int(5),
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `eventss_pk`  (`event_id`),
  UNIQUE KEY `events_uk` (`event_desc`)
)
  COMMENT='Events reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `store_loc_supplies` (
  `store_loc_supply_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`        int(5),
  `loc_supply_id`       int(5),
  `stock_daily_qty`     decimal(5,2),
  `unit_id`             int(5),
  `prev_qty`            decimal(7,2), 
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `store_loc_supplies_pk`  (`store_loc_supply_id`),
  UNIQUE KEY `store_loc_supplies_uk` (`store_loc_id`,`loc_supply_id`)
)
  COMMENT='Store Location Supplies reference'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;   
  
  
  CREATE TABLE IF NOT EXISTS `loc_pc` (
   `loc_pc_id`      int(5) unsigned NOT NULL auto_increment,
   `pc_no`          int(5),
   `pc_date`        datetime,
   `loc_id`         int(5),
   `store_id`       int(5),
   `store_loc_id`   int(5),
   `posted` int(5)  NOT NULL default '0',    
   `created_by`     int(5),
   `created_date`   datetime,
   `updated_by`     int(5),
   `updated_date`   datetime,
   PRIMARY KEY `loc_pc_pk`  (`loc_pc_id`),
   UNIQUE KEY `loc_pc_uk` (`pc_no`,`loc_id`,`store_loc_id`)
 )
   COMMENT='Stock Physical Count header per location'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

  CREATE TABLE IF NOT EXISTS `loc_pc_dtls` (
   `loc_pc_dtl_id`        int(5) unsigned NOT NULL auto_increment,
   `loc_pc_id`            int(5),
   `loc_supply_brand_id`  int(5),
   `store_loc_supply_id`  int(5),
   `pc_qty`               decimal(7,2),
   `created_by`           int(5),
   `created_date`         datetime,
   `updated_by`           int(5),
   `updated_date`         datetime,
   PRIMARY KEY `loc_pc_dtls_pk`  (`loc_pc_dtl_id`),
   UNIQUE KEY `loc_pc_dtls_uk` (`loc_pc_id`,`loc_supply_brand_id`,`store_loc_supply_id` )
 )
   COMMENT='Stock Physical Count details per location'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin; 

 
  CREATE TABLE IF NOT EXISTS `supply_is` (
   `supply_is_id`   int(5) unsigned NOT NULL auto_increment,
   `is_no`          int(5),
   `is_date`        datetime,
   `store_loc_id`   int(5),
   `posted`         int(5) NOT NULL default '0',    
   `created_by`     int(5),
   `created_date`   datetime,
   `updated_by`     int(5),
   `updated_date`   datetime,
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
   `created_by`              int(5),
   `created_date`            datetime,
   `updated_by`              int(5),
   `updated_date`            datetime,
   PRIMARY KEY `supply_is_dtls_pk`  (`supply_is_dtl_id`),
   UNIQUE KEY `supply_is_dtls_uk` (`supply_is_id`,`loc_supply_brand_id`)
 )
   COMMENT='Stock Issuance details to stores'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;    

 CREATE TABLE IF NOT EXISTS `store_loc_supply_daily` (
  `store_loc_supply_daily_id` int(5) unsigned NOT NULL auto_increment,
  `store_loc_supply_id`           int(5),
  `stock_date`                    datetime,
  `loc_qty`                       decimal(7,2) DEFAULT 0,
  `onhand_qty`                    decimal(7,2) DEFAULT 0,
  `beg_qty`                       decimal(7,2) DEFAULT 0,
  `remaining_qty`                 decimal(7,2) DEFAULT 0,
  `is_qty`                        decimal(7,2) DEFAULT 0,
  `out_qty`                       decimal(7,2) DEFAULT 0,
  `returned_qty`                  decimal(7,2) DEFAULT 0,
  `end_qty`                       decimal(7,2) DEFAULT 0,
  `unit_price`                    decimal(7,2) DEFAULT 0,
  `unit_cost`                     decimal(7,2) DEFAULT 0,
  `created_by`                    int(5),
  `created_date`                  datetime,
  `updated_by`                    int(5),
  `updated_date`                  datetime,
  PRIMARY KEY `store_loc_supply_daily_pk`  (`store_loc_supply_daily_id`),
  UNIQUE KEY `store_loc_supply_daily_uk` (`store_loc_supply_id`,`stock_date`)
)
  COMMENT='Store Location Supplies daily stocks'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
   
   CREATE TABLE IF NOT EXISTS `stock_transfer` (
   `st_id`         int(5) unsigned NOT NULL auto_increment,
   `st_no`         int(5),
   `st_date`       datetime,
   `loc_id`        int(5),
   `loc_id_to`     int(5),
   `posted` int(5) NOT NULL default '0',    
   `created_by`    int(5),
   `created_date`  datetime,
   `updated_by`    int(5),
   `updated_date`  datetime,
   PRIMARY KEY `stock_transfer_pk`  (`st_id`),
   UNIQUE KEY `stock_transfer_uk` (`st_no`,`loc_id`)
 )
   COMMENT='Stock Transfer header to other warehouse'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  
  

  CREATE TABLE IF NOT EXISTS `stock_transfer_dtls` (
   `st_dtl_id`               int(5) unsigned NOT NULL auto_increment,
   `st_id`                   int(5),
   `st_qty`                  decimal(7,2),
   `loc_supply_brand_id`     int(5),
   `created_by`              int(5),
   `created_date`            datetime,
   `updated_by`              int(5),
   `updated_date`            datetime,
   PRIMARY KEY `stock_transfer_dtls_pk`  (`st_dtl_id`),
   UNIQUE KEY `stock_transfer_dtls_uk` (`st_id`,`loc_supply_brand_id`)
 )
   COMMENT='Stock Transfer details to other warehouse'
   DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `inv_summ` (
  `inv_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `inv_summ_year`         int(5),
  `inv_summ_month`        int(5),
  `loc_id`                int(5),
  `supply_id`             int(5),
  `beg_qty`               decimal(10,2),
  `dr_qty`                decimal(10,2),
  `used_qty`              decimal(10,2),
  `adj_plus_qty`          decimal(10,2),
  `adj_minus_qty`         decimal(10,2),
  `end_qty`               decimal(10,2),
  `created_by`            int(5),
  `created_date`          datetime,
  `updated_by`            int(5),
  `updated_date`          datetime,
  PRIMARY KEY `inv_summ_pk`  (`inv_summ_id`),
  UNIQUE KEY `inv_summ_uk` (`inv_summ_year`,`inv_summ_month`,`loc_id`,`supply_id`)
)
  COMMENT='Inventory Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `sales_summ` (
  `sales_summ_id`           int(5) unsigned NOT NULL auto_increment,
  `sales_summ_year`         int(5),
  `sales_summ_month`        int(5),
  `store_loc_id`            int(5),
  `sales_amount`            decimal(10,2),
  `created_by`              int(5),
  `created_date`            datetime,
  `updated_by`              int(5),
  `updated_date`            datetime,
  PRIMARY KEY `sales_summ_pk`  (`sales_summ_id`),
  UNIQUE KEY `sales_summ_uk` (`sales_summ_year`,`sales_summ_month`,`store_loc_id`)
)
  COMMENT='Store Sales Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  


 CREATE TABLE IF NOT EXISTS `sales_supply_summ` (
  `sales_supply_id`           int(5) unsigned NOT NULL auto_increment,
  `sales_supply_year`         int(5),
  `sales_supply_month`        int(5),
  `store_loc_id`              int(5),
  `supply_id`                 int(5),
  `sales_amount`              decimal(10,2),
  `created_by`                int(5),
  `created_date`              datetime,
  `updated_by`                int(5),
  `updated_date`              datetime,
  PRIMARY KEY `sales_supply_pk`  (`sales_supply_id`),
  UNIQUE KEY `sales_supply_uk` (`sales_supply_year`,`sales_supply_month`,`store_loc_id`, `supply_id`)
)
  COMMENT='Store Sales Summary per Supply'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

   CREATE TABLE IF NOT EXISTS `store_bank_wd` (
  `store_bank_wd_id`    int(5) unsigned NOT NULL auto_increment,
  `store_loc_id`        int(5),
  `bank_ref_id`         int(5),
  `tran_no`             varchar(50),
  `cheque_no`           varchar(50),
  `wd_date`             datetime,  
  `wd_amount`           decimal(7,2),
  `posted`              int(5) NOT NULL default '0',      
  `created_by`          int(5),
  `created_date`        datetime,
  `updated_by`          int(5),
  `updated_date`        datetime,
  PRIMARY KEY `store_bank_wd_pk`  (`store_bank_wd_id`),
  UNIQUE KEY `store_bank_wd_uk` (`store_loc_id`,`bank_ref_id`,`wd_date`)
)
  COMMENT='Store Bank Withdraws'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `store_bank_depo_summ` (
  `bank_depo_summ_id`        int(5) unsigned NOT NULL auto_increment,
  `bank_depo_summ_year`      int(5),
  `bank_depo_summ_month`     int(5),
  `bank_ref_id`              int(5),
  `store_loc_id`             int(5),
  `depo_amount`              decimal(10,2),
  `created_by`               int(5),
  `created_date`             datetime,
  `updated_by`               int(5),
  `updated_date`             datetime,
  PRIMARY KEY `bank_depo_summ_pk`  (`bank_depo_summ_id`),
  UNIQUE KEY `bank_depo_summ_uk` (`bank_depo_summ_year`,`bank_depo_summ_month`,`bank_ref_id`,`store_loc_id`)
)
  COMMENT='Store Bank Deposits Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

 CREATE TABLE IF NOT EXISTS `store_bank_wd_summ` (
  `bank_wd_summ_id`         int(5) unsigned NOT NULL auto_increment,
  `bank_wd_summ_year`       int(5),
  `bank_wd_summ_month`      int(5),
  `bank_ref_id`             int(5),
 `store_loc_id`             int(5),
  `wd_amount`               decimal(10,2),
  `created_by`              int(5),
  `created_date`            datetime,
  `updated_by`              int(5),
  `updated_date`            datetime,
  PRIMARY KEY `bank_wd_summ_pk`  (`bank_wd_summ_id`),
  UNIQUE KEY `bank_wd_summ_uk` (`bank_wd_summ_year`,`bank_wd_summ_month`,`bank_ref_id`,`store_loc_id`)
)
  COMMENT='Store Bank Withdrawal Summary'
  DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;  

CREATE TABLE IF NOT EXISTS `months` (
  `month_id` int(5) NOT NULL,
  `month_fletter`   varchar(1) DEFAULT NULL,
  `month_sdesc`     varchar(3) DEFAULT NULL,
  `month_ldesc`     varchar(15 NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`month_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `console_logs` (
  `console_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  PRIMARY KEY (`console_log_id`)
) DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/* Views */
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
from  supplies
ORDER BY seq_no;

CREATE OR REPLACE VIEW store_supplies_v AS
select *, getUnitSDesc(unit_id) unit_desc, getSupplyType(supply_type_id) supply_type 
from  supplies;

CREATE OR REPLACE VIEW supplies2_v AS
select "" as loc_id, ""  as loc_supply_id, b.supply_id, b.seq_no, b.supply_code, "" as reorder_level, "" as max_level, b.unit_desc, "" as ttl_stocks, "" as ordered_qty, "" as store_id
from store_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;


CREATE OR REPLACE VIEW store_supplies_v AS
select store_id, store_supply_id, a.supply_id, b.supply_code, b.seq_no, b.unit_desc
from store_supplies a, supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW store_supplies2_v AS
select "" as store_id, "" as store_supply_id, supply_id, supply_code, seq_no, unit_desc
from supplies_v;

CREATE OR REPLACE VIEW supplier_supplies_v AS
select a.loc_id, a.loc_supply_id, a.supply_id, b.seq_no, b.supply_code, a.reorder_level, a.max_level, b.unit_desc, 
       getStockCount(loc_supply_id) as ttl_stocks, a.ordered_qty, b.store_id
from loc_supplies,      
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW loc_supplies_po_v AS
select a.loc_id, a.loc_supply_id, a.supply_id, b.seq_no, b.supply_code, a.reorder_level, a.max_level, b.unit_desc, 
       getStockCount(loc_supply_id) as ttl_stocks, a.ordered_qty, b.store_id, getSupplierIdByStore(b.store_id) as supplier_id
from loc_supplies a, store_supplies_v b 
WHERE a.supply_id = b.supply_id 
ORDER BY b.seq_no;

CREATE OR REPLACE VIEW loc_supplies_v AS 
select a.loc_id, a.loc_supply_id, a.supply_id, b.seq_no, b.supply_code, a.reorder_level, a.max_level, b.unit_desc, 
       IFNULL(getStockCount(loc_supply_id),0) as ttl_stocks, a.ordered_qty, b.store_id
from loc_supplies a, store_supplies_v b     
WHERE a.supply_id = b.supply_id;
  

CREATE OR REPLACE VIEW loc_supplies2_v AS
select a.*, b.seq_no, b.supply_code, b.unit_desc, IFNULL(getStockCount(loc_supply_id),0) as ttl_stocks, a.ordered_qty, b.store_id
from loc_supplies a, store_supplies_v b
WHERE a.supply_id = b.supply_id;

CREATE OR REPLACE VIEW supply_brands_v AS
select a.supply_brand_id, a.supply_id, a.brand_id, b.brand_name, a.conv_id, a.supply_cost, if(a.brand_id=1,c.supply_code, concat(c.supply_code ,' ', b.brand_name)) as supply, d.cu_desc, conv_unit_qty 
from supply_brands a, brands b, supplies c, conv_units_v d
WHERE a.brand_id = b.brand_id
AND a.supply_id = c.supply_id
AND a.conv_id = d.conv_id;

CREATE OR REPLACE VIEW loc_supply_brands_v AS
select a.*, b.supply_id, b.seq_no, b.supply_code, b.loc_id, c.brand_name, c.cu_desc, concat(b.supply_code, ' ', c.brand_name, ' ', c.cu_desc, ' (',a.stock_qty ,')') as brand_supply, c.conv_unit_qty, "" as store_loc_supply_id, b.store_id
from loc_supply_brands a, loc_supplies_v b, supply_brands_v c
WHERE a.loc_supply_id = b.loc_supply_id
AND a.supply_brand_id = c.supply_brand_id
ORDER BY seq_no;

CREATE OR REPLACE VIEW users_v AS
SELECT *, getEmplName(empl_id) as empl_name
FROM users;

CREATE OR REPLACE VIEW role_users_v AS
select a.*, b.user_id, b.user_name, b.empl_name
from roles a, users_v b
WHERE a.role_id = b.role_id;

CREATE OR REPLACE VIEW role_menus_v AS
select a.*, b.menu_name, b.menu_url, b.menu_def, b.menu_type_id, b.system_id, b.seq_no
from role_menus a, menu b
WHERE a.menu_id = b.menu_id;

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

CREATE OR REPLACE VIEW store_loc_supplies_dd_v as
SELECT a.store_loc_supply_id, store_loc_id, b.supply_code, b.unit_desc, CONCAT(b.supply_code, '/' , b.unit_desc) as supply, prev_stock_qty as stock_qty
FROM store_loc_supplies a, loc_supplies_v b
WHERE a.loc_supply_id = b.loc_supply_id
order by b.supply_code;

CREATE OR REPLACE VIEW store_loc_supplies_v AS
SELECT a.store_loc_supply_id, a.store_loc_id, b.store_id, b.supply_id, a.loc_supply_id, b.supply_code, b.unit_desc, a.stock_daily_qty, 
ifnull(prev_qty,0) as prev_qty,
getSupplyUprice(b.supply_id) as unit_price, getSupplyUcost(b.supply_id) as unit_cost,"" as loc_supply_brand_id, b.loc_id
FROM store_loc_supplies a, loc_supplies_v b
WHERE a.loc_supply_id = b.loc_supply_id
order by b.seq_no;

CREATE OR REPLACE VIEW store_loc_supplies2_v AS
select "" as store_loc_supply_id, "" as store_loc_id, a.store_id, a.supply_id, "" as loc_supply_id, b.supply_code, b.unit_desc, "" as stock_daily_qty, "" as prev_qty,
getSupplyUprice(b.supply_id) as unit_price, getSupplyUcost(b.supply_id) as unit_cost, "" as loc_supply_brand_id, '' as loc_id
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
getSupplyUprice(supply_id) as unit_price, getSupplyUcost(supply_id) as unit_cost, c.store_loc_supply_id
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
from po_dtls a, loc_supplies_v b
where a.loc_supply_id = b.loc_supply_id;

create or replace view po_dtlswithbal_v as
select a.*, b.supply_code, b.unit_desc 
from po_dtls a, supplies_v b
where bal_qty > 0 and getSupplierIdByLoc(a.supply_id) = b.supply_id;


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
from po_dtls_v a, loc_supply_brands_v b
where a.loc_supply_id = b.loc_supply_id;

create or replace view receiving_dtls_po_v as
select a.*, b.supply_code, b.unit_desc, getPOLocId(b.po_id) loc_id, b.brand_name, b.cu_desc, (a.bal_qty - a.dr_qty) as end_qty, b.loc_supply_id
from receiving_dtls a, supply_brands_po_dtls_v b
where a.po_dtl_id = b.po_dtl_id
and a.supply_brand_id = b.supply_brand_id;

CREATE OR REPLACE VIEW loc_pc_dtls_v AS
SELECT a.loc_pc_dtl_id, a.loc_pc_id ,a.loc_supply_brand_id, a.pc_qty as stock_qty, c.loc_id, c.store_loc_id, c.pc_date, b.seq_no, b.supply_code, b.brand_name, b.cu_desc
FROM loc_pc_dtls a, loc_supply_brands_v b, loc_pc c
WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
AND a.loc_pc_id=c.loc_pc_id;

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

CREATE OR REPLACE VIEW loc_pc_dtls_v as
SELECT a.*, b.loc_id, b.store_loc_id,  b.tran_date
FROM loc_pc_dtls a, loc_pc b
WHERE a.loc_pc_id=b.loc_pc_id;

CREATE OR REPLACE VIEW store_loc_supply_daily_v AS
select a.*,b.loc_id, b.store_loc_id, b.supply_code, b.unit_desc, b.loc_supply_id, 
ifnull(a.unit_price,0) * ifnull(a.out_qty,0) as sales_amount, ifnull(a.unit_cost,0) * ifnull(a.out_qty,0) as cost_amount, 
CONCAT(b.supply_code, ' (', a.remaining_qty, b.unit_desc, ')') as supply, b.supply_id, getLocSupplyBrandIdByLocSupplyId(loc_supply_id) 
from store_loc_supply_daily a, store_loc_supplies_v b
where a.store_loc_supply_id=b.store_loc_supply_id;

CREATE OR REPLACE VIEW revisions_latest_v as
select * from revision_logs
where revision_id in (select distinct getlatestrevid(filename) as revision_id from revision_logs);

CREATE OR REPLACE VIEW sales_staffs_v as
SELECT * FROM employees
where position_id = 4;

CREATE OR REPLACE VIEW store_daily_cash_v as
SELECT *, getEmplName(empl_id) as empl_name  FROM store_daily_cash;

CREATE OR REPLACE VIEW loc_pc_dtls_group_v AS
SELECT loc_pc_id, getLocSupplyIdByBrandId(loc_supply_brand_id) AS loc_supply_id, sum(pc_qty * getSupplyConvQty(loc_supply_brand_id)) as sum_stock_qty
FROM loc_pc_dtls
GROUP BY loc_pc_id, getLocSupplyIdByBrandId(loc_supply_brand_id);

CREATE OR REPLACE VIEW store_bank_depo_v AS
SELECT *
   FROM store_bank_depo

CREATE OR REPLACE VIEW store_bank_depo_dtls_v as
SELECT a.*, b.store_loc_id, b.act_depo_date, getBankName(a.bank_ref_id), b.sales_date
  FROM store_bank_depo_dtls a, store_bank_depo b
 WHERE a.store_bank_depo_id=b.store_bank_depo_id;
  
 
CREATE OR REPLACE VIEW status_v as
  SELECT 'O' as status_code, 'Open' as status
   UNION 
   SELECT 'C' as status_code, 'Closed' as status
   UNION 
   SELECT 'X' as status_code, 'Cancelled' as status;
   
/* truncate    
truncate loc_pc
truncate loc_pc_dtls
truncate supply_is
truncate supply_is_dtls
turncate store_loc_supply_daily
truncate store_daily_cash
truncate store_daily_cash_dtls
truncate store_loc_exp
truncate store_loc_exp_dtls
truncate store_bank_depo
truncate store_bank_depo_dtls
truncate stock_transfer
truncate stock_transfer_dtls
truncate stock_adjustments
truncate po
truncate po_dtls
truncate receiving
truncate receiving_dtls
*/