CREATE TRIGGER loc_supplies_ins AFTER INSERT ON locations
  FOR EACH ROW
  BEGIN
    INSERT INTO loc_supplies (loc_id, supply_id, created_by, created_date) 
           SELECT  NEW.loc_id, supply_id, NEW.created_by, NOW() FROM supplies;
  END;
