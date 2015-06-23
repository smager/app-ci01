--Procedure, Function, Triggers

create function  getUnitSDesc(p_unit_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT unit_sdesc INTO lvl FROM units WHERE unit_id=p_unit_id;
 RETURN (lvl);
END;

create function  getSupplier(p_supplier_id int) RETURNS VARCHAR(100)
    DETERMINISTIC
BEGIN
    DECLARE lvl varchar(100);
    SELECT supplier_name INTO lvl FROM suppliers WHERE supplier_id=p_supplier_id;
 RETURN (lvl);
END;

create function  getPOBalCount(p_po_id int) RETURNS INT(5)
    DETERMINISTIC
BEGIN
    DECLARE lvl int(5);
    SELECT COUNT(po_id) INTO lvl FROM po_dtls WHERE po_id=p_po_id and ifnull(bal_qty,0) > 0 ;
 RETURN (lvl);
END;


CREATE TRIGGER loc_supplies_ins AFTER INSERT ON locations
  FOR EACH ROW
  BEGIN
    INSERT INTO loc_supplies (loc_id, supply_id, created_by, created_date) 
           SELECT  NEW.loc_id, supply_id, NEW.created_by, NOW() FROM supplies;
  END;



CREATE PROCEDURE getSupply_IS_Unposted (IN p_store_loc_id int(5))
BEGIN
   DECLARE l_id INT(5);
   SELECT supply_is_id INTO l_id FROM supply_is WHERE store_loc_id = store_loc_id;
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

