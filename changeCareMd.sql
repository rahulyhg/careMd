ALTER TABLE `careMd`.`care_encounter` 

  ADD COLUMN referral_no varchar(15) NULL AFTER referrer_institution, 

ALTER TABLE `careMd`.`care_encounter_prescription`  
  ADD COLUMN practitioner_nr varchar(20), 

ALTER TABLE `careMd`.`care_role_person` 
  ADD COLUMN sname varchar(50) NOT NULL AFTER role, 

ALTER TABLE `careMd`.`care_tz_billing_elem_advance` 
  ADD COLUMN signed_by_follower tinyint(1) NOT NULL DEFAULT '0' AFTER User_Id, 
  ADD COLUMN is_transmit2ERP tinyint(4) NOT NULL DEFAULT '1', 

ALTER TABLE `careMd`.`care_tz_company` 
  ADD COLUMN company_code varchar(50) NULL AFTER name, 
 
ALTER TABLE `careMd`.`care_tz_diagnosis` 
  ADD COLUMN diagnosis_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER type, 
  ADD COLUMN practitioner_nr varchar(20) NULL AFTER doctor_name, 

ALTER TABLE `careMd`.`care_tz_drugsandservices` 
  ADD COLUMN nhif_item_code varchar(20) NULL AFTER partcode, 


ALTER TABLE `careMd`.`care_tz_stock_item_properties` 
  ADD COLUMN Stock_place_id bigint(20) NOT NULL DEFAULT '0' AFTER Drugsandservices_id;

ALTER TABLE `care_encounter` ADD `referrer_number` VARCHAR(255) NOT NULL AFTER `medical_service`;

ALTER TABLE `care_tz_company` ADD `company_code` VARCHAR(255) NOT NULL AFTER `enable_member_expiry`;
UPDATE `care_tz_company` SET `company_code` = 'NHIF' WHERE `care_tz_company`.`name` = "NHIF";
TRUNCATE care_nhif_claims;
ALTER TABLE `care_tz_drugsandservices` ADD `nhif_item_code` VARCHAR(20) NULL DEFAULT NULL AFTER `unit_cost`;


ALTER TABLE `care_person` ADD `national_id` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_ceiling_for_families`, ADD `employee_Id` VARCHAR(255) NULL DEFAULT NULL AFTER `national_id`;


INSERT INTO `care_config_global` (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES ('nhif_acreditation', NULL, NULL, '', '', '', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000');

ALTER TABLE `care_tz_diagnosis` ADD `diagnosis_type` ENUM('final','preliminary') NOT NULL DEFAULT 'final' AFTER `doctor_name`;
