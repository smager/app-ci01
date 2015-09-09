/*Procedure, Function*/

 create function getlatestrevid(p_filename varchar(100)) returns varchar(100)
 DETERMINISTIC
 begin
   declare lvl varchar(100);
   select revision_id into lvl
   from revision_logs
   where filename=p_filename
   order by revision_id desc limit 1;
   return (lvl);
 end;

create function  getUnitSDesc(p_unit_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT unit_desc INTO lvl FROM units WHERE unit_id=p_unit_id;
 RETURN (lvl);
END;

create function  getSupplyType(p_supply_type_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT supply_type INTO lvl FROM supply_types WHERE supply_type_id=p_supply_type_id;
 RETURN (lvl);
END;


create function  getSupplyUprice(p_supply_id int) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT supply_srp INTO lvl FROM supplies WHERE supply_id=p_supply_id;
 RETURN (lvl);
END;

create function  getSupplyUcost(p_supply_id int) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT supply_cost INTO lvl FROM supplies WHERE supply_id=p_supply_id;
 RETURN (lvl);
END;

create function  getSupplyUcostByBrandUnit(p_supply_brand_id int) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT supply_cost INTO lvl FROM supply_brands WHERE supply_brand_id=p_supply_brand_id;
 RETURN (lvl);
END;

create function  getEmplName(p_empl_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT empl_name INTO lvl FROM employees WHERE empl_id=p_empl_id;
 RETURN (lvl);
END;

create function  getSupplier(p_supplier_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT supplier_name INTO lvl FROM suppliers WHERE supplier_id=p_supplier_id;
 RETURN (lvl);
END;

create function  getLocation(p_loc_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT location INTO lvl FROM locations WHERE loc_id=p_loc_id;
 RETURN (lvl);
END;

create function  getLocIdFromStoreLoc(p_store_loc_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl int(5);
    SELECT loc_id INTO lvl FROM store_loc WHERE store_loc_id=p_store_loc_id;
 RETURN (lvl);
END;

create function  getPOLocId(p_po_id int) RETURNS INT(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT loc_id INTO lvl FROM po WHERE po_id=p_po_id;
 RETURN (lvl);
END;

create function  getStockCount(p_loc_supply_id int) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT sum(stock_qty) INTO lvl FROM loc_supply_brands WHERE loc_supply_id=p_loc_supply_id;
 RETURN (lvl);
END;


create function  getLocSupplyId(p_loc_id int, p_supply_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT loc_supply_id INTO lvl FROM loc_supplies WHERE loc_id = p_loc_id and supply_id = p_supply_id; 
 RETURN (ifnull(lvl,0));
END;

create function  getLocSupplyIdByBrandId(p_loc_supply_brand_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT loc_supply_id INTO lvl FROM loc_supply_brands WHERE loc_supply_brand_id = p_loc_supply_brand_id; 
 RETURN (ifnull(lvl,0));
END;

create function  getSupplyConvQty(p_loc_supply_brand_id int) RETURNS decimal(5,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(5,2);
    SELECT conv_unit_qty INTO lvl FROM loc_supply_brands_v WHERE loc_supply_brand_id = p_loc_supply_brand_id; 
 RETURN (ifnull(lvl,0));
END;

create function  getLocSupplyBrandId(p_loc_id int, p_supply_id int, p_supply_brand_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT loc_supply_brand_id INTO lvl FROM loc_supply_brands WHERE supply_brand_id=p_supply_brand_id 
       AND loc_supply_id=(select loc_supply_id FROM loc_supplies WHERE loc_id = p_loc_id and supply_id = p_supply_id); 
 RETURN (ifnull(lvl,0));
END;

create function  getSupplyIdFromLoc(p_loc_supply_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT supply_id INTO lvl FROM loc_supplies WHERE loc_supply_id = p_loc_supply_id; 
 RETURN (ifnull(lvl,0));
END;

create function  getStoreLocSupplyId(p_store_loc_id, p_loc_supply_id int) RETURNS INT(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int(5);
    SELECT store_loc_supply_id INTO lvl FROM store_loc_supplies WHERE store_loc_id=p_store_loc_id and loc_supply_id=p_loc_supply_id;
 RETURN (lvl);
END;

create function  getSupplyBrandIdFromLoc(p_loc_supply_brand_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT supply_brand_id INTO lvl FROM loc_supply_brands_v WHERE loc_supply_brand_id=p_loc_supply_brand_id;
 RETURN (ifnull(lvl,0));
END;

create function  getPOBalCount(p_po_id int) RETURNS INT(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int(5);
    SELECT COUNT(po_id) INTO lvl FROM po_dtls WHERE po_id=p_po_id and ifnull(bal_qty,0) > 0 ;
 RETURN (lvl);
END;

CREATE FUNCTION getStoreLocSupplyDailySum(p_store_loc_id int(5), p_date date) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
 DECLARE lvl decimal(7,2);
    select SUM(out_qty * unit_price) INTO lvl from store_loc_supply_daily_v where store_loc_id = p_store_loc_id
    and stock_date = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getStoreLocDailyDenomSum(p_store_loc_id int(5), p_date VARCHAR(20)) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
 DECLARE lvl decimal(7,2);
    select SUM(return_amt) INTO lvl from store_daily_cash_dtls_v  where store_loc_id = p_store_loc_id
    and DATE_FORMAT(tran_date,'%m/%d/%Y') = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getStoreLocCashBoxAmt(p_store_loc_id int(5), p_date date) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
 DECLARE lvl decimal(7,2);
    select ttl_cash_box_amt INTO lvl from store_daily_cash where store_loc_id = p_store_loc_id
    and tran_date = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getStoreLocSalesExpSum(p_store_loc_id int(5), p_date date) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
 DECLARE lvl decimal(7,2);
    select SUM(exp_amt) INTO lvl from store_loc_sales_exp_dtls_v where store_loc_id = p_store_loc_id
    and exp_date = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getStoreLocExpSum(p_store_loc_id int(5), p_date date) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
 DECLARE lvl decimal(7,2);
    select SUM(exp_amt) INTO lvl from store_loc_exp_dtls_v where store_loc_id = p_store_loc_id
    and exp_date = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION get_store_pc_qty(p_store_loc_id int,  p_loc_supply_brand_id int, p_tran_date DATE) RETURNS decimal(7,2) 
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT pc_qty INTO lvl FROM loc_pc_dtls_v WHERE store_loc_id = p_store_loc_id and loc_supply_brand_id=p_loc_supply_brand_id AND  DATE_FORMAT(pc_date,'%m/%d/%Y') = p_tran_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getTotalStockSalesAmt(p_store_loc_id int, p_date DATE) DECIMAL(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl DECIMAL(7,2);
    SELECT ttl_stock_sales_amnt INTO lvl FROM store_daily_cash WHERE store_loc_id = p_store_loc_id and tran_date = str_to_date(p_date,'%m/%d/%Y');
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION get_store_daily_cash_id(p_store_loc_id int, p_tran_date DATE) RETURNS INT(5) 
    DETERMINISTIC
BEGIN
    DECLARE lvl INT(5);
    SELECT denomination_qty INTO lvl FROM store_daily_cash_dtls_v WHERE store_loc_id = p_store_loc_id and denomination=p_denomination AND  tran_date = p_tran_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION get_store_daily_cash_denom_qty(p_store_loc_id int,  p_denomination int, p_tran_date DATE) RETURNS INT(5) 
    DETERMINISTIC
BEGIN
    DECLARE lvl INT(5);
    SELECT denomination_qty INTO lvl FROM store_daily_cash_dtls_v WHERE store_loc_id = p_store_loc_id and denomination=p_denomination AND  tran_date = p_tran_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION get_store_daily_cash_denom_amt(p_store_loc_id int,  p_denomination int, p_tran_date DATE) RETURNS INT(5) 
    DETERMINISTIC
BEGIN
    DECLARE lvl INT(5);
    SELECT cash_amount INTO lvl FROM store_daily_cash_dtls_v WHERE store_loc_id = p_store_loc_id and denomination=p_denomination AND  tran_date = p_tran_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getStoreDailyCashDepoAmt(p_store_loc_id int(5), p_date DATE) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT depo_amt INTO lvl FROM store_daily_cash WHERE store_loc_id = p_store_loc_id AND  tran_date = p_date; 
 RETURN (ifnull(lvl,0));
END;

CREATE FUNCTION getBankName(p_bank_ref_id int(5)) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl VARCHAR(100);
    SELECT bank_name INTO lvl FROM bank_ref WHERE bank_ref_id = p_bank_ref_id;
 RETURN (ifnull(lvl,''));
END;

/*PROCEDURES*/

CREATE PROCEDURE getLocSuppliesReorder(p_loc_id int(5))
BEGIN
select * from loc_supplies_v where ttl_stocks <= reorder_level
and loc_id=p_loc_id;
END;

CREATE PROCEDURE getStoreDailyCash(p_store_loc_id INT(10),p_date VARCHAR(20))
BEGIN
     SELECT *, getEmplName(empl_id) as empl_name, getEvent(event_id) as event_desc
       FROM store_daily_cash 
      WHERE store_loc_id =p_store_loc_id
        AND tran_date = str_to_date(p_date,'%m/%d/%Y');
END;

CREATE PROCEDURE getStoreDailyCashById(IN p_store_daily_cash_id INT(10))
BEGIN
     SELECT *, getEmplName(empl_id) as empl_name,, getEvent(event_id) as event_desc FROM store_daily_cash WHERE store_daily_cash_id =p_store_daily_cash_id;
END;

CREATE PROCEDURE getStoreLocSupplies (IN p_store_loc_id INT(10))
BEGIN
     SELECT * FROM store_loc_supplies_v WHERE store_loc_id =p_store_loc_id;
END;

CREATE PROCEDURE getSupplyIsUnposted (IN p_store_loc_id int, IN p_loc_supply_id int)
BEGIN
   DECLARE l_id INT(5);
   SELECT supply_is_id INTO l_id FROM supply_is WHERE posted=0 and store_loc_id = p_store_loc_id limit 1;
   IF IFNULL(l_id,0)=0 THEN
      SELECT *, "" as supply_is_id, "" as supply_is_dtl_id, "" as supply_is_qty FROM loc_supply_brands_v WHERE loc_supply_id =p_loc_supply_id and stock_qty > 0 ;
   ELSE
    SELECT a.supply_is_id, a.supply_is_dtl_id, b.loc_supply_id,  a.loc_supply_brand_id, b.stock_qty, b.brand_name, b.cu_desc, a.supply_is_qty
       FROM supply_is_dtls a, loc_supply_brands_v b
       WHERE a.loc_supply_brand_id = b.loc_supply_brand_id and a.supply_is_id = l_id
       AND b.loc_supply_id =p_loc_supply_id
      UNION
      SELECT "" as supply_is_id, "" as supply_is_dtl_id, a.loc_supply_id, a.loc_supply_brand_id, a.stock_qty, a.brand_name, a.cu_desc, "" as supply_is_qty 
        FROM loc_supply_brands_v a 
       WHERE a.stock_qty > 0 AND a.loc_supply_id = p_loc_supply_id AND NOT EXISTS (SELECT b.loc_supply_brand_id FROM supply_is_dtls b 
       WHERE b.loc_supply_brand_id = b.loc_supply_brand_id and supply_is_id = l_id);   
   END IF;   
END;

CREATE PROCEDURE setLocStockIsPost (IN p_supply_is_id INT)   
BEGIN
  UPDATE loc_supply_brands a, supply_is_dtls b
  SET a.stock_qty = a.stock_qty - b.supply_is_qty
  WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
  AND b.supply_is_id = p_supply_is_id;
END;

CREATE PROCEDURE setStoreStockIsPost (IN p_supply_is_id INT, p_store_loc_id INT, p_date VARCHAR(20))   
BEGIN
  DECLARE l_found VARCHAR(5);
  SELECT '1' INTO l_found FROM store_loc_supply_daily_v WHERE store_loc_id = p_store_loc_id AND DATE_FORMAT(stock_date,'%m/%d/%Y')=p_date limit 1;
  IF l_found='1' THEN
    UPDATE store_loc_supply_daily a, supply_is_dtls_v b
       SET a.is_qty = a.is_qty + b.supply_is_qty,
           a.beg_qty = beg_qty + b.supply_is_qty,
           a.end_qty = beg_qty + b.supply_is_qty
     WHERE b.supply_is_id = p_supply_is_id
       AND a.store_loc_supply_id = getStoreLocSupplyId(b.store_loc_id,b.loc_supply_id);
  ELSE
    
    INSERT INTO store_loc_supply_daily (store_loc_supply_id,  stock_date,  unit_price, unit_cost, is_qty, beg_qty, remaining_qty)
    SELECT store_loc_supply_id, str_to_date(p_date,'%m/%d/%Y'), unit_price, unit_cost,0,0, prev_qty FROM store_loc_supplies_v
    WHERE store_loc_id = p_store_loc_id;
    
    UPDATE store_loc_supply_daily a, supply_is_dtls_grp_v b
       SET a.is_qty = b.SumISQty
          ,a.beg_qty = b.SumISQty + a.remaining_qty
          ,a.end_qty = b.SumISQty + a.remaining_qty
     WHERE a.store_loc_supply_id = getStoreLocSupplyId(b.store_loc_id,b.loc_supply_id)
       AND b.supply_is_id = p_supply_is_id
       AND DATE_FORMAT(a.stock_date,'%m/%d/%Y') = p_date;
       
  END IF;
 DELETE FROM supply_is_dtls WHERE supply_is_id=p_supply_is_id and ifnull(supply_is_qty,0)=0;
END;

CREATE PROCEDURE setStoreLocSuppDailyRemQty(p_store_loc_id INT, p_date VARCHAR(20))
BEGIN

UPDATE store_loc_supplies a, store_loc_supply_daily b
     SET a.prev_qty = b.end_qty
   WHERE a.store_loc_supply_id = b.store_loc_supply_id
     AND DATE_FORMAT(b.stock_date,'%m/%d/%Y') = p_date;    
END;
   
CREATE PROCEDURE setLocStockIsUsagePost (IN p_supply_is_id INT)   
BEGIN
  DECLARE l_store_loc_id INT(5);
  SELECT store_loc_id INTO l_store_loc_id FROM supply_is where supply_is_id = p_supply_is_id;
  
  UPDATE loc_supply_brands a, supply_is_dtls b
  SET a.stock_qty = a.stock_qty + b.returned_qty
  WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
  AND b.supply_is_id = p_supply_is_id;

  UPDATE store_loc_supply_brands a, supply_is_dtls b
  SET a.stock_qty = b.beg_qty - b.used_qty
  WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
  AND b.supply_is_id = p_supply_is_id
  AND EXISTS (SELECT c.store_loc_supply_id 
                FROM store_loc_supplies c 
               WHERE c.store_loc_supply_id=a.store_loc_supply_id 
                 AND c.store_loc_id = l_store_loc_id);

END;

CREATE PROCEDURE getLocPC_Unposted(p_loc_id int(5))
BEGIN
select * from loc_pc where posted=0
and loc_id=p_loc_id;
END;


CREATE PROCEDURE getLocPC(p_loc_id INT, p_store_loc_id INT, p_loc_pc_id INT ) 
BEGIN
   IF ifNull(p_loc_pc_id,0) = 0 THEN
     IF ifNull(p_store_loc_id,0) = 0 THEN
        SELECT * FROM loc_supply_brands_v WHERE loc_id = p_loc_id;
     ELSE
        SELECT * FROM store_loc_supplies_v WHERE store_loc_id = p_store_loc_id;
     END IF;
   ELSE
     IF ifNull(p_store_loc_id,0) = 0 THEN
        SELECT * FROM loc_pc_dtls_v WHERE loc_pc_id = p_loc_pc_id;
     ELSE
        SELECT * FROM loc_pc_dtls_by_store_loc_v WHERE loc_pc_id = p_loc_pc_id;
     END IF;  
   END IF;
END;

CREATE PROCEDURE getStoreLocSupplyDaily(p_store_loc_id int(5), p_date VARCHAR(20), p_posted INT)
BEGIN
   SELECT * FROM store_loc_supply_daily_v 
    WHERE store_loc_id = p_store_loc_id
      AND DATE_FORMAT(stock_date,'%m/%d/%Y') = p_date
      AND posted=p_posted; 
END;


CREATE PROCEDURE delPC_Unposted (IN p_loc_pc_id int(5))
BEGIN
   DELETE FROM loc_pc_dtls WHERE loc_pc_id = p_loc_pc_id;
   DELETE FROM loc_pc WHERE loc_pc_id = p_loc_pc_id;
END; 

CREATE PROCEDURE delPO_Unposted (IN p_po_id int(5))
BEGIN
   DELETE FROM po_dtls WHERE po_id = po_id;
   DELETE FROM po WHERE po_id = p_po_id;
END; 

CREATE PROCEDURE store_daily_cash_postedCB(IN p_store_daily_cash_id int(5))
BEGIN
DECLARE l_cash_amt decimal(7,2);
DECLARE l_store_loc_id INT;
DECLARE l_tran_date date;
DECLARE l_created_by INT;
DECLARE l_created_date DATE;
DECLARE l_store_bank_depo_id INT;

SELECT store_loc_id, date_add(tran_date,interval -2 day), created_by, created_date
  INTO l_store_loc_id, l_tran_date, l_created_by, l_created_date
  FROM store_daily_cash
 WHERE store_daily_cash_id=p_store_daily_cash_id;

SELECT sum(IFNULL(cash_amount,0))
  INTO l_cash_amt
  FROM store_daily_cash_dtls 
 WHERE store_daily_cash_id=p_store_daily_cash_id;

UPDATE store_daily_cash 
   SET ttl_cash_box_amt   = l_cash_amt
 WHERE store_daily_cash_id=p_store_daily_cash_id;    

UPDATE store_daily_cash 
   SET depo_amt = ttl_return_amt - (l_cash_amt + IFNULL(ttl_exp_amt,0))
 WHERE store_loc_id=l_store_loc_id
  AND tran_date =l_tran_date;

select IFNULL(store_bank_depo_id,0) 
  INTO l_store_bank_depo_id
  FROM store_bank_depo        
 WHERE store_loc_id=l_store_loc_id
   AND sales_date=l_tran_date;     

IF IFNULL(l_store_bank_depo_id,0)=0 THEN
   INSERT INTO store_bank_depo       
        (store_loc_id, sales_date, depo_amt, created_by, created_date) 
         SELECT l_store_loc_id, l_tran_date,depo_amt, l_created_by, l_created_date FROM store_daily_cash    
          WHERE store_loc_id=l_store_loc_id
            AND sales_date =l_tran_date; 
ELSE
   UPDATE store_bank_depo
      SET depo_amt= getStoreDailyCashDepoAmt(l_store_loc_id,l_tran_date)
    WHERE store_bank_depo_id = l_store_bank_depo_id;
    
   DELETE FROM store_bank_depo_dtls WHERE store_bank_depo_id = l_store_bank_depo_id; 
END IF;
END;


CREATE PROCEDURE store_daily_cash_postedRet(IN p_store_daily_cash_id int(5))
BEGIN
DECLARE l_return_amt decimal(7,2);
DECLARE l_exp_amt decimal(7,2);
DECLARE l_sales_exp_amt decimal(7,2);
DECLARE l_ttl_stock_sales_amt decimal(7,2);

SELECT  sum(IFNULL(return_amount,0)) 
INTO l_return_amt 
FROM store_daily_cash_dtls 
WHERE store_daily_cash_id=p_store_daily_cash_id;

SELECT getStoreLocSalesExpSum(store_loc_id, tran_date), getStoreLocExpSum(store_loc_id, tran_date), getStoreLocSupplyDailySum(store_loc_id, tran_date) INTO l_sales_exp_amt, l_exp_amt, l_ttl_stock_sales_amt  FROM store_daily_cash WHERE store_daily_cash_id=p_store_daily_cash_id; 

UPDATE store_daily_cash 
   SET ttl_return_amt     = l_return_amt
      ,ttl_stock_sales_amt= l_ttl_stock_sales_amt
      ,ttl_sales_exp_amt  = l_sales_exp_amt
      ,ttl_exp_amt        = l_exp_amt
      ,ttl_cash_sales_amt = (l_return_amt + IFNULL(l_sales_exp_amt,0)) - getStoreLocCashBoxAmt(store_loc_id, date_add(tran_date,interval - 2 day))
 WHERE store_daily_cash_id=p_store_daily_cash_id;    
END;

CREATE PROCEDURE store_daily_cash_report(p_store_loc_id int, p_tran_date varchar(20))
BEGIN
   SELECT *, get_store_daily_cash_denom_qty(store_loc_id, denomination, date_add(str_to_date(p_tran_date,'%m/%d/%Y'),interval +2 day)) as today_qty
   FROM store_daily_cash_dtls_v
   WHERE store_loc_id = p_store_loc_id AND tran_date = str_to_date(p_tran_date,'%m/%d/%Y');
END;

CREATE PROCEDURE store_loc_exp_report(p_store_loc_id int, p_tran_date varchar(20))
BEGIN
   SELECT *
   FROM store_loc_exp_dtls_v 
   WHERE store_loc_id = p_store_loc_id AND exp_date = str_to_date(p_tran_date,'%m/%d/%Y');
END;

CREATE PROCEDURE store_loc_sales_exp_report(p_store_loc_id int, p_tran_date varchar(20))
BEGIN
   SELECT *
   FROM store_loc_sales_exp_dtls_v 
   WHERE store_loc_id = p_store_loc_id AND exp_date = str_to_date(p_tran_date,'%m/%d/%Y');
END;

CREATE PROCEDURE Receiving_post(p_receiving_id int(5))
BEGIN

UPDATE po_dtls a, receiving_dtls b 
SET a.bal_qty = a.bal_qty - b.dr_qty
WHERE a.po_dtl_id = b.po_dtl_id
AND b.receiving_id = p_receiving_id;

UPDATE loc_supply_brands a, receiving_dtls_po_v b
SET a.stock_qty = a.stock_qty + b.dr_qty
WHERE a.loc_supply_brand_id=getLocSupplyBrandId(b.loc_id, b.supply_id,b.supply_brand_id)
AND b.receiving_id = p_receiving_id;

INSERT INTO loc_supply_brands (loc_supply_id, supply_brand_id, stock_qty)
SELECT getLocSupplyId(loc_id,supply_id), supply_brand_id, dr_qty FROM receiving_dtls_po_v
WHERE receiving_id = p_receiving_id
AND ifnull(getLocSupplyBrandId(loc_id, supply_id, supply_brand_id),0) = 0; 
END;

CREATE PROCEDURE store_loc_supplies_ins (p_store_loc_id INT(10),p_store_id INT(10))
BEGIN  
DECLARE l_loc_id INT;
    SELECT loc_id INTO l_loc_id FROM store_loc WHERE store_loc_id=p_store_loc_id;
    IF ifnull(p_store_id,0) <> 0 THEN
       insert into store_loc_supplies (store_loc_id, loc_supply_id) 
       select p_store_loc_id, a.loc_supply_id
         from loc_supplies_v a
        where a.loc_id = l_loc_id 
        AND EXISTS (SELECT supply_id FROM store_supplies_v b WHERE b.supply_id = a.supply_id AND b.store_id = p_store_id); 
    END IF;
END;

CREATE PROCEDURE LocSupplyBrandsIns(p_loc_id int(5))
BEGIN
INSERT INTO loc_supply_brands (supply_brand_id, loc_supply_id)
SELECT a.supply_brand_id, getLocSupplyId(p_loc_id, a.supply_id) 
FROM supply_brands a
WHERE NOT EXISTS (SELECT supply_brand_id FROM loc_supply_brands b WHERE b.loc_supply_id =  getLocSupplyId(p_loc_id, a.supply_id));
END;

CREATE PROCEDURE loc_pc_post(p_loc_pc_id int(5), p_store_loc_id int(5), p_date varchar(20))
BEGIN
DECLARE l_found VARCHAR(5);
   IF ifnull(p_store_loc_id,0) = 0 THEN
      UPDATE loc_supply_brands a, loc_pc_dtls b 
      SET a.stock_qty = b.pc_qty
      WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
      AND b.loc_pc_id = p_loc_pc_id;    
   ELSE
     UPDATE store_loc_supplies a, loc_pc_dtls b
        SET a.prev_qty = b.pc_qty
      WHERE b.loc_pc_id = p_loc_pc_id
        AND a.store_loc_supply_id = b.store_loc_supply_id;
   END IF;
END; 

CREATE PROCEDURE stock_transfer_post(p_st_id int(5), p_loc_id_to int)
BEGIN
   UPDATE loc_supply_brands a, stock_transfer_dtls b
   SET a.stock_qty = a.stock_qty - b.st_qty
   WHERE st_id = p_st_id
   AND a.loc_supply_brand_id=b.loc_supply_brand_id;

   UPDATE loc_supply_brands_v a, stock_transfer_dtls b
   SET a.stock_qty = a.stock_qty + b.st_qty
   WHERE st_id = p_st_id
   AND a.supply_brand_id=getSupplyBrandIdFromLoc(b.loc_supply_brand_id)
   AND a.loc_id = p_loc_id_to;
END; 

CREATE PROCEDURE getStoreBankDepoInfo(p_store_loc_id int(5), p_date VARCHAR(20))
BEGIN
   SELECT * 
     FROM store_bank_depo
    WHERE store_loc_id = p_store_loc_id 
      AND sales_date = str_to_date(p_date,'%m/%d/%Y');
END;

CREATE PROCEDURE getStoreBanksDepo(p_store_bank_depo_id int(5), p_depo_amt decimal(7,2))
BEGIN
   DECLARE l_loopctr INT(5);
   DECLARE l_count INT(5);
   DECLARE l_id    INT(5);
   DECLARE l_pct_share INT(5);
   DECLARE l_depo_amt decimal(7,2);
   DECLARE l_run_amt  decimal(7,2);
   DECLARE exit_loop BOOLEAN; 
   DECLARE bank_ref_cur CURSOR FOR
                        SELECT bank_ref_id, depo_pct_share FROM bank_ref ORDER BY priority_no;
                        
   DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE;
   SET l_loopctr = 0;
   SELECT ifnull(COUNT(*),0) into l_count FROM store_bank_depo_dtls WHERE store_bank_depo_id= p_store_bank_depo_id;
   IF IfNull(l_count,0) = 0 THEN
      OPEN bank_ref_cur;
           bank_ref_loop: LOOP
      FETCH  bank_ref_cur INTO l_id, l_pct_share;
            IF exit_loop THEN
              CLOSE bank_ref_cur;
              LEAVE bank_ref_loop;
           END IF;
           if l_pct_share != 0 then
              SET l_depo_amt = ROUND(p_depo_amt * (l_pct_share/100));
              SET l_depo_amt = l_depo_amt + (100 - CONVERT(right(''+l_depo_amt,2),UNSIGNED INTEGER));           
              SET l_run_amt = ifnull(l_run_amt,0) + l_depo_amt;
           else
              SET l_depo_amt = p_depo_amt - l_run_amt;
           end if;
           INSERT INTO store_bank_depo_dtls (store_bank_depo_id, bank_ref_id, depo_pct_share,depo_amount) 
                values (p_store_bank_depo_id, l_id, l_pct_share,l_depo_amt);

   END LOOP bank_ref_loop;
   END IF; 
   SELECT *, getBankName(bank_ref_id) as bank_name FROM store_bank_depo_dtls where store_bank_depo_id=p_store_bank_depo_id;
   
END; 

CREATE PROCEDURE getDenominations(p_order VARCHAR(5))
BEGIN
   DECLARE l_stmt VARCHAR(2000);
   SET @s = CONCAT('SELECT * FROM denomination_ref ORDER BY 1 ', ifnull(p_order,'DESC'));
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;   
END;    

CREATE PROCEDURE getEmployees(p_loc_id INT, p_store_loc_id INT, p_position_id INT)
BEGIN
   DECLARE l_stmt VARCHAR(2000);
   DECLARE l_where VARCHAR(2000);
   SET l_where = ' WHERE 1=1';
   
   IF IFNULL(p_loc_id,0) <> 0 THEN
      SET l_where = CONCAT(l_where, ' AND loc_id = ', p_loc_id);
   END IF;
   
   IF IFNULL(p_store_loc_id,0) <> 0 THEN
      SET l_where = CONCAT(l_where, ' AND store_loc_id = ', p_store_loc_id);
   END IF;

   IF IFNULL(p_position_id,0) <> 0 THEN
      SET l_where = CONCAT(l_where, ' AND position_id = ', p_position_id);
   END IF;


   SET @s = CONCAT('SELECT * FROM employees ', l_where,  ' ORDER BY empl_name asc ');
    PREPARE stmt FROM @s;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;   
END; 

