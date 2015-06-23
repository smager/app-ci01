 CREATE TRIGGER store_daily_cash_t AFTER UPDATE ON store_daily_cash_dtls
   FOR EACH ROW
   BEGIN
      UPDATE store_daily_cash_dtls 
         SET sales_denomination_qty = return_denomination_qty - denomination_qty 
            ,sales_amount = (return_denomination_qty - denomination_qty) * denomination
       WHERE store_daily_cash_dtl_id = OLD.store_daily_cash_dtl_id;
   END;
   
   
CREATE TRIGGER loc_supplies_t AFTER INSERT ON locations
  FOR EACH ROW
  BEGIN
    INSERT INTO loc_supplies (loc_id, supply_id, created_by, created_date) 
           SELECT  NEW.loc_id, supply_id, NEW.created_by, NOW() FROM supplies;
  END;