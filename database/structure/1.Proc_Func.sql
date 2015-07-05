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

CREATE PROCEDURE getSupply_IS_Unposted (IN p_store_loc_id int(5))
BEGIN
   DECLARE l_id INT(5);
   SELECT supply_is_id INTO l_id FROM supply_is WHERE store_loc_id = store_loc_id limit 1;
   IF IFNULL(l_id,0)=0 THEN
      SELECT * FROM store_loc_supplies_v WHERE store_loc_id =p_store_loc_id ;
   ELSE
      SELECT * FROM supply_is_dtls_unposted_v WHERE supply_is_id = l_id;
   END IF;   
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

CREATE PROCEDURE supply_is_post(p_supply_is_id int(5))
BEGIN
UPDATE loc_supply_brands a, supply_is_dtls b 
SET a.stock_qty = a.stock_qty - b.supply_is_qty
WHERE a.loc_supply_brand_id = b.loc_supply_brand_id
AND b.supply_is_id = p_supply_is_id;
END;





