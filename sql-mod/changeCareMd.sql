ALTER TABLE `caredb_aicc`.`care_encounter` 

  ADD COLUMN referral_no varchar(15) NULL AFTER referrer_institution, 

ALTER TABLE `caredb_aicc`.`care_encounter_prescription`  
  ADD COLUMN practitioner_nr varchar(20), 

ALTER TABLE `caredb_aicc`.`care_role_person` 
  ADD COLUMN sname varchar(50) NOT NULL AFTER role, 

ALTER TABLE `caredb_aicc`.`care_tz_billing_elem_advance` 
  ADD COLUMN signed_by_follower tinyint(1) NOT NULL DEFAULT '0' AFTER User_Id, 
  ADD COLUMN is_transmit2ERP tinyint(4) NOT NULL DEFAULT '1', 

ALTER TABLE `caredb_aicc`.`care_tz_company` 
  ADD COLUMN company_code varchar(50) NULL AFTER name, 
 
ALTER TABLE `caredb_aicc`.`care_tz_diagnosis` 
  ADD COLUMN diagnosis_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER type, 
  ADD COLUMN practitioner_nr varchar(20) NULL AFTER doctor_name, 

ALTER TABLE `caredb_aicc`.`care_tz_drugsandservices` 
  ADD COLUMN nhif_item_code varchar(20) NULL AFTER partcode, 


ALTER TABLE `caredb_aicc`.`care_tz_stock_item_properties` 
  ADD COLUMN Stock_place_id bigint(20) NOT NULL DEFAULT '0' AFTER Drugsandservices_id;

ALTER TABLE `care_encounter` ADD `referrer_number` VARCHAR(255) NOT NULL AFTER `medical_service`;

ALTER TABLE `care_tz_company` ADD `company_code` VARCHAR(255) NOT NULL AFTER `enable_member_expiry`;
UPDATE `care_tz_company` SET `company_code` = 'NHIF' WHERE `care_tz_company`.`name` = "NHIF";
TRUNCATE care_nhif_claims;
ALTER TABLE `care_tz_drugsandservices` ADD `nhif_item_code` VARCHAR(20) NULL DEFAULT NULL AFTER `unit_cost`;


ALTER TABLE `care_person` ADD `national_id` VARCHAR(255) NULL DEFAULT NULL AFTER `insurance_ceiling_for_families`, ADD `employee_Id` VARCHAR(255) NULL DEFAULT NULL AFTER `national_id`;


INSERT INTO `care_config_global` (`type`, `value`, `notes`, `status`, `history`, `modify_id`, `modify_time`, `create_id`, `create_time`) VALUES ('nhif_acreditation', NULL, NULL, '', '', '', CURRENT_TIMESTAMP, '', '0000-00-00 00:00:00.000000');

ALTER TABLE `care_tz_diagnosis` ADD `diagnosis_type` ENUM('final','preliminary') NOT NULL DEFAULT 'final' AFTER `doctor_name`;


ALTER TABLE `care_tz_diagnosis` ADD INDEX(`encounter_nr`);
ALTER TABLE `care_tz_diagnosis` ADD INDEX(`type`);



-- 05/11

ALTER TABLE `care_users` ADD `occupation` VARCHAR(255) NULL DEFAULT NULL AFTER `theme_name`, ADD `tel_no` VARCHAR(255) NULL DEFAULT NULL AFTER `occupation`;



--27/11

ALTER TABLE care_person ENGINE=InnoDB;
ALTER TABLE care_encounter ENGINE=InnoDB
ALTER TABLE `care_encounter` CHANGE `pid` `pid` INT(11) UNSIGNED NOT NULL DEFAULT '0';


--13/12

ALTER TABLE `care_encounter` ADD `nhif_card_status` VARCHAR(255)  NULL AFTER `referrer_number`, ADD `nhif_authorization_status` VARCHAR(255)  NULL AFTER `nhif_card_status`, ADD `nhif_authorization_number` VARCHAR(255)  NULL AFTER `nhif_authorization_status`, ADD `nhif_latest_authorization` VARCHAR(255)  NULL AFTER `nhif_authorization_number`, ADD `nhif_visit_type` VARCHAR(255)  NULL AFTER `nhif_latest_authorization`;



--18/12
ALTER TABLE `care_tz_drugsandservices` ADD `is_restricted` BOOLEAN NULL DEFAULT NULL AFTER `nhif_item_code`, ADD `maximum_quantity` INT NULL DEFAULT NULL AFTER `is_restricted`;
ALTER TABLE `care_encounter_prescription` ADD `reason` TEXT NULL DEFAULT NULL AFTER `practitioner_nr`;

--19/12
ALTER TABLE `care_tz_drugsandservices` ADD `nhif_item_type_id` INT NOT NULL DEFAULT '0' AFTER `maximum_quantity`;

--03/01
ALTER TABLE `care_encounter_prescription` CHANGE `reason` `comment` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE `care_tz_drugsandservices_description` ADD `company_id` INT NOT NULL DEFAULT '0' AFTER `ShowDescription`;


--07-01
ALTER TABLE `care_person` CHANGE `allergy` `allergy` TEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;

--08/01
ALTER TABLE `care_person` ADD `allergic` TINYINT NOT NULL DEFAULT '0' AFTER `history`;

--17-01
ALTER TABLE `care_tz_diagnosis` ADD INDEX(`timestamp`);
ALTER TABLE `care_tz_laboratory_param` ADD `block_selection` ENUM('yes','no') NOT NULL DEFAULT 'yes' AFTER `price_1`, ADD `enable_upload` ENUM('yes','no') NOT NULL DEFAULT 'yes' AFTER `block_selection`;


--21-01
composer require phpoffice/phpspreadsheet:1.1.0


--28-01
ALTER TABLE `care_tz_laboratory_param` ADD `sort_order` INT NOT NULL DEFAULT '0' AFTER `enable_upload`;
ALTER TABLE `care_test_request_chemlabor_sub` ADD `sort_order` INT NOT NULL DEFAULT '0' AFTER `history`;

--30-01
ALTER TABLE `care_test_findings_chemlabor_sub` ADD `sort_order` INT NOT NULL DEFAULT '0' AFTER `create_time`;

--01-02
ALTER TABLE `care_person` ADD `is_foreigner` TINYINT NOT NULL DEFAULT '0' AFTER `allergic`;
ALTER TABLE `care_user_roles` CHANGE `permission` `permission` LONGTEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL;

--04-02
ALTER TABLE `care_test_request_chemlabor_sub` ADD `deleted` TINYINT NOT NULL DEFAULT '0' AFTER `sort_order`;

--12-02
ALTER TABLE `care_person` ADD `sub_insurance_id` INT NOT NULL DEFAULT '0' AFTER `insurance_ID`;
ALTER TABLE `care_person` DROP `is_foreigner`;


SELECT * FROM `care_tz_drugsandservices_description` ORDER BY `company_id` ASC
