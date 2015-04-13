CREATE TABLE `cs482`.`product` (
  `prod_id` INT NOT NULL AUTO_INCREMENT,
  `prod_name` VARCHAR(24) NULL,
  `prod_descrip` VARCHAR(2000) NULL,
  `prod_category` VARCHAR(1) NULL,
  `prod_cost` DECIMAL(6,2) NULL,
  `prod_qty_on_hand` INT NULL,
  `prod_ship_cost` DECIMAL(6,2) NULL,
  `prod_ship_weight` DECIMAL(6,2) NULL,
  `prod_filename` VARCHAR(40) NULL,
  `prod_demo` VARCHAR(100) NULL,
  PRIMARY KEY (`prod_id`));