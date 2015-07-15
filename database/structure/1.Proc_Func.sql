/*Procedure, Function*/

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

create function  getStoreLocTotalStocks(p_store_loc_supply_id int) RETURNS decimal(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl decimal(7,2);
    SELECT ttl_stocks INTO lvl FROM StoreLocSupplyBrandsSum_v WHERE store_loc_supply_id=p_store_loc_supply_id;
 RETURN (lvl);
END;

create function  getLocSupplyId(p_loc_id int, p_supply_id int) RETURNS int(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int;
    SELECT loc_supply_id INTO lvl FROM loc_supplies WHERE loc_id = p_loc_id and supply_id = p_supply_id); 
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

create function  getPOBalCount(p_po_id int) RETURNS INT(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int(5);
    SELECT COUNT(po_id) INTO lvl FROM po_dtls WHERE po_id=p_po_id and ifnull(bal_qty,0) > 0 ;
 RETURN (lvl);
END;

CREATE PROCEDURE getStoreLocSupplies (IN p_store_loc_id INT(10))
BEGIN
     SELECT * FROM store_loc_supplies_v WHERE store_loc_id =p_store_loc_id;
END

CREATE FUNCTION getStoreLocSupplyBrandStockQty (p_store_loc_id INT, p_loc_supply_brand_id INT) RETURNS DECIMAL(7,2)
    DETERMINISTIC
BEGIN
    DECLARE lvl DECIMAL(7,2);
    SELECT stock_qty INTO lvl FROM store_loc_supply_brands_v WHERE store_loc_id = p_store_loc_id and loc_supply_brand_id = p_loc_supply_brand_id; 
 RETURN (ifnull(lvl,0));
END;

CREATE PROCEDURE getSupplyIsUnposted (IN p_store_loc_id int, p_loc_supply_id int)
BEGIN
   DECLARE l_id INT(5);
   SELECT supply_is_id INTO l_id FROM supply_is WHERE posted_is=0 and store_loc_id = p_store_loc_id limit 1;
   IF IFNULL(l_id,0)=0 THEN
      SELECT *, "" as supply_is_id, "" as supply_is_dtl_id, "" as supply_is_qty, getStoreLocSupplyBrandStockQty(p_store_loc_id, loc_supply_brand_id) as prev_qty, "" as beg_qty FROM loc_supply_brands_v WHERE loc_supply_id =p_loc_supply_id and stock_qty > 0 ;
   ELSE
    SELECT a.supply_is_id, a.supply_is_dtl_id, b.loc_supply_id,  a.loc_supply_brand_id, b.stock_qty, b.brand_name, b.cu_desc, a.supply_is_qty, a.beg_qty, a.prev_qty
       FROM supply_is_dtls a, loc_supply_brands_v b
       WHERE a.loc_supply_brand_id = b.loc_supply_brand_id and a.supply_is_id = l_id
       AND b.loc_supply_id =p_loc_supply_id
      UNION
      SELECT "" as supply_is_id, "" as supply_is_dtl_id, a.loc_supply_id, a.loc_supply_brand_id, a.stock_qty, a.brand_name, a.cu_desc, "" as supply_is_qty, getStoreLocSupplyBrandStockQty(p_store_loc_id, loc_supply_brand_id) as prev_qty, "" as beg_qty
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

CREATE PROCEDURE setStoreStockIsPost (IN p_supply_is_id INT, p_store_loc_id INT)   
BEGIN
  UPDATE store_loc_supply_brands a, supply_is_dtls b
  SET a.stock_qty = a.stock_qty + b.supply_is_qty
  WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
  AND b.supply_is_id = p_supply_is_id
  AND EXISTS (SELECT c.store_loc_supply_id 
                FROM store_loc_supplies c 
               WHERE c.store_loc_supply_id=a.store_loc_supply_id 
                 AND c.store_loc_id = p_store_loc_id);
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

SELECT sum(IFNULL(cash_amount,0))
INTO l_cash_amt
FROM store_daily_cash_dtls 
WHERE store_daily_cash_id=p_store_daily_cash_id;

UPDATE store_daily_cash 
   SET ttl_cash_box_amt   = l_cash_amt
 WHERE store_daily_cash_id=p_store_daily_cash_id;    
END;


CREATE PROCEDURE store_daily_cash_postedRet(IN p_store_daily_cash_id int(5))
BEGIN
DECLARE l_return_amt decimal(7,2);

SELECT  sum(IFNULL(return_amount,0)) 
INTO l_return_amt 
FROM store_daily_cash_dtls 
WHERE store_daily_cash_id=p_store_daily_cash_id;

UPDATE store_daily_cash 
   SET ttl_return_amt     = l_return_amt
      ,ttl_cash_sales_amt = l_return_amt - ttl_cash_amt
 WHERE store_daily_cash_id=p_store_daily_cash_id;    
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



CREATE PROCEDURE store_loc_supplies_ins (IN p_store_loc_id INT(10), IN p_store_id INT(10))
BEGIN  
    insert into store_loc_supplies (store_loc_id, loc_supply_id) 
    select p_store_loc_id, a.loc_supply_id,  
      from loc_supplies_v a
     where EXISTS (SELECT supply_id FROM store_supplies_v b WHERE b.supply_id = a.supply_id AND b.store_id = p_store_id); 

   INSERT INTO store_loc_supply_brands(store_loc_supply_id, loc_supply_brand_id)
   SELECT b.store_loc_supply_id , a.loc_supply_brand_id FROM loc_supply_brands_v a, store_loc_supplies_v b
   where b.loc_supply_id = a.loc_supply_id
   and b.store_loc_id=p_store_loc_id;
END;

CREATE PROCEDURE LocSupplyBrandsIns(p_loc_id int(5))
BEGIN
INSERT INTO loc_supply_brands (supply_brand_id, loc_supply_id)
SELECT a.supply_brand_id, getLocSupplyId(p_loc_id, a.supply_id) 
FROM supply_brands a
WHERE NOT EXISTS (SELECT supply_brand_id FROM loc_supply_brands b WHERE b.loc_supply_id =  getLocSupplyId(p_loc_id, a.supply_id));
END;

CREATE PROCEDURE LocSupplyBrandsIns2(p_supply_id int(5))
BEGIN
DECLARE l_loc_id   int;
DECLARE l_loc_supply_id INT;
DECLARE exit_loop BOOLEAN;       
DECLARE loc_cursor CURSOR FOR
  SELECT loc_id FROM locations;
 
DECLARE CONTINUE HANDLER FOR NOT FOUND SET exit_loop = TRUE; 
OPEN loc_cursor;  
locations_loop: LOOP 
FETCH  loc_cursor INTO l_loc_id;
     SELECT loc_supply_id INTO l_loc_supply_id FROM loc_supplies WHERE loc_id = l_loc_id AND supply_id = p_supply_id;

     INSERT INTO loc_supply_brands (supply_brand_id, loc_supply_id)
     SELECT supply_brand_id, l_loc_supply_id
     FROM supply_brands
     WHERE supply_id = p_supply_id
     AND NOT EXISTS (SELECT supply_brand_id FROM loc_supply_brands b WHERE a.supply_brand_id = a.supply_brand_id and loc_id=l_loc_id);
     IF exit_loop THEN
         CLOSE loc_cursor;
         LEAVE locations_loop;
     END IF;
   END LOOP locations_loop;

END;

CREATE PROCEDURE loc_pc_post(p_loc_pc_id int(5), p_store_loc_id int(5))
BEGIN
IF ifnull(p_store_loc_id,0) = 0 THEN
   UPDATE loc_supply_brands a, loc_pc_dtls b 
   SET a.stock_qty = b.pc_qty
   WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
   AND b.loc_pc_id = p_loc_pc_id;
ELSE
   UPDATE store_loc_supply_brands a, loc_pc_dtls b
   SET a.stock_qty = b.pc_qty
   WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
   AND b.loc_pc_id = p_loc_pc_id
   AND EXISTS (SELECT store_loc_id FROM store_loc_supplies c WHERE a.store_loc_supply_id = c.store_loc_supply_id and c.store_loc_id = p_store_loc_id);
END IF;
END;     