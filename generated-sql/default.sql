
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- care_address_citytown
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_address_citytown`;

CREATE TABLE `care_address_citytown`
(
    `nr` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `unece_modifier` CHAR(2),
    `unece_locode` VARCHAR(15),
    `name` VARCHAR(100) DEFAULT '' NOT NULL,
    `zip_code` VARCHAR(25) DEFAULT '' NOT NULL,
    `iso_country_id` CHAR(3) DEFAULT '' NOT NULL,
    `unece_locode_type` tinyint(3) unsigned,
    `unece_coordinates` VARCHAR(25),
    `info_url` VARCHAR(255),
    `use_frequency` bigint(20) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `is_additional` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `name` (`name`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_appointment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_appointment`;

CREATE TABLE `care_appointment`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `pid` INTEGER DEFAULT 0 NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `time` TIME DEFAULT '00:00:00' NOT NULL,
    `to_dept_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `to_dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `to_personell_nr` INTEGER DEFAULT 0 NOT NULL,
    `to_personell_name` VARCHAR(60),
    `purpose` TEXT NOT NULL,
    `urgency` tinyint(2) unsigned DEFAULT 0 NOT NULL,
    `remind` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `remind_email` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `remind_mail` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `remind_phone` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `appt_status` VARCHAR(35) DEFAULT 'pending' NOT NULL,
    `cancel_by` VARCHAR(255) DEFAULT '' NOT NULL,
    `cancel_date` DATE,
    `cancel_reason` VARCHAR(255),
    `encounter_class_nr` INTEGER(1) DEFAULT 0 NOT NULL,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `pid` (`pid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_archive
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_archive`;

CREATE TABLE `care_billing_archive`
(
    `bill_no` BIGINT DEFAULT 0 NOT NULL,
    `encounter_nr` INTEGER(10) DEFAULT 0 NOT NULL,
    `patient_name` VARCHAR(255) NOT NULL,
    `vorname` VARCHAR(35) DEFAULT '0' NOT NULL,
    `bill_date_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `bill_amt` DOUBLE(16,4) DEFAULT 0.0000 NOT NULL,
    `payment_date_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `payment_mode` TEXT NOT NULL,
    `cheque_no` VARCHAR(10) DEFAULT '0' NOT NULL,
    `creditcard_no` VARCHAR(10) DEFAULT '0' NOT NULL,
    `paid_by` VARCHAR(15) DEFAULT '0' NOT NULL,
    PRIMARY KEY (`bill_no`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_bill
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_bill`;

CREATE TABLE `care_billing_bill`
(
    `bill_bill_no` BIGINT DEFAULT 0 NOT NULL,
    `bill_encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `bill_date_time` DATE,
    `bill_amount` FLOAT(10,2),
    `bill_outstanding` FLOAT(10,2),
    PRIMARY KEY (`bill_bill_no`),
    INDEX `index_bill_patnum` (`bill_encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_bill_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_bill_item`;

CREATE TABLE `care_billing_bill_item`
(
    `bill_item_id` INTEGER NOT NULL AUTO_INCREMENT,
    `bill_item_encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `bill_item_code` VARCHAR(5),
    `bill_item_unit_cost` FLOAT(10,2) DEFAULT 0.00,
    `bill_item_units` TINYINT,
    `bill_item_amount` FLOAT(10,2),
    `bill_item_date` DATETIME,
    `bill_item_status` enum('0','1') DEFAULT '0',
    `bill_item_bill_no` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`bill_item_id`),
    INDEX `index_bill_item_patnum` (`bill_item_encounter_nr`),
    INDEX `index_bill_item_bill_no` (`bill_item_bill_no`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_final
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_final`;

CREATE TABLE `care_billing_final`
(
    `final_id` TINYINT(3) NOT NULL AUTO_INCREMENT,
    `final_encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `final_bill_no` INTEGER,
    `final_date` DATE,
    `final_total_bill_amount` FLOAT(10,2),
    `final_discount` TINYINT,
    `final_total_receipt_amount` FLOAT(10,2),
    `final_amount_due` FLOAT(10,2),
    `final_amount_recieved` FLOAT(10,2),
    PRIMARY KEY (`final_id`),
    INDEX `index_final_patnum` (`final_encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_item
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_item`;

CREATE TABLE `care_billing_item`
(
    `item_code` VARCHAR(5) DEFAULT '' NOT NULL,
    `item_description` VARCHAR(100),
    `item_unit_cost` FLOAT(10,2) DEFAULT 0.00,
    `item_type` VARCHAR(255),
    `item_discount_max_allowed` tinyint(4) unsigned DEFAULT 0,
    `group` VARCHAR(6) DEFAULT '0',
    PRIMARY KEY (`item_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_billing_payment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_billing_payment`;

CREATE TABLE `care_billing_payment`
(
    `payment_id` TINYINT(5) NOT NULL AUTO_INCREMENT,
    `payment_encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `payment_receipt_no` INTEGER DEFAULT 0 NOT NULL,
    `payment_date` DATETIME DEFAULT '0000-00-00 00:00:00',
    `payment_cash_amount` FLOAT(10,2) DEFAULT 0.00,
    `payment_cheque_no` INTEGER DEFAULT 0,
    `payment_cheque_amount` FLOAT(10,2) DEFAULT 0.00,
    `payment_creditcard_no` INTEGER(25) DEFAULT 0,
    `payment_creditcard_amount` FLOAT(10,2) DEFAULT 0.00,
    `payment_amount_total` FLOAT(10,2) DEFAULT 0.00,
    PRIMARY KEY (`payment_id`),
    INDEX `index_payment_patnum` (`payment_encounter_nr`),
    INDEX `index_payment_receipt_no` (`payment_receipt_no`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_cache
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_cache`;

CREATE TABLE `care_cache`
(
    `id` VARCHAR(125) DEFAULT '' NOT NULL,
    `ctext` TEXT,
    `cbinary` BLOB,
    `tstamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_cafe_menu
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_cafe_menu`;

CREATE TABLE `care_cafe_menu`
(
    `item` INTEGER NOT NULL AUTO_INCREMENT,
    `lang` VARCHAR(10) DEFAULT 'en' NOT NULL,
    `cdate` DATE DEFAULT '0000-00-00' NOT NULL,
    `menu` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    UNIQUE INDEX `item_2` (`item`),
    INDEX `item` (`item`, `lang`),
    INDEX `cdate` (`cdate`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_cafe_prices
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_cafe_prices`;

CREATE TABLE `care_cafe_prices`
(
    `item` INTEGER NOT NULL AUTO_INCREMENT,
    `lang` VARCHAR(10) DEFAULT 'en' NOT NULL,
    `productgroup` VARCHAR(255) NOT NULL,
    `article` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL,
    `price` VARCHAR(10) DEFAULT '' NOT NULL,
    `unit` VARCHAR(255) NOT NULL,
    `pic_filename` VARCHAR(255) NOT NULL,
    `modify_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    INDEX `item` (`item`),
    INDEX `lang` (`lang`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_category_diagnosis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_category_diagnosis`;

CREATE TABLE `care_category_diagnosis`
(
    `nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `category` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `short_code` CHAR DEFAULT '' NOT NULL,
    `LD_var_short_code` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `hide_from` VARCHAR(255) DEFAULT '0' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_category_disease
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_category_disease`;

CREATE TABLE `care_category_disease`
(
    `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `category` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_category_procedure
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_category_procedure`;

CREATE TABLE `care_category_procedure`
(
    `nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `category` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `short_code` CHAR DEFAULT '' NOT NULL,
    `LD_var_short_code` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `hide_from` VARCHAR(255) DEFAULT '0' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_class_encounter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_class_encounter`;

CREATE TABLE `care_class_encounter`
(
    `class_nr` smallint(6) unsigned DEFAULT 0 NOT NULL,
    `class_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `hide_from` TINYINT DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`class_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_class_ethnic_orig
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_class_ethnic_orig`;

CREATE TABLE `care_class_ethnic_orig`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_class_financial
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_class_financial`;

CREATE TABLE `care_class_financial`
(
    `class_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `class_id` VARCHAR(15) DEFAULT '0' NOT NULL,
    `type` VARCHAR(25) DEFAULT '0' NOT NULL,
    `code` VARCHAR(5) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `policy` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`class_nr`),
    INDEX `class_2` (`class_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_class_insurance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_class_insurance`;

CREATE TABLE `care_class_insurance`
(
    `class_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `class_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`class_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_class_therapy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_class_therapy`;

CREATE TABLE `care_class_therapy`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `class` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_classif_neonatal
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_classif_neonatal`;

CREATE TABLE `care_classif_neonatal`
(
    `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
    `id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_complication
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_complication`;

CREATE TABLE `care_complication`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `code` VARCHAR(25),
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_config_global
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_config_global`;

CREATE TABLE `care_config_global`
(
    `type` VARCHAR(60) DEFAULT '' NOT NULL,
    `value` VARCHAR(255),
    `notes` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_config_user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_config_user`;

CREATE TABLE `care_config_user`
(
    `user_id` VARCHAR(100) DEFAULT '' NOT NULL,
    `serial_config_data` TEXT NOT NULL,
    `notes` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`user_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_currency
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_currency`;

CREATE TABLE `care_currency`
(
    `item_no` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `short_name` VARCHAR(10) DEFAULT '' NOT NULL,
    `long_name` VARCHAR(20) DEFAULT '' NOT NULL,
    `info` VARCHAR(50) DEFAULT '' NOT NULL,
    `status` VARCHAR(5) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(20) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(20) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    INDEX `item_no` (`item_no`),
    INDEX `short_name` (`short_name`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_department
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_department`;

CREATE TABLE `care_department`
(
    `nr` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `id` VARCHAR(60) DEFAULT '' NOT NULL,
    `type` VARCHAR(25) DEFAULT '' NOT NULL,
    `name_formal` VARCHAR(60) DEFAULT '' NOT NULL,
    `name_short` VARCHAR(35) DEFAULT '' NOT NULL,
    `name_alternate` VARCHAR(225),
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `admit_inpatient` TINYINT(1) DEFAULT 0 NOT NULL,
    `admit_outpatient` TINYINT(1) DEFAULT 0 NOT NULL,
    `has_oncall_doc` TINYINT(1) DEFAULT 1 NOT NULL,
    `has_oncall_nurse` TINYINT(1) DEFAULT 1 NOT NULL,
    `does_surgery` TINYINT(1) DEFAULT 0 NOT NULL,
    `this_institution` TINYINT(1) DEFAULT 1 NOT NULL,
    `is_sub_dept` TINYINT(1) DEFAULT 0 NOT NULL,
    `parent_dept_nr` tinyint(3) unsigned,
    `work_hours` VARCHAR(100),
    `consult_hours` VARCHAR(100),
    `max_appointments` INTEGER(10) DEFAULT 20 NOT NULL,
    `is_inactive` TINYINT(1) DEFAULT 0 NOT NULL,
    `sort_order` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `address` TEXT,
    `sig_line` VARCHAR(60),
    `sig_stamp` TEXT,
    `logo_mime_type` VARCHAR(5),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_diagnosis_localcode
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_diagnosis_localcode`;

CREATE TABLE `care_diagnosis_localcode`
(
    `localcode` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    `search_keys` VARCHAR(255) DEFAULT '' NOT NULL,
    `use_frequency` INTEGER DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`localcode`),
    INDEX `diagnosis_code` (`localcode`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_drg_intern
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_drg_intern`;

CREATE TABLE `care_drg_intern`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `synonyms` TEXT NOT NULL,
    `notes` TEXT,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT(1) DEFAULT 0 NOT NULL,
    `parent_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `nr` (`nr`),
    INDEX `code` (`code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_drg_quicklist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_drg_quicklist`;

CREATE TABLE `care_drg_quicklist`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(25) DEFAULT '' NOT NULL,
    `code_parent` VARCHAR(25) DEFAULT '' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `qlist_type` VARCHAR(25) DEFAULT '0' NOT NULL,
    `rank` INTEGER DEFAULT 0 NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_drg_related_codes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_drg_related_codes`;

CREATE TABLE `care_drg_related_codes`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `group_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `code` VARCHAR(15) DEFAULT '' NOT NULL,
    `code_parent` VARCHAR(15) DEFAULT '' NOT NULL,
    `code_type` VARCHAR(15) DEFAULT '' NOT NULL,
    `rank` INTEGER DEFAULT 0 NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_dutyplan_oncall
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_dutyplan_oncall`;

CREATE TABLE `care_dutyplan_oncall`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `dept_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `role_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `year` INTEGER(4) DEFAULT 0000 NOT NULL,
    `month` CHAR(2) DEFAULT '' NOT NULL,
    `duty_1_txt` TEXT NOT NULL,
    `duty_2_txt` TEXT NOT NULL,
    `duty_1_pnr` TEXT NOT NULL,
    `duty_2_pnr` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `dept_nr` (`dept_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_effective_day
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_effective_day`;

CREATE TABLE `care_effective_day`
(
    `eff_day_nr` TINYINT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`eff_day_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter`;

CREATE TABLE `care_encounter`
(
    `encounter_nr` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr_prev` BIGINT(11) NOT NULL,
    `pid` INTEGER DEFAULT 0 NOT NULL,
    `encounter_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `encounter_class_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `encounter_type` VARCHAR(35) DEFAULT '' NOT NULL,
    `encounter_status` VARCHAR(35) DEFAULT '' NOT NULL,
    `referrer_diagnosis` VARCHAR(255) DEFAULT '' NOT NULL,
    `referrer_recom_therapy` VARCHAR(255),
    `referrer_dr` VARCHAR(60) DEFAULT '' NOT NULL,
    `referrer_dept` VARCHAR(255) DEFAULT '' NOT NULL,
    `referrer_institution` VARCHAR(255) DEFAULT '' NOT NULL,
    `referrer_notes` TEXT NOT NULL,
    `financial_class_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `insurance_nr` VARCHAR(25) DEFAULT '0',
    `insurance_firm_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `insurance_class_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `insurance_2_nr` VARCHAR(25) DEFAULT '0',
    `insurance_2_firm_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `guarantor_pid` INTEGER DEFAULT 0 NOT NULL,
    `contact_pid` INTEGER DEFAULT 0 NOT NULL,
    `contact_relation` VARCHAR(35) DEFAULT '' NOT NULL,
    `current_ward_nr` smallint(3) unsigned DEFAULT 0 NOT NULL,
    `current_room_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `in_ward` TINYINT(1) DEFAULT 0 NOT NULL,
    `current_dept_nr` smallint(3) unsigned DEFAULT 0 NOT NULL,
    `pharmacy` VARCHAR(20) NOT NULL,
    `in_dept` TINYINT(1) DEFAULT 0 NOT NULL,
    `current_firm_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `current_att_dr_nr` INTEGER(10) DEFAULT 0 NOT NULL,
    `consulting_dr` VARCHAR(60) DEFAULT '' NOT NULL,
    `extra_service` VARCHAR(25) DEFAULT '' NOT NULL,
    `form_nr` VARCHAR(20) NOT NULL,
    `is_discharged` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `discharge_date` DATE,
    `discharge_time` TIME,
    `followup_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `followup_responsibility` VARCHAR(255),
    `post_encounter_notes` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `room` VARCHAR(20) DEFAULT 'GENERAL' NOT NULL,
    `room_history` TEXT NOT NULL,
    `current_dept_history` TEXT NOT NULL,
    `medical_service` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`encounter_nr`),
    INDEX `pid` (`pid`),
    INDEX `encounter_date` (`encounter_date`),
    INDEX `encounter_class_nr` (`encounter_class_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_diagnosis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_diagnosis`;

CREATE TABLE `care_encounter_diagnosis`
(
    `diagnosis_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `op_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `code` VARCHAR(25) DEFAULT '' NOT NULL,
    `code_parent` VARCHAR(25) DEFAULT '' NOT NULL,
    `group_nr` mediumint(8) unsigned DEFAULT 0 NOT NULL,
    `code_version` TINYINT DEFAULT 0 NOT NULL,
    `localcode` VARCHAR(35) DEFAULT '' NOT NULL,
    `category_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `localization` VARCHAR(35) DEFAULT '' NOT NULL,
    `diagnosing_clinician` VARCHAR(60) DEFAULT '' NOT NULL,
    `diagnosing_dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`diagnosis_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `diagnosis_nr` (`diagnosis_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_diagnostics_report
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_diagnostics_report`;

CREATE TABLE `care_encounter_diagnostics_report`
(
    `item_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `report_nr` INTEGER DEFAULT 0 NOT NULL,
    `reporting_dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `reporting_dept` VARCHAR(100) DEFAULT '' NOT NULL,
    `report_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `report_time` TIME DEFAULT '00:00:00' NOT NULL,
    `encounter_nr` INTEGER(10) DEFAULT 0 NOT NULL,
    `script_call` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `open_status` TINYINT(1) DEFAULT 0,
    `is_reviewed` TINYINT(1) DEFAULT 0 NOT NULL,
    `reviewer_comments` VARCHAR(255),
    `reviewed_by` VARCHAR(255),
    PRIMARY KEY (`item_nr`,`report_nr`),
    INDEX `report_nr` (`report_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_drg_intern
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_drg_intern`;

CREATE TABLE `care_encounter_drg_intern`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `group_nr` mediumint(8) unsigned DEFAULT 0 NOT NULL,
    `clinician` VARCHAR(60) DEFAULT '' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_event_signaller
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_event_signaller`;

CREATE TABLE `care_encounter_event_signaller`
(
    `encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `yellow` TINYINT(1) DEFAULT 0 NOT NULL,
    `black` TINYINT(1) DEFAULT 0 NOT NULL,
    `blue_pale` TINYINT(1) DEFAULT 0 NOT NULL,
    `brown` TINYINT(1) DEFAULT 0 NOT NULL,
    `pink` TINYINT(1) DEFAULT 0 NOT NULL,
    `yellow_pale` TINYINT(1) DEFAULT 0 NOT NULL,
    `red` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_pale` TINYINT(1) DEFAULT 0 NOT NULL,
    `violet` TINYINT(1) DEFAULT 0 NOT NULL,
    `blue` TINYINT(1) DEFAULT 0 NOT NULL,
    `biege` TINYINT(1) DEFAULT 0 NOT NULL,
    `orange` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_1` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_2` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_3` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_4` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_5` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_6` TINYINT(1) DEFAULT 0 NOT NULL,
    `green_7` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_1` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_2` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_3` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_4` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_5` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_6` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_7` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_8` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_9` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_10` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_11` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_12` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_13` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_14` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_15` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_16` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_17` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_18` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_19` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_20` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_21` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_22` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_23` TINYINT(1) DEFAULT 0 NOT NULL,
    `rose_24` TINYINT(1) DEFAULT 0 NOT NULL,
    `maroon` TINYINT(1) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`encounter_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `encounter_nr_2` (`encounter_nr`),
    INDEX `encounter_nr_3` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_financial_class
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_financial_class`;

CREATE TABLE `care_encounter_financial_class`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `class_nr` smallint(3) unsigned DEFAULT 0 NOT NULL,
    `date_start` DATE,
    `date_end` DATE,
    `date_create` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `encounter_nr_2` (`encounter_nr`),
    INDEX `encounter_nr_3` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_image
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_image`;

CREATE TABLE `care_encounter_image`
(
    `nr` BIGINT NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `shot_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `shot_nr` SMALLINT DEFAULT 0 NOT NULL,
    `mime_type` VARCHAR(10) DEFAULT '' NOT NULL,
    `upload_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `notes` TEXT NOT NULL,
    `graphic_script` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_immunization
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_immunization`;

CREATE TABLE `care_encounter_immunization`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `type` VARCHAR(60) DEFAULT '' NOT NULL,
    `medicine` VARCHAR(60) DEFAULT '' NOT NULL,
    `dosage` VARCHAR(60),
    `application_type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `application_by` VARCHAR(60),
    `titer` VARCHAR(15),
    `refresh_date` DATE,
    `notes` TEXT,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_location`;

CREATE TABLE `care_encounter_location`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `location_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `group_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `date_from` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_to` DATE DEFAULT '0000-00-00' NOT NULL,
    `time_from` TIME DEFAULT '00:00:00',
    `time_to` TIME,
    `discharge_type_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`location_nr`),
    INDEX `type` (`type_nr`),
    INDEX `location_id` (`location_nr`),
    INDEX `encounter_id` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_measurement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_measurement`;

CREATE TABLE `care_encounter_measurement`
(
    `nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `msr_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `msr_time` VARCHAR(5) DEFAULT '0' NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `msr_type_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `value` VARCHAR(255),
    `unit_nr` smallint(5) unsigned,
    `unit_type_nr` tinyint(2) unsigned DEFAULT 0 NOT NULL,
    `notes` VARCHAR(255),
    `measured_by` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `type` (`msr_type_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `encounter_nr_2` (`encounter_nr`),
    INDEX `encounter_nr_3` (`encounter_nr`),
    INDEX `encounter_nr_4` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_notes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_notes`;

CREATE TABLE `care_encounter_notes`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `notes` TEXT NOT NULL,
    `short_notes` VARCHAR(25),
    `aux_notes` VARCHAR(255),
    `ref_notes_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `personell_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `personell_name` VARCHAR(60) DEFAULT '' NOT NULL,
    `send_to_pid` INTEGER DEFAULT 0 NOT NULL,
    `send_to_name` VARCHAR(60),
    `date` DATE,
    `time` TIME,
    `location_type` VARCHAR(35),
    `location_type_nr` TINYINT(3) DEFAULT 0 NOT NULL,
    `location_nr` mediumint(8) unsigned DEFAULT 0 NOT NULL,
    `location_id` VARCHAR(60),
    `ack_short_id` VARCHAR(10) DEFAULT '' NOT NULL,
    `date_ack` DATETIME,
    `date_checked` DATETIME,
    `date_printed` DATETIME,
    `send_by_mail` TINYINT(1),
    `send_by_email` TINYINT(1),
    `send_by_fax` TINYINT(1),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `type_nr` (`type_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_obstetric
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_obstetric`;

CREATE TABLE `care_encounter_obstetric`
(
    `encounter_nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pregnancy_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `hospital_adm_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `patient_class` VARCHAR(60) DEFAULT '' NOT NULL,
    `is_discharged_not_in_labour` TINYINT(1),
    `is_re_admission` TINYINT(1),
    `referral_status` VARCHAR(60),
    `referral_reason` TEXT,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`encounter_nr`),
    INDEX `encounter_nr` (`pregnancy_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_op
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_op`;

CREATE TABLE `care_encounter_op`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `year` VARCHAR(4) DEFAULT '0' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `op_room` VARCHAR(10) DEFAULT '0' NOT NULL,
    `op_nr` SMALLINT(9) DEFAULT 0 NOT NULL,
    `op_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `op_src_date` VARCHAR(8) DEFAULT '' NOT NULL,
    `encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `diagnosis` TEXT NOT NULL,
    `operator` TEXT NOT NULL,
    `assistant` TEXT NOT NULL,
    `scrub_nurse` TEXT NOT NULL,
    `rotating_nurse` TEXT NOT NULL,
    `anesthesia` VARCHAR(30) DEFAULT '' NOT NULL,
    `an_doctor` TEXT NOT NULL,
    `op_therapy` TEXT NOT NULL,
    `result_info` TEXT NOT NULL,
    `entry_time` VARCHAR(5) DEFAULT '' NOT NULL,
    `cut_time` VARCHAR(5) DEFAULT '' NOT NULL,
    `close_time` VARCHAR(5) DEFAULT '' NOT NULL,
    `exit_time` VARCHAR(5) DEFAULT '' NOT NULL,
    `entry_out` TEXT NOT NULL,
    `cut_close` TEXT NOT NULL,
    `wait_time` TEXT NOT NULL,
    `bandage_time` TEXT NOT NULL,
    `repos_time` TEXT NOT NULL,
    `encoding` LONGTEXT NOT NULL,
    `doc_date` VARCHAR(10) DEFAULT '' NOT NULL,
    `doc_time` VARCHAR(5) DEFAULT '' NOT NULL,
    `duty_type` VARCHAR(15) DEFAULT '' NOT NULL,
    `material_codedlist` TEXT NOT NULL,
    `container_codedlist` TEXT NOT NULL,
    `icd_code` TEXT NOT NULL,
    `ops_code` TEXT NOT NULL,
    `ops_intern_code` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `dept` (`dept_nr`),
    INDEX `op_room` (`op_room`),
    INDEX `op_date` (`op_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_prescription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_prescription`;

CREATE TABLE `care_encounter_prescription`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `prescription_type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `article` VARCHAR(100) DEFAULT '' NOT NULL,
    `article_item_number` VARCHAR(50) DEFAULT '0' NOT NULL,
    `partcode` VARCHAR(255) NOT NULL,
    `mark_os` SMALLINT(2) DEFAULT 0 NOT NULL,
    `materialcost` VARCHAR(255) DEFAULT '0' NOT NULL,
    `price` VARCHAR(255) DEFAULT '' NOT NULL,
    `drug_class` VARCHAR(60) DEFAULT '' NOT NULL,
    `order_nr` INTEGER DEFAULT 0 NOT NULL,
    `dosage` DOUBLE NOT NULL,
    `times_per_day` SMALLINT(10) NOT NULL,
    `days` SMALLINT(10) NOT NULL,
    `total_dosage` DOUBLE NOT NULL,
    `application_type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `notes` TEXT NOT NULL,
    `prescribe_date` DATE,
    `prescriber` VARCHAR(60) DEFAULT '' NOT NULL,
    `taken` TINYINT(1) NOT NULL,
    `color_marker` VARCHAR(10) DEFAULT '' NOT NULL,
    `is_stopped` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `is_outpatient_prescription` tinyint(11) unsigned DEFAULT 0 NOT NULL,
    `issuer` VARCHAR(35) NOT NULL,
    `issue_date` DATETIME,
    `is_disabled` VARCHAR(255),
    `disable_id` VARCHAR(25) NOT NULL,
    `disable_date` DATE NOT NULL,
    `stop_date` DATE,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `bill_number` BIGINT DEFAULT 0 NOT NULL,
    `bill_status` VARCHAR(10) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `priority` TINYINT(1) NOT NULL,
    `sub_store` VARCHAR(20) NOT NULL,
    `in_weberp` INTEGER(3) NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `IX_ARTICLE_ITEM_NUMBER` (`article_item_number`),
    INDEX `encounter_nr_2` (`encounter_nr`),
    INDEX `article` (`article`),
    INDEX `status` (`status`),
    INDEX `encounter_nr_3` (`encounter_nr`),
    INDEX `bill_number_idx` (`bill_number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_prescription_notes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_prescription_notes`;

CREATE TABLE `care_encounter_prescription_notes`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `prescription_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `notes` VARCHAR(35),
    `short_notes` VARCHAR(25),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_procedure
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_procedure`;

CREATE TABLE `care_encounter_procedure`
(
    `procedure_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `op_nr` INTEGER DEFAULT 0 NOT NULL,
    `date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `code` VARCHAR(25) DEFAULT '' NOT NULL,
    `code_parent` VARCHAR(25) DEFAULT '' NOT NULL,
    `group_nr` mediumint(8) unsigned DEFAULT 0 NOT NULL,
    `code_version` TINYINT DEFAULT 0 NOT NULL,
    `localcode` VARCHAR(35) DEFAULT '' NOT NULL,
    `category_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `localization` VARCHAR(35) DEFAULT '' NOT NULL,
    `responsible_clinician` VARCHAR(60) DEFAULT '' NOT NULL,
    `responsible_dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`procedure_nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_encounter_sickconfirm
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_encounter_sickconfirm`;

CREATE TABLE `care_encounter_sickconfirm`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `date_confirm` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_start` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_end` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_create` DATE DEFAULT '0000-00-00' NOT NULL,
    `diagnosis` TEXT NOT NULL,
    `dept_nr` SMALLINT DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_group`;

CREATE TABLE `care_group`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_icd10_bs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_icd10_bs`;

CREATE TABLE `care_icd10_bs`
(
    `diagnosis_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    PRIMARY KEY (`diagnosis_code`),
    INDEX `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_icd10_de
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_icd10_de`;

CREATE TABLE `care_icd10_de`
(
    `diagnosis_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    INDEX `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_icd10_en
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_icd10_en`;

CREATE TABLE `care_icd10_en`
(
    `diagnosis_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    `show` TINYINT(2) DEFAULT 0 NOT NULL,
    INDEX `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_icd10_es
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_icd10_es`;

CREATE TABLE `care_icd10_es`
(
    `diagnosis_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    PRIMARY KEY (`diagnosis_code`),
    INDEX `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_icd10_pt_br
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_icd10_pt_br`;

CREATE TABLE `care_icd10_pt_br`
(
    `diagnosis_code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `class_sub` VARCHAR(5) DEFAULT '' NOT NULL,
    `type` VARCHAR(10) DEFAULT '' NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    `extra_codes` TEXT NOT NULL,
    `extra_subclass` TEXT NOT NULL,
    PRIMARY KEY (`diagnosis_code`),
    INDEX `diagnosis_code` (`diagnosis_code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_img_diagnostic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_img_diagnostic`;

CREATE TABLE `care_img_diagnostic`
(
    `nr` BIGINT NOT NULL AUTO_INCREMENT,
    `pid` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `doc_ref_ids` VARCHAR(255),
    `img_type` VARCHAR(10) DEFAULT '' NOT NULL,
    `max_nr` TINYINT(2) DEFAULT 0,
    `upload_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `cancel_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `cancel_by` VARCHAR(35),
    `notes` TEXT,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`pid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_insurance_firm
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_insurance_firm`;

CREATE TABLE `care_insurance_firm`
(
    `firm_id` VARCHAR(40) DEFAULT '' NOT NULL,
    `name` VARCHAR(60) DEFAULT '' NOT NULL,
    `iso_country_id` CHAR(3) DEFAULT '' NOT NULL,
    `sub_area` VARCHAR(60) DEFAULT '' NOT NULL,
    `type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `addr` VARCHAR(255),
    `addr_mail` VARCHAR(200),
    `addr_billing` VARCHAR(200),
    `addr_email` VARCHAR(60),
    `phone_main` VARCHAR(35),
    `phone_aux` VARCHAR(35),
    `fax_main` VARCHAR(35),
    `fax_aux` VARCHAR(35),
    `contact_person` VARCHAR(60),
    `contact_phone` VARCHAR(35),
    `contact_fax` VARCHAR(35),
    `contact_email` VARCHAR(60),
    `use_frequency` bigint(20) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`firm_id`),
    INDEX `name` (`name`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_mail_private
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_mail_private`;

CREATE TABLE `care_mail_private`
(
    `recipient` VARCHAR(60) DEFAULT '' NOT NULL,
    `sender` VARCHAR(60) DEFAULT '' NOT NULL,
    `sender_ip` VARCHAR(60) DEFAULT '' NOT NULL,
    `cc` VARCHAR(255) DEFAULT '' NOT NULL,
    `bcc` VARCHAR(255) DEFAULT '' NOT NULL,
    `subject` VARCHAR(255) DEFAULT '' NOT NULL,
    `body` TEXT NOT NULL,
    `sign` VARCHAR(255) DEFAULT '' NOT NULL,
    `ask4ack` TINYINT DEFAULT 0 NOT NULL,
    `reply2` VARCHAR(255) DEFAULT '' NOT NULL,
    `attachment` VARCHAR(255) DEFAULT '' NOT NULL,
    `attach_type` VARCHAR(30) DEFAULT '' NOT NULL,
    `read_flag` TINYINT DEFAULT 0 NOT NULL,
    `mailgroup` VARCHAR(60) DEFAULT '' NOT NULL,
    `maildir` VARCHAR(60) DEFAULT '' NOT NULL,
    `exec_level` TINYINT DEFAULT 0 NOT NULL,
    `exclude_addr` TEXT NOT NULL,
    `send_dt` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `send_stamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `uid` VARCHAR(255) DEFAULT '' NOT NULL,
    INDEX `recipient` (`recipient`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_mail_private_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_mail_private_users`;

CREATE TABLE `care_mail_private_users`
(
    `user_name` VARCHAR(60) DEFAULT '' NOT NULL,
    `email` VARCHAR(60) DEFAULT '' NOT NULL,
    `alias` VARCHAR(60) DEFAULT '' NOT NULL,
    `pw` VARCHAR(255) DEFAULT '' NOT NULL,
    `inbox` LONGTEXT NOT NULL,
    `sent` LONGTEXT NOT NULL,
    `drafts` LONGTEXT NOT NULL,
    `trash` LONGTEXT NOT NULL,
    `lastcheck` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `lock_flag` TINYINT DEFAULT 0 NOT NULL,
    `addr_book` TEXT NOT NULL,
    `addr_quick` VARCHAR(255) NOT NULL,
    `secret_q` VARCHAR(255) NOT NULL,
    `secret_q_ans` VARCHAR(255) NOT NULL,
    `public` TINYINT DEFAULT 0 NOT NULL,
    `sig` VARCHAR(255) NOT NULL,
    `append_sig` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`email`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_med_ordercatalog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_med_ordercatalog`;

CREATE TABLE `care_med_ordercatalog`
(
    `item_no` INTEGER NOT NULL AUTO_INCREMENT,
    `dept_nr` INTEGER(3) DEFAULT 0 NOT NULL,
    `hit` INTEGER DEFAULT 0 NOT NULL,
    `artikelname` VARCHAR(255) NOT NULL,
    `bestellnum` VARCHAR(20) DEFAULT '' NOT NULL,
    `minorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `maxorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `proorder` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`item_no`),
    INDEX `item_no` (`item_no`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_med_orderlist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_med_orderlist`;

CREATE TABLE `care_med_orderlist`
(
    `order_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept_nr` INTEGER(3) DEFAULT 0 NOT NULL,
    `order_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `order_time` TIME DEFAULT '00:00:00' NOT NULL,
    `articles` TEXT NOT NULL,
    `extra1` VARCHAR(255) NOT NULL,
    `extra2` TEXT NOT NULL,
    `validator` VARCHAR(255) NOT NULL,
    `ip_addr` VARCHAR(255) NOT NULL,
    `priority` VARCHAR(255) NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `sent_datetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `process_datetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`order_nr`),
    INDEX `item_nr` (`order_nr`),
    INDEX `dept` (`dept_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_med_products_main
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_med_products_main`;

CREATE TABLE `care_med_products_main`
(
    `bestellnum` VARCHAR(25) DEFAULT '' NOT NULL,
    `artikelnum` VARCHAR(255) NOT NULL,
    `industrynum` VARCHAR(255) NOT NULL,
    `artikelname` VARCHAR(255) NOT NULL,
    `generic` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `packing` VARCHAR(255) NOT NULL,
    `minorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `maxorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `proorder` VARCHAR(255) NOT NULL,
    `picfile` VARCHAR(255) NOT NULL,
    `encoder` VARCHAR(255) NOT NULL,
    `enc_date` VARCHAR(255) NOT NULL,
    `enc_time` VARCHAR(255) NOT NULL,
    `lock_flag` TINYINT(1) DEFAULT 0 NOT NULL,
    `medgroup` TEXT NOT NULL,
    `cave` VARCHAR(255) NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`bestellnum`),
    INDEX `bestellnum` (`bestellnum`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_med_report
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_med_report`;

CREATE TABLE `care_med_report`
(
    `report_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept` VARCHAR(15) DEFAULT '' NOT NULL,
    `report` TEXT NOT NULL,
    `reporter` VARCHAR(25) DEFAULT '' NOT NULL,
    `id_nr` VARCHAR(15) DEFAULT '' NOT NULL,
    `report_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `report_time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`report_nr`),
    INDEX `report_nr` (`report_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_menu_main
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_menu_main`;

CREATE TABLE `care_menu_main`
(
    `nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `sort_nr` TINYINT(2) DEFAULT 0 NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `url` VARCHAR(255) DEFAULT '' NOT NULL,
    `is_visible` tinyint(1) unsigned DEFAULT 1 NOT NULL,
    `hide_by` TEXT,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modify_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_menu_sub
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_menu_sub`;

CREATE TABLE `care_menu_sub`
(
    `s_nr` INTEGER DEFAULT 0 NOT NULL,
    `s_sort_nr` INTEGER DEFAULT 0 NOT NULL,
    `s_main_nr` INTEGER DEFAULT 0 NOT NULL,
    `s_ebene` INTEGER DEFAULT 0 NOT NULL,
    `s_name` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_LD_var` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_url` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_url_ext` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_image` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_open_image` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_is_visible` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_hide_by` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_status` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_modify_id` VARCHAR(100) DEFAULT '' NOT NULL,
    `s_modify_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_method_induction
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_method_induction`;

CREATE TABLE `care_method_induction`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `method` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_mode_delivery
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_mode_delivery`;

CREATE TABLE `care_mode_delivery`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `mode` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_neonatal
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_neonatal`;

CREATE TABLE `care_neonatal`
(
    `nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `delivery_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `parent_encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `delivery_nr` TINYINT DEFAULT 0 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `delivery_place` VARCHAR(60) DEFAULT '' NOT NULL,
    `delivery_mode` TINYINT(2) DEFAULT 0 NOT NULL,
    `c_s_reason` TEXT,
    `born_before_arrival` TINYINT(1) DEFAULT 0,
    `face_presentation` TINYINT(1) DEFAULT 0 NOT NULL,
    `posterio_occipital_position` TINYINT(1) DEFAULT 0 NOT NULL,
    `delivery_rank` tinyint(2) unsigned DEFAULT 1 NOT NULL,
    `apgar_1_min` TINYINT DEFAULT 0 NOT NULL,
    `apgar_5_min` TINYINT DEFAULT 0 NOT NULL,
    `apgar_10_min` TINYINT DEFAULT 0 NOT NULL,
    `time_to_spont_resp` TINYINT(2),
    `condition` VARCHAR(60) DEFAULT '0',
    `weight` float(8,2) unsigned,
    `length` float(8,2) unsigned,
    `head_circumference` float(8,2) unsigned,
    `scored_gestational_age` float(4,2) unsigned,
    `feeding` TINYINT DEFAULT 0 NOT NULL,
    `congenital_abnormality` VARCHAR(125) DEFAULT '' NOT NULL,
    `classification` VARCHAR(255) DEFAULT '0' NOT NULL,
    `disease_category` TINYINT(2) DEFAULT 0 NOT NULL,
    `outcome` TINYINT(2) DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `pid` (`pid`),
    INDEX `pregnancy_nr` (`parent_encounter_nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_news_article
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_news_article`;

CREATE TABLE `care_news_article`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `lang` VARCHAR(10) DEFAULT 'en' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `category` VARCHAR(255) NOT NULL,
    `status` VARCHAR(10) DEFAULT 'pending' NOT NULL,
    `title` VARCHAR(255) DEFAULT '' NOT NULL,
    `preface` TEXT NOT NULL,
    `body` TEXT NOT NULL,
    `pic` BLOB,
    `pic_mime` VARCHAR(4),
    `art_num` TINYINT(1) DEFAULT 0 NOT NULL,
    `head_file` VARCHAR(255) NOT NULL,
    `main_file` VARCHAR(255) NOT NULL,
    `pic_file` VARCHAR(255) NOT NULL,
    `author` VARCHAR(30) DEFAULT '' NOT NULL,
    `submit_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `encode_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `publish_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `modify_id` VARCHAR(30) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(30) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `item_no` (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_op_med_doc
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_op_med_doc`;

CREATE TABLE `care_op_med_doc`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `op_date` VARCHAR(12) DEFAULT '' NOT NULL,
    `operator` VARCHAR(255) NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `diagnosis` TEXT NOT NULL,
    `localize` TEXT NOT NULL,
    `therapy` TEXT NOT NULL,
    `special` TEXT NOT NULL,
    `class_s` TINYINT DEFAULT 0 NOT NULL,
    `class_l` TINYINT DEFAULT 0 NOT NULL,
    `op_start` VARCHAR(8) DEFAULT '' NOT NULL,
    `op_end` VARCHAR(8) DEFAULT '' NOT NULL,
    `anasthetist` VARCHAR(20) NOT NULL,
    `scrub_nurse` VARCHAR(70) DEFAULT '' NOT NULL,
    `assistant` VARCHAR(20) NOT NULL,
    `anaesthesia_type` VARCHAR(20) NOT NULL,
    `postorder` TEXT NOT NULL,
    `indication` TEXT NOT NULL,
    `procedure_or` TEXT NOT NULL,
    `op_room` VARCHAR(10) DEFAULT '' NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_ops301_de
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_ops301_de`;

CREATE TABLE `care_ops301_de`
(
    `code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    INDEX `code` (`code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_ops301_es
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_ops301_es`;

CREATE TABLE `care_ops301_es`
(
    `code` VARCHAR(12) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `inclusive` TEXT NOT NULL,
    `exclusive` TEXT NOT NULL,
    `notes` TEXT NOT NULL,
    `std_code` CHAR DEFAULT '' NOT NULL,
    `sub_level` TINYINT DEFAULT 0 NOT NULL,
    `remarks` TEXT NOT NULL,
    INDEX `code` (`code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_person`;

CREATE TABLE `care_person`
(
    `pid` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `selian_pid` BIGINT DEFAULT 0 NOT NULL,
    `date_reg` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `name_first` VARCHAR(60) DEFAULT '' NOT NULL,
    `name_2` VARCHAR(60),
    `name_3` VARCHAR(60),
    `name_middle` VARCHAR(60),
    `name_last` VARCHAR(60) DEFAULT '' NOT NULL,
    `name_maiden` VARCHAR(60),
    `name_others` TEXT NOT NULL,
    `education` VARCHAR(50) NOT NULL,
    `date_birth` DATE DEFAULT '0000-00-00' NOT NULL,
    `blood_group` CHAR(2) DEFAULT '' NOT NULL,
    `rh` VARCHAR(10) DEFAULT '' NOT NULL,
    `addr_str` VARCHAR(60) DEFAULT '' NOT NULL,
    `addr_str_nr` VARCHAR(10) DEFAULT '' NOT NULL,
    `addr_zip` VARCHAR(15) DEFAULT '' NOT NULL,
    `addr_citytown_nr` mediumint(8) unsigned DEFAULT 0 NOT NULL,
    `addr_is_valid` TINYINT(1) DEFAULT 0 NOT NULL,
    `citizenship` VARCHAR(35),
    `phone_1_code` VARCHAR(15) DEFAULT '0',
    `phone_1_nr` VARCHAR(35),
    `phone_2_code` VARCHAR(15) DEFAULT '0',
    `phone_2_nr` VARCHAR(35),
    `cellphone_1_nr` VARCHAR(35),
    `cellphone_2_nr` VARCHAR(35),
    `fax` VARCHAR(35),
    `email` VARCHAR(60),
    `civil_status` VARCHAR(35) DEFAULT '' NOT NULL,
    `sex` CHAR DEFAULT '' NOT NULL,
    `title` VARCHAR(25),
    `photo` BLOB,
    `photo_filename` VARCHAR(60) DEFAULT '' NOT NULL,
    `ethnic_orig` mediumint(8) unsigned,
    `org_id` VARCHAR(60),
    `sss_nr` VARCHAR(60),
    `nat_id_nr` VARCHAR(60),
    `religion` VARCHAR(125),
    `is_first_reg` INTEGER(1) NOT NULL,
    `region` VARCHAR(50) NOT NULL,
    `district` VARCHAR(50) NOT NULL,
    `ward` VARCHAR(50) NOT NULL,
    `mother_pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `father_pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `contact_person` VARCHAR(255),
    `contact_pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `contact_relation` VARCHAR(25) DEFAULT '0',
    `death_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `death_encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `death_cause` VARCHAR(255),
    `death_cause_code` VARCHAR(15),
    `date_update` DATETIME,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `allergy` VARCHAR(50) NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `addr_citytown_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `is_transmit2ERP` TINYINT NOT NULL,
    `insurance_ID` SMALLINT(5) NOT NULL,
    `insurance_head_pid` BIGINT DEFAULT 0 NOT NULL,
    `membership_nr` VARCHAR(20) NOT NULL,
    `form_nr` VARCHAR(20) NOT NULL,
    `nhif_nr` VARCHAR(20) NOT NULL,
    `insurance_silver` TINYINT DEFAULT 0 NOT NULL,
    `insurance_gold` TINYINT DEFAULT 0 NOT NULL,
    `insurance_friedkin` TINYINT DEFAULT 0 NOT NULL,
    `insurance_selian_stuff` TINYINT DEFAULT 0 NOT NULL,
    `insurance_premium_for_adults` INTEGER DEFAULT 0 NOT NULL,
    `insurance_premium_for_childs` INTEGER DEFAULT 0 NOT NULL,
    `insurance_premium_for_senior` INTEGER DEFAULT 0 NOT NULL,
    `insurance_copayment_OPD` INTEGER DEFAULT 0 NOT NULL,
    `insurance_copayment_IPD` INTEGER DEFAULT 0 NOT NULL,
    `insurance_ceiling_by_individual` TINYINT DEFAULT 0 NOT NULL,
    `insurance_ceiling_by_family` TINYINT DEFAULT 0 NOT NULL,
    `insurance_ceiling_amount` INTEGER DEFAULT 0 NOT NULL,
    `insurance_ceiling_for_families` INTEGER DEFAULT 0 NOT NULL,
    PRIMARY KEY (`pid`),
    UNIQUE INDEX `selian_pid` (`selian_pid`),
    INDEX `name_last` (`name_last`),
    INDEX `name_first` (`name_first`),
    INDEX `date_reg` (`date_reg`),
    INDEX `date_birth` (`date_birth`),
    INDEX `name_maiden` (`name_maiden`),
    INDEX `name_first_2` (`name_first`, `name_last`),
    INDEX `insurance_ID` (`insurance_ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_person_insurance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_person_insurance`;

CREATE TABLE `care_person_insurance`
(
    `item_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(10) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(60) DEFAULT '' NOT NULL,
    `insurance_nr` VARCHAR(50) DEFAULT '0' NOT NULL,
    `firm_id` VARCHAR(60) DEFAULT '' NOT NULL,
    `class_nr` tinyint(2) unsigned DEFAULT 0 NOT NULL,
    `is_void` tinyint(1) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`item_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_person_other_number
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_person_other_number`;

CREATE TABLE `care_person_other_number`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `other_nr` VARCHAR(30) DEFAULT '' NOT NULL,
    `org` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `pid` (`pid`),
    INDEX `other_nr` (`other_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_personell
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_personell`;

CREATE TABLE `care_personell`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `short_id` VARCHAR(10),
    `pid` INTEGER DEFAULT 0 NOT NULL,
    `job_type_nr` INTEGER DEFAULT 0 NOT NULL,
    `job_function_title` VARCHAR(60),
    `date_join` DATE,
    `date_exit` DATE,
    `contract_class` VARCHAR(35) DEFAULT '0' NOT NULL,
    `contract_start` DATE,
    `contract_end` DATE,
    `is_discharged` TINYINT(1) DEFAULT 0 NOT NULL,
    `pay_class` VARCHAR(25) DEFAULT '' NOT NULL,
    `pay_class_sub` VARCHAR(25) DEFAULT '' NOT NULL,
    `local_premium_id` VARCHAR(5) DEFAULT '' NOT NULL,
    `tax_account_nr` VARCHAR(60) DEFAULT '' NOT NULL,
    `ir_code` VARCHAR(25) DEFAULT '' NOT NULL,
    `nr_workday` TINYINT(1) DEFAULT 0 NOT NULL,
    `nr_weekhour` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `nr_vacation_day` TINYINT(2) DEFAULT 0 NOT NULL,
    `multiple_employer` TINYINT(1) DEFAULT 0 NOT NULL,
    `nr_dependent` tinyint(2) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`pid`,`job_type_nr`),
    INDEX `pid` (`pid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_personell_assignment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_personell_assignment`;

CREATE TABLE `care_personell_assignment`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `personell_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `role_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `location_type_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `location_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `date_start` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_end` DATE DEFAULT '0000-00-00' NOT NULL,
    `is_temporary` tinyint(1) unsigned,
    `list_frequency` int(11) unsigned DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`personell_nr`,`role_nr`,`location_type_nr`,`location_nr`),
    INDEX `personell_nr` (`personell_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_personell_jobs
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_personell_jobs`;

CREATE TABLE `care_personell_jobs`
(
    `number` INTEGER NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(30),
    PRIMARY KEY (`number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_pharma_ordercatalog
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_pharma_ordercatalog`;

CREATE TABLE `care_pharma_ordercatalog`
(
    `item_no` INTEGER NOT NULL AUTO_INCREMENT,
    `dept_nr` INTEGER(3) DEFAULT 0 NOT NULL,
    `hit` INTEGER DEFAULT 0 NOT NULL,
    `artikelname` VARCHAR(255) NOT NULL,
    `bestellnum` VARCHAR(20) DEFAULT '' NOT NULL,
    `minorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `maxorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `proorder` VARCHAR(255) NOT NULL,
    INDEX `item_no` (`item_no`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_pharma_orderlist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_pharma_orderlist`;

CREATE TABLE `care_pharma_orderlist`
(
    `order_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept_nr` INTEGER(3) DEFAULT 0 NOT NULL,
    `order_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `order_time` TIME DEFAULT '00:00:00' NOT NULL,
    `articles` TEXT NOT NULL,
    `extra1` VARCHAR(255) NOT NULL,
    `extra2` TEXT NOT NULL,
    `validator` VARCHAR(255) NOT NULL,
    `ip_addr` VARCHAR(255) NOT NULL,
    `priority` VARCHAR(255) NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `sent_datetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `process_datetime` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`order_nr`,`dept_nr`),
    INDEX `dept` (`dept_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_pharma_products_main
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_pharma_products_main`;

CREATE TABLE `care_pharma_products_main`
(
    `bestellnum` VARCHAR(25) DEFAULT '' NOT NULL,
    `artikelnum` VARCHAR(255) NOT NULL,
    `industrynum` VARCHAR(255) NOT NULL,
    `artikelname` VARCHAR(255) NOT NULL,
    `generic` VARCHAR(255) NOT NULL,
    `description` TEXT NOT NULL,
    `packing` VARCHAR(255) NOT NULL,
    `minorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `maxorder` INTEGER(4) DEFAULT 0 NOT NULL,
    `proorder` VARCHAR(255) NOT NULL,
    `picfile` VARCHAR(255) NOT NULL,
    `encoder` VARCHAR(255) NOT NULL,
    `enc_date` VARCHAR(255) NOT NULL,
    `enc_time` VARCHAR(255) NOT NULL,
    `lock_flag` TINYINT(1) DEFAULT 0 NOT NULL,
    `medgroup` TEXT NOT NULL,
    `cave` VARCHAR(255) NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`bestellnum`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_phone
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_phone`;

CREATE TABLE `care_phone`
(
    `item_nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(25),
    `name` VARCHAR(45) DEFAULT '' NOT NULL,
    `vorname` VARCHAR(45) DEFAULT '' NOT NULL,
    `pid` int(11) unsigned DEFAULT 0 NOT NULL,
    `personell_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(3) unsigned DEFAULT 0 NOT NULL,
    `beruf` VARCHAR(25),
    `bereich1` VARCHAR(25),
    `bereich2` VARCHAR(25),
    `inphone1` VARCHAR(15),
    `inphone2` VARCHAR(15),
    `inphone3` VARCHAR(15),
    `exphone1` VARCHAR(25),
    `exphone2` VARCHAR(25),
    `funk1` VARCHAR(15),
    `funk2` VARCHAR(15),
    `roomnr` VARCHAR(10),
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`item_nr`,`pid`,`personell_nr`,`dept_nr`),
    INDEX `name` (`name`),
    INDEX `vorname` (`vorname`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_pregnancy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_pregnancy`;

CREATE TABLE `care_pregnancy`
(
    `nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `this_pregnancy_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `delivery_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `delivery_time` TIME DEFAULT '00:00:00' NOT NULL,
    `gravida` tinyint(2) unsigned,
    `para` tinyint(2) unsigned,
    `pregnancy_gestational_age` tinyint(2) unsigned,
    `nr_of_fetuses` tinyint(2) unsigned,
    `child_encounter_nr` VARCHAR(255) DEFAULT '' NOT NULL,
    `is_booked` TINYINT(1) DEFAULT 0 NOT NULL,
    `vdrl` CHAR,
    `rh` TINYINT(1),
    `delivery_mode` TINYINT(2) DEFAULT 0 NOT NULL,
    `delivery_by` VARCHAR(60),
    `bp_systolic_high` smallint(4) unsigned,
    `bp_diastolic_high` smallint(4) unsigned,
    `proteinuria` TINYINT(1),
    `labour_duration` smallint(3) unsigned,
    `induction_method` TINYINT(2) DEFAULT 0 NOT NULL,
    `induction_indication` VARCHAR(125),
    `anaesth_type_nr` TINYINT(2) DEFAULT 0 NOT NULL,
    `is_epidural` CHAR,
    `complications` VARCHAR(255),
    `perineum` TINYINT(2) DEFAULT 0 NOT NULL,
    `blood_loss` float(8,2) unsigned,
    `blood_loss_unit` VARCHAR(10),
    `is_retained_placenta` CHAR DEFAULT '' NOT NULL,
    `post_labour_condition` VARCHAR(35),
    `outcome` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`encounter_nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_registry
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_registry`;

CREATE TABLE `care_registry`
(
    `registry_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `module_start_script` VARCHAR(60) DEFAULT '' NOT NULL,
    `news_start_script` VARCHAR(60) DEFAULT '' NOT NULL,
    `news_editor_script` VARCHAR(255) DEFAULT '' NOT NULL,
    `news_reader_script` VARCHAR(255) DEFAULT '' NOT NULL,
    `passcheck_script` VARCHAR(255) DEFAULT '' NOT NULL,
    `composite` TEXT NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`registry_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_role_person
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_role_person`;

CREATE TABLE `care_role_person`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `role` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`group_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_room
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_room`;

CREATE TABLE `care_room`
(
    `nr` int(8) unsigned NOT NULL AUTO_INCREMENT,
    `type_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `date_create` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_close` DATE DEFAULT '0000-00-00' NOT NULL,
    `is_temp_closed` TINYINT(1) DEFAULT 0,
    `room_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `ward_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `nr_of_beds` tinyint(3) unsigned DEFAULT 1 NOT NULL,
    `closed_beds` VARCHAR(255) DEFAULT '' NOT NULL,
    `info` VARCHAR(60),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`type_nr`,`ward_nr`,`dept_nr`),
    INDEX `room_nr` (`room_nr`),
    INDEX `ward_nr` (`ward_nr`),
    INDEX `dept_nr` (`dept_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_sessions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_sessions`;

CREATE TABLE `care_sessions`
(
    `SESSKEY` VARCHAR(32) DEFAULT '' NOT NULL,
    `EXPIRY` int(11) unsigned DEFAULT 0 NOT NULL,
    `expireref` VARCHAR(64) DEFAULT '' NOT NULL,
    `DATA` TEXT NOT NULL,
    PRIMARY KEY (`SESSKEY`),
    INDEX `EXPIRY` (`EXPIRY`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_standby_duty_report
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_standby_duty_report`;

CREATE TABLE `care_standby_duty_report`
(
    `report_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept` VARCHAR(15) DEFAULT '' NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `standby_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `standby_start` TIME DEFAULT '00:00:00' NOT NULL,
    `standby_end` TIME DEFAULT '00:00:00' NOT NULL,
    `oncall_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `oncall_start` TIME DEFAULT '00:00:00' NOT NULL,
    `oncall_end` TIME DEFAULT '00:00:00' NOT NULL,
    `op_room` CHAR(2) DEFAULT '' NOT NULL,
    `diagnosis_therapy` TEXT NOT NULL,
    `encoding` TEXT NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`report_nr`),
    INDEX `report_nr` (`report_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_steri_products_main
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_steri_products_main`;

CREATE TABLE `care_steri_products_main`
(
    `bestellnum` int(15) unsigned DEFAULT 0 NOT NULL,
    `containernum` VARCHAR(15) DEFAULT '' NOT NULL,
    `industrynum` VARCHAR(255) NOT NULL,
    `containername` VARCHAR(40) DEFAULT '' NOT NULL,
    `description` TEXT NOT NULL,
    `packing` VARCHAR(255) NOT NULL,
    `minorder` int(4) unsigned DEFAULT 0 NOT NULL,
    `maxorder` int(4) unsigned DEFAULT 0 NOT NULL,
    `proorder` VARCHAR(255) NOT NULL,
    `picfile` VARCHAR(255) NOT NULL,
    `encoder` VARCHAR(255) NOT NULL,
    `enc_date` VARCHAR(255) NOT NULL,
    `enc_time` VARCHAR(255) NOT NULL,
    `lock_flag` TINYINT(1) DEFAULT 0 NOT NULL,
    `medgroup` TEXT NOT NULL,
    `cave` VARCHAR(255) NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tech_questions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tech_questions`;

CREATE TABLE `care_tech_questions`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept` VARCHAR(60) DEFAULT '' NOT NULL,
    `query` TEXT NOT NULL,
    `inquirer` VARCHAR(25) DEFAULT '' NOT NULL,
    `tphone` VARCHAR(30) DEFAULT '' NOT NULL,
    `tdate` DATE DEFAULT '0000-00-00' NOT NULL,
    `ttime` TIME DEFAULT '00:00:00' NOT NULL,
    `tid` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `reply` TEXT NOT NULL,
    `answered` TINYINT(1) DEFAULT 0 NOT NULL,
    `ansby` VARCHAR(25) DEFAULT '' NOT NULL,
    `astamp` VARCHAR(16) DEFAULT '' NOT NULL,
    `archive` TINYINT(1) DEFAULT 0 NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `batch_nr` (`batch_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tech_repair_done
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tech_repair_done`;

CREATE TABLE `care_tech_repair_done`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `dept` VARCHAR(15),
    `dept_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `job_id` VARCHAR(15) DEFAULT '0' NOT NULL,
    `job` TEXT NOT NULL,
    `reporter` VARCHAR(25) DEFAULT '' NOT NULL,
    `id` VARCHAR(15) DEFAULT '' NOT NULL,
    `tdate` DATE DEFAULT '0000-00-00' NOT NULL,
    `ttime` TIME DEFAULT '00:00:00' NOT NULL,
    `tid` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `seen` TINYINT(1) DEFAULT 0 NOT NULL,
    `d_idx` VARCHAR(8) DEFAULT '' NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`dept_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tech_repair_job
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tech_repair_job`;

CREATE TABLE `care_tech_repair_job`
(
    `batch_nr` TINYINT NOT NULL AUTO_INCREMENT,
    `dept` VARCHAR(15) DEFAULT '' NOT NULL,
    `job` TEXT NOT NULL,
    `reporter` VARCHAR(25) DEFAULT '' NOT NULL,
    `id` VARCHAR(15) DEFAULT '' NOT NULL,
    `tphone` VARCHAR(30) DEFAULT '' NOT NULL,
    `tdate` DATE DEFAULT '0000-00-00' NOT NULL,
    `ttime` TIME DEFAULT '00:00:00' NOT NULL,
    `tid` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `done` TINYINT(1) DEFAULT 0 NOT NULL,
    `seen` TINYINT(1) DEFAULT 0 NOT NULL,
    `seenby` VARCHAR(25) DEFAULT '' NOT NULL,
    `sstamp` VARCHAR(16) DEFAULT '' NOT NULL,
    `doneby` VARCHAR(25) DEFAULT '' NOT NULL,
    `dstamp` VARCHAR(16) DEFAULT '' NOT NULL,
    `d_idx` VARCHAR(8) DEFAULT '' NOT NULL,
    `archive` TINYINT(1) DEFAULT 0 NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `batch_nr` (`batch_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_baclabor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_baclabor`;

CREATE TABLE `care_test_findings_baclabor`
(
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `room_nr` VARCHAR(10) DEFAULT '' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `notes` VARCHAR(255) DEFAULT '' NOT NULL,
    `findings_init` TINYINT(1) DEFAULT 0 NOT NULL,
    `findings_current` TINYINT(1) DEFAULT 0 NOT NULL,
    `findings_final` TINYINT(1) DEFAULT 0 NOT NULL,
    `entry_nr` VARCHAR(10) DEFAULT '' NOT NULL,
    `rec_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `type_general` TEXT NOT NULL,
    `resist_anaerob` TEXT NOT NULL,
    `resist_aerob` TEXT NOT NULL,
    `findings` TEXT NOT NULL,
    `doctor_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `findings_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `findings_time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
    INDEX `findings_date` (`findings_date`),
    INDEX `rec_date` (`rec_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_chemlab
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_chemlab`;

CREATE TABLE `care_test_findings_chemlab`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `job_id` VARCHAR(25) NOT NULL,
    `test_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `test_time` TIME DEFAULT '00:00:00' NOT NULL,
    `group_id` VARCHAR(30) DEFAULT '' NOT NULL,
    `serial_value` TEXT NOT NULL,
    `add_value` TEXT NOT NULL,
    `validator` VARCHAR(15) DEFAULT '' NOT NULL,
    `validate_dt` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_chemlab_copy
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_chemlab_copy`;

CREATE TABLE `care_test_findings_chemlab_copy`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `job_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `test_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `test_time` TIME DEFAULT '00:00:00' NOT NULL,
    `group_id` VARCHAR(30) DEFAULT '' NOT NULL,
    `serial_value` TEXT NOT NULL,
    `add_value` TEXT NOT NULL,
    `validator` VARCHAR(15) DEFAULT '' NOT NULL,
    `validate_dt` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`encounter_nr`,`job_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_chemlabor_sub
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_chemlabor_sub`;

CREATE TABLE `care_test_findings_chemlabor_sub`
(
    `sub_id` INTEGER(40) NOT NULL AUTO_INCREMENT,
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `job_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `paramater_name` VARCHAR(255) DEFAULT '0',
    `parameter_value` VARCHAR(255) DEFAULT '0',
    `is_updated` TINYINT(1) DEFAULT 0 NOT NULL,
    `old_param_value` VARCHAR(255),
    `status` VARCHAR(255),
    `history` TEXT,
    `test_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `test_time` TIME,
    `create_id` VARCHAR(35),
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`sub_id`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_laboratory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_laboratory`;

CREATE TABLE `care_test_findings_laboratory`
(
    `findings_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `parent` INTEGER,
    `task_nr` INTEGER DEFAULT -1 NOT NULL,
    `timestamp` BIGINT NOT NULL,
    `finding` TEXT NOT NULL,
    `status` VARCHAR(20) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `history` TEXT NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`findings_nr`,`task_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_patho
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_patho`;

CREATE TABLE `care_test_findings_patho`
(
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `room_nr` VARCHAR(10) DEFAULT '' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `material` TEXT NOT NULL,
    `macro` TEXT NOT NULL,
    `micro` TEXT NOT NULL,
    `findings` TEXT NOT NULL,
    `diagnosis` TEXT NOT NULL,
    `doctor_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `findings_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `findings_time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`encounter_nr`,`room_nr`,`dept_nr`),
    INDEX `send_date` (`findings_date`),
    INDEX `findings_date` (`findings_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_findings_radio
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_findings_radio`;

CREATE TABLE `care_test_findings_radio`
(
    `batch_nr` int(11) unsigned DEFAULT 1 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `room_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `findings` TEXT NOT NULL,
    `diagnosis` TEXT NOT NULL,
    `doctor_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `findings_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `findings_time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`,`encounter_nr`),
    INDEX `send_date` (`findings_date`),
    INDEX `findings_date` (`findings_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_group`;

CREATE TABLE `care_test_group`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `sort_nr` TINYINT DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`group_id`),
    UNIQUE INDEX `group_id` (`group_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_param
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_param`;

CREATE TABLE `care_test_param`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `group_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `id` VARCHAR(10) DEFAULT '' NOT NULL,
    `msr_unit` VARCHAR(15) DEFAULT '' NOT NULL,
    `median` VARCHAR(20),
    `hi_bound` VARCHAR(20),
    `lo_bound` VARCHAR(20),
    `hi_critical` VARCHAR(20),
    `lo_critical` VARCHAR(20),
    `hi_toxic` VARCHAR(20),
    `lo_toxic` VARCHAR(20),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`,`group_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_test_request_baclabor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_baclabor`;

CREATE TABLE `care_test_request_baclabor`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `material` TEXT NOT NULL,
    `test_type` TEXT NOT NULL,
    `material_note` VARCHAR(255) NOT NULL,
    `diagnosis_note` VARCHAR(255) NOT NULL,
    `immune_supp` TINYINT DEFAULT 0 NOT NULL,
    `send_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `sample_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `send_date` (`send_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_blood
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_blood`;

CREATE TABLE `care_test_request_blood`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `blood_group` VARCHAR(10) DEFAULT '' NOT NULL,
    `rh_factor` VARCHAR(10) DEFAULT '' NOT NULL,
    `kell` VARCHAR(10) DEFAULT '' NOT NULL,
    `date_protoc_nr` VARCHAR(45) DEFAULT '' NOT NULL,
    `pure_blood` VARCHAR(15) DEFAULT '' NOT NULL,
    `red_blood` VARCHAR(15) DEFAULT '' NOT NULL,
    `leukoless_blood` VARCHAR(15) DEFAULT '' NOT NULL,
    `washed_blood` VARCHAR(15) DEFAULT '' NOT NULL,
    `prp_blood` VARCHAR(15) DEFAULT '' NOT NULL,
    `thrombo_con` VARCHAR(15) DEFAULT '' NOT NULL,
    `ffp_plasma` VARCHAR(15) DEFAULT '' NOT NULL,
    `transfusion_dev` VARCHAR(15) DEFAULT '' NOT NULL,
    `match_sample` TINYINT DEFAULT 0 NOT NULL,
    `transfusion_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `diagnosis` VARCHAR(255) NOT NULL,
    `notes` VARCHAR(255) NOT NULL,
    `send_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `doctor` VARCHAR(35) DEFAULT '' NOT NULL,
    `phone_nr` VARCHAR(40) DEFAULT '' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `blood_pb` VARCHAR(255) NOT NULL,
    `blood_rb` VARCHAR(255) NOT NULL,
    `blood_llrb` VARCHAR(255) NOT NULL,
    `blood_wrb` VARCHAR(255) NOT NULL,
    `blood_prp` BLOB NOT NULL,
    `blood_tc` VARCHAR(255) NOT NULL,
    `blood_ffp` VARCHAR(255) NOT NULL,
    `b_group_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `b_group_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `a_subgroup_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `a_subgroup_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `extra_factors_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `extra_factors_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `coombs_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `coombs_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `ab_test_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `ab_test_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `crosstest_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `crosstest_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `ab_diff_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `ab_diff_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `x_test_1_code` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_1_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `x_test_1_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_1_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `x_test_2_code` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_2_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `x_test_2_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_2_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `x_test_3_code` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_3_name` VARCHAR(35) DEFAULT '' NOT NULL,
    `x_test_3_count` SMALLINT(9) DEFAULT 0 NOT NULL,
    `x_test_3_price` FLOAT(10,2) DEFAULT 0.00 NOT NULL,
    `lab_stamp` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `release_via` VARCHAR(20) DEFAULT '' NOT NULL,
    `receipt_ack` VARCHAR(20) DEFAULT '' NOT NULL,
    `mainlog_nr` VARCHAR(7) DEFAULT '' NOT NULL,
    `lab_nr` VARCHAR(7) DEFAULT '' NOT NULL,
    `mainlog_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `lab_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `mainlog_sign` VARCHAR(20) DEFAULT '' NOT NULL,
    `lab_sign` VARCHAR(20) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `send_date` (`send_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_chemlabor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_chemlabor`;

CREATE TABLE `care_test_request_chemlabor`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `item_id` VARCHAR(20) NOT NULL,
    `room_nr` VARCHAR(10) DEFAULT '' NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `parameters` TEXT NOT NULL,
    `doctor_sign` VARCHAR(35) DEFAULT '' NOT NULL,
    `highrisk` SMALLINT(1) DEFAULT 0 NOT NULL,
    `notes` LONGTEXT NOT NULL,
    `send_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `specimen_collected` TINYINT(1) DEFAULT 0 NOT NULL,
    `specimen_date` DATETIME,
    `specimen_type` VARCHAR(200),
    `specimen_volume` VARCHAR(100),
    `specimen_units` VARCHAR(50),
    `specimen_taken_by` VARCHAR(200),
    `specimen_container` VARCHAR(200),
    `sample_time` TIME DEFAULT '00:00:00' NOT NULL,
    `sample_weekday` SMALLINT(1) DEFAULT 0 NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT,
    `bill_number` BIGINT DEFAULT 0 NOT NULL,
    `bill_status` VARCHAR(10) DEFAULT '' NOT NULL,
    `is_disabled` VARCHAR(255),
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `priority` TINYINT(1) NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `encounter_nr_2` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_chemlabor_sub
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_chemlabor_sub`;

CREATE TABLE `care_test_request_chemlabor_sub`
(
    `sub_id` INTEGER(40) NOT NULL AUTO_INCREMENT,
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` INTEGER DEFAULT 0 NOT NULL,
    `paramater_name` VARCHAR(255) DEFAULT '0',
    `parameter_value` VARCHAR(255) DEFAULT '0',
    `item_id` VARCHAR(15) NOT NULL,
    `bill_number` INTEGER(20) NOT NULL,
    `bill_status` VARCHAR(15) NOT NULL,
    `is_disabled` VARCHAR(4) NOT NULL,
    `disable_id` VARCHAR(20) NOT NULL,
    `disable_date` DATE NOT NULL,
    `status` VARCHAR(15) NOT NULL,
    `history` TEXT NOT NULL,
    PRIMARY KEY (`sub_id`),
    INDEX `batch_nr` (`batch_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_generic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_generic`;

CREATE TABLE `care_test_request_generic`
(
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `testing_dept` VARCHAR(35) DEFAULT '' NOT NULL,
    `visit` TINYINT(1) DEFAULT 0 NOT NULL,
    `order_patient` TINYINT(1) DEFAULT 0 NOT NULL,
    `diagnosis_quiry` TEXT NOT NULL,
    `send_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `send_doctor` VARCHAR(35) DEFAULT '' NOT NULL,
    `result` TEXT NOT NULL,
    `result_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `result_doctor` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `batch_nr` (`batch_nr`, `encounter_nr`),
    INDEX `send_date` (`send_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_laboratory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_laboratory`;

CREATE TABLE `care_test_request_laboratory`
(
    `batch_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `room_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `doctor_sign` VARCHAR(255) DEFAULT '' NOT NULL,
    `highrisk` SMALLINT(1) DEFAULT 0 NOT NULL,
    `notes` VARCHAR(255) DEFAULT '' NOT NULL,
    `send_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `sample_time` TIME DEFAULT '00:00:00' NOT NULL,
    `sample_weekday` SMALLINT(1) DEFAULT 0 NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` VARCHAR(255) DEFAULT '' NOT NULL,
    `is_disabled` VARCHAR(255),
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_laboratory_tasks
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_laboratory_tasks`;

CREATE TABLE `care_test_request_laboratory_tasks`
(
    `task_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `batch_nr` INTEGER NOT NULL,
    `test_nr` INTEGER NOT NULL,
    `bill_number` BIGINT DEFAULT 0 NOT NULL,
    `bill_status` VARCHAR(10) DEFAULT '' NOT NULL,
    `send_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `is_disabled` TINYINT DEFAULT 0,
    PRIMARY KEY (`task_nr`),
    INDEX `batch_nr` (`batch_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_patho
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_patho`;

CREATE TABLE `care_test_request_patho`
(
    `batch_nr` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `quick_cut` TINYINT DEFAULT 0 NOT NULL,
    `qc_phone` VARCHAR(40) DEFAULT '' NOT NULL,
    `quick_diagnosis` TINYINT DEFAULT 0 NOT NULL,
    `qd_phone` VARCHAR(40) DEFAULT '' NOT NULL,
    `material_type` VARCHAR(25) DEFAULT '' NOT NULL,
    `material_desc` TEXT NOT NULL,
    `localization` VARCHAR(255) NOT NULL,
    `clinical_note` VARCHAR(255) NOT NULL,
    `extra_note` VARCHAR(255) NOT NULL,
    `repeat_note` VARCHAR(255) NOT NULL,
    `gyn_last_period` VARCHAR(25) DEFAULT '' NOT NULL,
    `gyn_period_type` VARCHAR(25) DEFAULT '' NOT NULL,
    `gyn_gravida` VARCHAR(25) DEFAULT '' NOT NULL,
    `gyn_menopause_since` VARCHAR(25) DEFAULT '0' NOT NULL,
    `gyn_hysterectomy` VARCHAR(25) DEFAULT '0' NOT NULL,
    `gyn_contraceptive` VARCHAR(25) DEFAULT '0' NOT NULL,
    `gyn_iud` VARCHAR(25) DEFAULT '' NOT NULL,
    `gyn_hormone_therapy` VARCHAR(25) DEFAULT '' NOT NULL,
    `doctor_sign` VARCHAR(35) DEFAULT '' NOT NULL,
    `op_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `send_date` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `status` VARCHAR(10) DEFAULT '' NOT NULL,
    `entry_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `journal_nr` VARCHAR(15) DEFAULT '' NOT NULL,
    `blocks_nr` INTEGER DEFAULT 0 NOT NULL,
    `deep_cuts` INTEGER DEFAULT 0 NOT NULL,
    `special_dye` VARCHAR(35) DEFAULT '' NOT NULL,
    `immune_histochem` VARCHAR(35) DEFAULT '' NOT NULL,
    `hormone_receptors` VARCHAR(35) DEFAULT '' NOT NULL,
    `specials` VARCHAR(35) DEFAULT '' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `process_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `process_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `send_date` (`send_date`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_test_request_radio
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_test_request_radio`;

CREATE TABLE `care_test_request_radio`
(
    `batch_nr` INTEGER DEFAULT 0 NOT NULL,
    `encounter_nr` int(11) unsigned DEFAULT 0 NOT NULL,
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `xray` TINYINT(1) DEFAULT 0 NOT NULL,
    `ct` TINYINT(1) DEFAULT 0 NOT NULL,
    `sono` TINYINT(1) DEFAULT 0 NOT NULL,
    `mammograph` TINYINT(1) DEFAULT 0 NOT NULL,
    `mrt` TINYINT(1) DEFAULT 0 NOT NULL,
    `nuclear` TINYINT(1) DEFAULT 0 NOT NULL,
    `if_patmobile` TINYINT(1) DEFAULT 0 NOT NULL,
    `if_allergy` TINYINT(1) DEFAULT 0 NOT NULL,
    `if_hyperten` TINYINT(1) DEFAULT 0 NOT NULL,
    `if_pregnant` TINYINT(1) DEFAULT 0 NOT NULL,
    `clinical_info` TEXT NOT NULL,
    `item_id` VARCHAR(10) NOT NULL,
    `test_request` VARCHAR(25) NOT NULL,
    `number_of_tests` INTEGER(5) NOT NULL,
    `send_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `send_doctor` VARCHAR(35) DEFAULT '0' NOT NULL,
    `is_disabled` INTEGER(4) NOT NULL,
    `disable_id` VARCHAR(25) NOT NULL,
    `disable_date` DATE NOT NULL,
    `xray_nr` VARCHAR(9) DEFAULT '0' NOT NULL,
    `r_cm_2` VARCHAR(15) NOT NULL,
    `mtr` VARCHAR(35) NOT NULL,
    `xray_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `xray_time` TIME DEFAULT '00:00:00' NOT NULL,
    `results` TEXT NOT NULL,
    `results_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `results_doctor` VARCHAR(35) NOT NULL,
    `status` VARCHAR(10) NOT NULL,
    `history` TEXT NOT NULL,
    `bill_number` INTEGER(10) NOT NULL,
    `bill_status` VARCHAR(10) NOT NULL,
    `modify_id` VARCHAR(35) NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `process_id` VARCHAR(35) NOT NULL,
    `process_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`batch_nr`),
    UNIQUE INDEX `batch_nr_2` (`batch_nr`),
    INDEX `batch_nr` (`batch_nr`, `encounter_nr`),
    INDEX `send_date` (`xray_time`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_anaesthesia
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_anaesthesia`;

CREATE TABLE `care_type_anaesthesia`
(
    `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
    `id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_application
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_application`;

CREATE TABLE `care_type_application`
(
    `nr` INTEGER NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_assignment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_assignment`;

CREATE TABLE `care_type_assignment`
(
    `type_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '0' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_cause_opdelay
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_cause_opdelay`;

CREATE TABLE `care_type_cause_opdelay`
(
    `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `cause` VARCHAR(255) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type_nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_color
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_color`;

CREATE TABLE `care_type_color`
(
    `color_id` VARCHAR(25) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`color_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_department
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_department`;

CREATE TABLE `care_type_department`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_discharge
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_discharge`;

CREATE TABLE `care_type_discharge`
(
    `nr` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(100) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_duty
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_duty`;

CREATE TABLE `care_type_duty`
(
    `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type_nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_encounter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_encounter`;

CREATE TABLE `care_type_encounter`
(
    `type_nr` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(25) DEFAULT '0' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `hide_from` TINYINT DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_ethnic_orig
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_ethnic_orig`;

CREATE TABLE `care_type_ethnic_orig`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `class_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `type` (`class_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_feeding
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_feeding`;

CREATE TABLE `care_type_feeding`
(
    `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_immunization
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_immunization`;

CREATE TABLE `care_type_immunization`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(20) DEFAULT '' NOT NULL,
    `name` VARCHAR(20) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `period` SMALLINT DEFAULT 0,
    `tolerance` SMALLINT(3) DEFAULT 0,
    `dosage` TEXT,
    `medicine` TEXT NOT NULL,
    `titer` TEXT,
    `note` TEXT,
    `application` TINYINT(3) DEFAULT 0,
    `status` VARCHAR(25) DEFAULT 'normal' NOT NULL,
    `history` TEXT,
    `modify_id` VARCHAR(35),
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_insurance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_insurance`;

CREATE TABLE `care_type_insurance`
(
    `type_nr` INTEGER NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(60) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type_nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_localization
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_localization`;

CREATE TABLE `care_type_localization`
(
    `nr` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
    `category` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `short_code` CHAR DEFAULT '' NOT NULL,
    `LD_var_short_code` VARCHAR(25) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `hide_from` VARCHAR(255) DEFAULT '0' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_location`;

CREATE TABLE `care_type_location`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_measurement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_measurement`;

CREATE TABLE `care_type_measurement`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_notes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_notes`;

CREATE TABLE `care_type_notes`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `sort_nr` SMALLINT DEFAULT 0 NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_outcome
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_outcome`;

CREATE TABLE `care_type_outcome`
(
    `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
    `group_nr` tinyint(3) unsigned DEFAULT 0 NOT NULL,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_perineum
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_perineum`;

CREATE TABLE `care_type_perineum`
(
    `nr` smallint(2) unsigned NOT NULL AUTO_INCREMENT,
    `id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_prescription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_prescription`;

CREATE TABLE `care_type_prescription`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_room
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_room`;

CREATE TABLE `care_type_room`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_test
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_test`;

CREATE TABLE `care_type_test`
(
    `type_nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`type_nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_time
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_time`;

CREATE TABLE `care_type_time`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_type_unit_measurement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_type_unit_measurement`;

CREATE TABLE `care_type_unit_measurement`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `type` (`type`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_adher_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_adher_code`;

CREATE TABLE `care_tz_arv_adher_code`
(
    `care_tz_arv_adher_code_id` BIGINT NOT NULL AUTO_INCREMENT,
    `code` CHAR,
    `description` VARCHAR(40),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_adher_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_adher_reas
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_adher_reas`;

CREATE TABLE `care_tz_arv_adher_reas`
(
    `care_tz_arv_adher_reas_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL,
    `other` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_adher_reas_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_adher_reas_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_adher_reas_code`;

CREATE TABLE `care_tz_arv_adher_reas_code`
(
    `care_tz_arv_adher_reas_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code` tinyint(3) unsigned,
    `description` VARCHAR(40),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_adher_reas_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_allergies
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_allergies`;

CREATE TABLE `care_tz_arv_allergies`
(
    `care_tz_arv_allergies_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_registration_id` BIGINT,
    `description` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_allergies_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_case
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_case`;

CREATE TABLE `care_tz_arv_case`
(
    `care_tz_arv_case_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `pid` int(11) unsigned NOT NULL,
    `datetime_first_hivtest` DATETIME,
    `datetime_start_arv` DATETIME,
    `arv_pid` BIGINT NOT NULL,
    `district` VARCHAR(80),
    `village` VARCHAR(60),
    `street` VARCHAR(60),
    `balozi` VARCHAR(80),
    `chairman_of_village` VARCHAR(80),
    `head_of_family` VARCHAR(80),
    `name_of_secretary` VARCHAR(80),
    `secretary_phone` VARCHAR(10),
    `secretary_adress` VARCHAR(100),
    `history` TEXT,
    `create_id` DATETIME,
    `create_time` BIGINT,
    `modify_id` VARCHAR(35),
    `modify_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`care_tz_arv_case_id`),
    UNIQUE INDEX `pid` (`pid`),
    UNIQUE INDEX `arv_pid` (`arv_pid`),
    UNIQUE INDEX `arv_pid_2` (`arv_pid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_chairman
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_chairman`;

CREATE TABLE `care_tz_arv_chairman`
(
    `care_tz_arv_chairman_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_registration_id` BIGINT,
    `vname` VARCHAR(60),
    `nname` VARCHAR(60),
    `street` VARCHAR(60),
    `village` VARCHAR(60),
    `hamlet` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_chairman_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_co_medi
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_co_medi`;

CREATE TABLE `care_tz_arv_co_medi`
(
    `care_tz_arv_co_medi_id` INTEGER NOT NULL AUTO_INCREMENT,
    `care_tz_arv_co_medi_other_id` int(10) unsigned,
    `item_id` BIGINT,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    PRIMARY KEY (`care_tz_arv_co_medi_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_co_medi_other
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_co_medi_other`;

CREATE TABLE `care_tz_arv_co_medi_other`
(
    `care_tz_arv_co_medi_other_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_co_medi_other_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_co_medications
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_co_medications`;

CREATE TABLE `care_tz_arv_co_medications`
(
    `arv_visit_co_medications_id` INTEGER(2) NOT NULL AUTO_INCREMENT,
    `code` INTEGER(2) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`arv_visit_co_medications_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_districts
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_districts`;

CREATE TABLE `care_tz_arv_districts`
(
    `care_tz_arv_region_id` INTEGER DEFAULT 0 NOT NULL,
    `care_tz_arv_district_id` INTEGER DEFAULT 0 NOT NULL,
    `district_name` VARCHAR(510),
    PRIMARY KEY (`care_tz_arv_region_id`,`care_tz_arv_district_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_arv_education
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_education`;

CREATE TABLE `care_tz_arv_education`
(
    `care_tz_arv_education_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_education_topic_id` BIGINT NOT NULL,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `comment` TEXT,
    `comment_date` DATE,
    `create_id` VARCHAR(35),
    `modify_id` VARCHAR(35),
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `history` TEXT NOT NULL,
    `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
    PRIMARY KEY (`care_tz_arv_education_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_education_group
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_education_group`;

CREATE TABLE `care_tz_arv_education_group`
(
    `care_tz_arv_education_group_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(255),
    PRIMARY KEY (`care_tz_arv_education_group_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_education_topic
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_education_topic`;

CREATE TABLE `care_tz_arv_education_topic`
(
    `care_tz_arv_education_topic_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_education_group_id` int(10) unsigned NOT NULL,
    `description` VARCHAR(255),
    PRIMARY KEY (`care_tz_arv_education_topic_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_eligible_reason
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason`;

CREATE TABLE `care_tz_arv_eligible_reason`
(
    `care_tz_arv_eligible_reason_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `care_tz_arv_lab_id` BIGINT,
    PRIMARY KEY (`care_tz_arv_eligible_reason_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_eligible_reason_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_eligible_reason_code`;

CREATE TABLE `care_tz_arv_eligible_reason_code`
(
    `care_tz_arv_eligible_reason_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_eligible_reason_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_events
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_events`;

CREATE TABLE `care_tz_arv_events`
(
    `care_tz_arv_events_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_events_code_id` BIGINT NOT NULL,
    `care_tz_arv_visit_id` BIGINT NOT NULL,
    PRIMARY KEY (`care_tz_arv_events_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_events_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_events_code`;

CREATE TABLE `care_tz_arv_events_code`
(
    `care_tz_arv_events_code_id` BIGINT NOT NULL AUTO_INCREMENT,
    `who_code` int(10) unsigned,
    `who_code_text` VARCHAR(256),
    `parent` INTEGER(4),
    PRIMARY KEY (`care_tz_arv_events_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_exposure
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_exposure`;

CREATE TABLE `care_tz_arv_exposure`
(
    `care_tz_arv_exposure_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(50),
    PRIMARY KEY (`care_tz_arv_exposure_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_facilities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_facilities`;

CREATE TABLE `care_tz_arv_facilities`
(
    `region_code` VARCHAR(4) NOT NULL,
    `district_code` VARCHAR(4) NOT NULL,
    `care_tz_arv_facility_id` VARCHAR(10) NOT NULL,
    `facility_name` VARCHAR(400) NOT NULL,
    PRIMARY KEY (`region_code`,`district_code`,`care_tz_arv_facility_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_arv_family_planning
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_family_planning`;

CREATE TABLE `care_tz_arv_family_planning`
(
    `arv_visit_family_planning_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(15) NOT NULL,
    `description` VARCHAR(150) NOT NULL,
    PRIMARY KEY (`arv_visit_family_planning_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_follow_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_follow_status`;

CREATE TABLE `care_tz_arv_follow_status`
(
    `care_tz_arv_follow_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_follow_status_code_id` int(10) unsigned,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `other` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_follow_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_follow_status_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_follow_status_code`;

CREATE TABLE `care_tz_arv_follow_status_code`
(
    `care_tz_arv_follow_status_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(8),
    `description` VARCHAR(200),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_follow_status_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_functional_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_functional_status`;

CREATE TABLE `care_tz_arv_functional_status`
(
    `care_tz_arv_functional_status_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `code` CHAR,
    `description` VARCHAR(60),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_functional_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_illness
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_illness`;

CREATE TABLE `care_tz_arv_illness`
(
    `care_tz_arv_illness_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_illness_code_id` BIGINT NOT NULL,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `other` VARCHAR(80),
    PRIMARY KEY (`care_tz_arv_illness_id`),
    INDEX `care_tz_arv_events_FKIndex2` (`care_tz_arv_visit_2_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_illness_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_illness_code`;

CREATE TABLE `care_tz_arv_illness_code`
(
    `care_tz_arv_illness_code_id` BIGINT NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10) NOT NULL,
    `description` VARCHAR(256) NOT NULL,
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_illness_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_lab
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_lab`;

CREATE TABLE `care_tz_arv_lab`
(
    `care_tz_arv_lab_id` BIGINT NOT NULL AUTO_INCREMENT,
    `nr` BIGINT NOT NULL,
    `care_tz_arv_visit_2_id` BIGINT,
    `value` VARCHAR(6),
    `date_analyse` int(10) unsigned,
    PRIMARY KEY (`care_tz_arv_lab_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_lab_param
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_lab_param`;

CREATE TABLE `care_tz_arv_lab_param`
(
    `care_tz_arv_lab_param_id` BIGINT NOT NULL AUTO_INCREMENT,
    `lab_param` int(10) unsigned,
    `unit` VARCHAR(20),
    `param_upper` int(10) unsigned,
    `param_lower` int(10) unsigned,
    PRIMARY KEY (`care_tz_arv_lab_param_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_nutritional_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_nutritional_status`;

CREATE TABLE `care_tz_arv_nutritional_status`
(
    `care_tz_arv_nutritional_status_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(20) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`care_tz_arv_nutritional_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_nutritional_supp
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_nutritional_supp`;

CREATE TABLE `care_tz_arv_nutritional_supp`
(
    `care_tz_arv_nutritional_supp_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(20) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`care_tz_arv_nutritional_supp_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_nutritional_supplement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_nutritional_supplement`;

CREATE TABLE `care_tz_arv_nutritional_supplement`
(
    `care_tz_arv_nutritional_supplement_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(20) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    `other` VARCHAR(50),
    PRIMARY KEY (`care_tz_arv_nutritional_supplement_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_referred
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_referred`;

CREATE TABLE `care_tz_arv_referred`
(
    `care_tz_arv_referred_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_referred_code_id` BIGINT,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `other` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_referred_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_referred_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_referred_code`;

CREATE TABLE `care_tz_arv_referred_code`
(
    `care_tz_arv_referred_code_id` BIGINT NOT NULL AUTO_INCREMENT,
    `code` tinyint(3) unsigned,
    `description` VARCHAR(60),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_referred_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_referred_from
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_referred_from`;

CREATE TABLE `care_tz_arv_referred_from`
(
    `care_tz_arv_referred_from_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `other` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_referred_from_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_referred_from_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_referred_from_code`;

CREATE TABLE `care_tz_arv_referred_from_code`
(
    `care_tz_arv_referred_from_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(30),
    PRIMARY KEY (`care_tz_arv_referred_from_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_regimen
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_regimen`;

CREATE TABLE `care_tz_arv_regimen`
(
    `care_tz_arv_regimen_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_regimen_code_id` BIGINT,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `other` VARCHAR(80),
    `regimen_days` int(3) unsigned,
    PRIMARY KEY (`care_tz_arv_regimen_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_regimen_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_regimen_code`;

CREATE TABLE `care_tz_arv_regimen_code`
(
    `care_tz_arv_regimen_code_id` BIGINT NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10),
    `description` VARCHAR(60),
    `parent` int(10) unsigned,
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_regimen_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_region`;

CREATE TABLE `care_tz_arv_region`
(
    `care_tz_arv_region_id` INTEGER NOT NULL AUTO_INCREMENT,
    `region_name` VARCHAR(400),
    PRIMARY KEY (`care_tz_arv_region_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_arv_registration
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_registration`;

CREATE TABLE `care_tz_arv_registration`
(
    `care_tz_arv_registration_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_lab_id` BIGINT,
    `care_tz_arv_functional_status_id` int(10) unsigned,
    `care_tz_arv_exposure_id` int(10) unsigned,
    `pid` int(11) unsigned NOT NULL,
    `ctc_id` VARCHAR(14) NOT NULL,
    `tb_reg_no` VARCHAR(14),
    `hbc_number` VARCHAR(14),
    `ten_cell_leader` VARCHAR(60),
    `head_of_household` VARCHAR(60),
    `head_of_household_contact` VARCHAR(100),
    `date_first_hiv_test` DATETIME,
    `date_confirmed_hiv` DATETIME,
    `date_eligible` DATETIME,
    `date_enrolled` DATETIME,
    `date_ready` DATETIME,
    `date_start_art` DATETIME,
    `age_start_art` INTEGER(10),
    `status_clinical_stage` int(10) unsigned,
    `status_weight` DOUBLE,
    `status_height` DOUBLE,
    `create_id` VARCHAR(35),
    `create_time` BIGINT(35),
    `modify_id` VARCHAR(35),
    `modify_time` DATETIME,
    `history` TEXT,
    PRIMARY KEY (`care_tz_arv_registration_id`),
    UNIQUE INDEX `pid` (`pid`),
    UNIQUE INDEX `ctc_id` (`ctc_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_relatives
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_relatives`;

CREATE TABLE `care_tz_arv_relatives`
(
    `care_tz_arv_registration_id` INTEGER(10) NOT NULL,
    `relative_name` VARCHAR(100) NOT NULL,
    `care_tz_arv_relatives_code_id` INTEGER(10) NOT NULL,
    `age` INTEGER(10) NOT NULL,
    `hiv_status` VARCHAR(25) NOT NULL,
    `hiv_care_status` VARCHAR(50) NOT NULL,
    `relative_ctc_id` VARCHAR(14) DEFAULT '' NOT NULL,
    `facility_file_no` VARCHAR(10) DEFAULT '' NOT NULL,
    `history` VARCHAR(200) NOT NULL,
    PRIMARY KEY (`care_tz_arv_registration_id`,`relative_ctc_id`,`facility_file_no`),
    UNIQUE INDEX `relative_id` (`care_tz_arv_registration_id`, `relative_ctc_id`, `facility_file_no`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_arv_relatives_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_relatives_code`;

CREATE TABLE `care_tz_arv_relatives_code`
(
    `care_tz_arv_relatives_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(50),
    PRIMARY KEY (`care_tz_arv_relatives_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_rep_nacp_coh_ind
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_rep_nacp_coh_ind`;

CREATE TABLE `care_tz_arv_rep_nacp_coh_ind`
(
    `indicator_id` INTEGER,
    `indicator_description` VARCHAR(510),
    `numerator_description` VARCHAR(510),
    `denominator_description` VARCHAR(510),
    `numerator_formula` VARCHAR(100),
    `denominator_formula` VARCHAR(100),
    `age_group` VARCHAR(100)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_arv_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_status`;

CREATE TABLE `care_tz_arv_status`
(
    `care_tz_arv_status_id` BIGINT NOT NULL AUTO_INCREMENT,
    `code` TINYINT(1) NOT NULL,
    `description` VARCHAR(20),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_status_txt
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_status_txt`;

CREATE TABLE `care_tz_arv_status_txt`
(
    `care_tz_arv_status_txt_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_visit_2_id` BIGINT NOT NULL,
    `care_tz_arv_status_txt_code_id` BIGINT(50) NOT NULL,
    `other` VARCHAR(50),
    PRIMARY KEY (`care_tz_arv_status_txt_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_status_txt_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_status_txt_code`;

CREATE TABLE `care_tz_arv_status_txt_code`
(
    `care_tz_arv_status_txt_code_id` BIGINT(50) NOT NULL AUTO_INCREMENT,
    `code` tinyint(3) unsigned,
    `description` VARCHAR(100),
    `parent` INTEGER(4) NOT NULL,
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_status_txt_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_tb_status
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_tb_status`;

CREATE TABLE `care_tz_arv_tb_status`
(
    `care_tz_arv_tb_status_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10),
    `description` VARCHAR(70),
    `other` TINYINT(1) NOT NULL,
    PRIMARY KEY (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_tb_treatment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_tb_treatment`;

CREATE TABLE `care_tz_arv_tb_treatment`
(
    `care_tz_arv_tb_treatment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_tb_treatment_code_id` INTEGER(10) NOT NULL,
    `care_tz_arv_visit_2_id` INTEGER(10) NOT NULL,
    `other` VARCHAR(80),
    PRIMARY KEY (`care_tz_arv_tb_treatment_id`),
    INDEX `care_tz_arv_events_FKIndex2` (`care_tz_arv_visit_2_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_tb_treatment_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_tb_treatment_code`;

CREATE TABLE `care_tz_arv_tb_treatment_code`
(
    `care_tz_arv_tb_treatment_code_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(10),
    `description` VARCHAR(70),
    `other` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`care_tz_arv_tb_treatment_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_transfer_in
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_transfer_in`;

CREATE TABLE `care_tz_arv_transfer_in`
(
    `care_tz_arv_transfer_in_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_transfer_in_code_id` int(10) unsigned NOT NULL,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `other` VARCHAR(60),
    PRIMARY KEY (`care_tz_arv_transfer_in_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_transfer_in_code
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_transfer_in_code`;

CREATE TABLE `care_tz_arv_transfer_in_code`
(
    `care_tz_arv_transfer_in_code_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(50),
    PRIMARY KEY (`care_tz_arv_transfer_in_code_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_treatment_supporter
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_treatment_supporter`;

CREATE TABLE `care_tz_arv_treatment_supporter`
(
    `care_tz_arv_treatment_supporter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `care_tz_arv_registration_id` BIGINT,
    `vname` VARCHAR(60),
    `nname` VARCHAR(60),
    `street` VARCHAR(60),
    `village` VARCHAR(60),
    `telephone` VARCHAR(10),
    `joined_supporter_org` VARCHAR(10) DEFAULT 'No' NOT NULL,
    `organisation` VARCHAR(30),
    PRIMARY KEY (`care_tz_arv_treatment_supporter_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_visit
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_visit`;

CREATE TABLE `care_tz_arv_visit`
(
    `care_tz_arv_visit_2_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `care_tz_arv_adher_code_id` BIGINT NOT NULL,
    `care_tz_arv_functional_status_id` INTEGER(10) NOT NULL,
    `care_tz_arv_tb_status_id` BIGINT NOT NULL,
    `care_tz_arv_case_id` bigint(20) unsigned NOT NULL,
    `encounter_nr` BIGINT NOT NULL,
    `visit_date` DATETIME NOT NULL,
    `care_tz_arv_status_id` BIGINT DEFAULT -1 NOT NULL,
    `weight` DOUBLE,
    `height` DOUBLE NOT NULL,
    `clinical_stage` TINYINT(3) NOT NULL,
    `pregnant` TINYINT(1) NOT NULL,
    `date_of_delivery` DATETIME NOT NULL,
    `test_TB` TINYINT(1) DEFAULT 0 NOT NULL,
    `cotrim` TINYINT(1) DEFAULT 0 NOT NULL,
    `test_INH` TINYINT(1) DEFAULT 0 NOT NULL,
    `diflucan` TINYINT(1) DEFAULT 0 NOT NULL,
    `nutrition_support` TINYINT(1) NOT NULL,
    `next_visit_date` DATE NOT NULL,
    `other_problems` VARCHAR(80),
    `create_id` VARCHAR(35) NOT NULL,
    `create_time` BIGINT NOT NULL,
    `modify_id` VARCHAR(35),
    `modify_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `history` TEXT,
    PRIMARY KEY (`care_tz_arv_visit_2_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_visit_2
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_visit_2`;

CREATE TABLE `care_tz_arv_visit_2`
(
    `care_tz_arv_visit_2_id` BIGINT NOT NULL AUTO_INCREMENT,
    `care_tz_arv_registration_id` BIGINT NOT NULL,
    `care_tz_arv_adher_code_id` BIGINT,
    `care_tz_arv_functional_status_id` int(10) unsigned,
    `care_tz_arv_tb_status_id` BIGINT,
    `care_tz_arv_status_id` BIGINT,
    `care_tz_arv_nutritional_status_id` INTEGER(10) NOT NULL,
    `care_tz_arv_nutritional_supp_id` INTEGER(10) NOT NULL,
    `encounter_nr` BIGINT NOT NULL,
    `visit_date` DATETIME,
    `care_tz_arv_visit_type_id` INTEGER(10) NOT NULL,
    `weight` DOUBLE,
    `height` DOUBLE,
    `clinical_stage` tinyint(3) unsigned,
    `pregnant` TINYINT(1) DEFAULT 0,
    `date_of_delivery` DATE,
    `family_planning_id` INTEGER(10),
    `preg_clinic_id` VARCHAR(7),
    `cotrim` TINYINT(1) DEFAULT 0,
    `diflucan` TINYINT(1) DEFAULT 0,
    `nutrition_support` tinyint(1) unsigned,
    `next_visit_date` DATE,
    `create_id` VARCHAR(35),
    `create_time` BIGINT,
    `modify_id` VARCHAR(35),
    `modify_time` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    `history` TEXT NOT NULL,
    PRIMARY KEY (`care_tz_arv_visit_2_id`),
    UNIQUE INDEX `encounter_nr` (`encounter_nr`),
    INDEX `care_tz_arv_visit_FKIndex1` (`care_tz_arv_functional_status_id`),
    INDEX `care_tz_arv_visit_FKIndex2` (`care_tz_arv_tb_status_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_arv_visit_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_arv_visit_type`;

CREATE TABLE `care_tz_arv_visit_type`
(
    `care_tz_arv_visit_type_id` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(15) NOT NULL,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`care_tz_arv_visit_type_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing`;

CREATE TABLE `care_tz_billing`
(
    `nr` BIGINT NOT NULL AUTO_INCREMENT,
    `encounter_nr` BIGINT DEFAULT 0 NOT NULL,
    `first_date` BIGINT DEFAULT 0 NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `creation_date` BIGINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `encounter_nr` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_archieve_special
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_archieve_special`;

CREATE TABLE `care_tz_billing_archieve_special`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` VARCHAR(100) DEFAULT '' NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `dept_nr` VARCHAR(100) DEFAULT '' NOT NULL,
    `type` VARCHAR(100) DEFAULT '' NOT NULL,
    `paid` DOUBLE(11,0) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_archive
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_archive`;

CREATE TABLE `care_tz_billing_archive`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `nr` BIGINT DEFAULT 0 NOT NULL,
    `encounter_nr` BIGINT DEFAULT 0 NOT NULL,
    `first_date` BIGINT DEFAULT 0 NOT NULL,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `creation_date` BIGINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `nr` (`nr`),
    INDEX `nr_2` (`nr`, `encounter_nr`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `encounter_nr_2` (`encounter_nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_archive_elem
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_archive_elem`;

CREATE TABLE `care_tz_billing_archive_elem`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `nr` BIGINT DEFAULT 0 NOT NULL,
    `date_change` BIGINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `is_medicine` TINYINT DEFAULT 0 NOT NULL,
    `is_radio_test` TINYINT NOT NULL,
    `is_comment` TINYINT DEFAULT 0 NOT NULL,
    `is_paid` TINYINT DEFAULT 0 NOT NULL,
    `amount` BIGINT DEFAULT 0 NOT NULL,
    `times_per_day` SMALLINT(10) NOT NULL,
    `days` SMALLINT(10) NOT NULL,
    `price` VARCHAR(255) DEFAULT '' NOT NULL,
    `materialcost` VARCHAR(255) DEFAULT '0' NOT NULL,
    `balanced_insurance` VARCHAR(20),
    `insurance_id` BIGINT,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `notes` VARCHAR(255) NOT NULL,
    `item_number` BIGINT DEFAULT 0 NOT NULL,
    `prescriptions_nr` BIGINT DEFAULT 0 NOT NULL,
    `User_Id` VARCHAR(100),
    `signed_by_follower` TINYINT(1) DEFAULT 0 NOT NULL,
    `is_transmit2ERP` TINYINT NOT NULL,
    `is_deposit_item` TINYINT(1) DEFAULT 0 NOT NULL,
    `sub_store` VARCHAR(25) NOT NULL,
    `bank_ref` VARCHAR(255) NOT NULL,
    `current_dept_nr` SMALLINT(3) NOT NULL,
    `current_ward_nr` SMALLINT(3) NOT NULL,
    `close_deposit` TINYINT(2) DEFAULT 0 NOT NULL,
    `encounter_class_nr` SMALLINT(5) NOT NULL,
    PRIMARY KEY (`ID`),
    INDEX `nr` (`nr`),
    INDEX `date_change` (`date_change`),
    INDEX `prescriptions_nr` (`prescriptions_nr`),
    INDEX `nr_2` (`nr`),
    INDEX `item_number` (`item_number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_elem
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_elem`;

CREATE TABLE `care_tz_billing_elem`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `nr` BIGINT DEFAULT 0 NOT NULL,
    `date_change` BIGINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `is_medicine` TINYINT DEFAULT 0 NOT NULL,
    `is_radio_test` TINYINT NOT NULL,
    `is_comment` TINYINT DEFAULT 0 NOT NULL,
    `is_paid` TINYINT DEFAULT 0 NOT NULL,
    `amount` BIGINT DEFAULT 0 NOT NULL,
    `amount_doc` BIGINT NOT NULL,
    `times_per_day` SMALLINT(10) NOT NULL,
    `days` SMALLINT(10) NOT NULL,
    `price` VARCHAR(255) NOT NULL,
    `materialcost` DOUBLE(10,2),
    `bank_ref` BIGINT,
    `balanced_insurance` VARCHAR(20),
    `insurance_id` BIGINT,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `notes` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_number` BIGINT DEFAULT 0 NOT NULL,
    `prescriptions_nr` BIGINT DEFAULT 0 NOT NULL,
    `sub_store` VARCHAR(25) NOT NULL,
    `is_deposit_item` SMALLINT(5) NOT NULL,
    `User_Id` VARCHAR(50) NOT NULL,
    `current_dept_nr` SMALLINT(5) NOT NULL,
    `current_ward_nr` SMALLINT(5) NOT NULL,
    `encounter_class_nr` SMALLINT(5) NOT NULL,
    PRIMARY KEY (`ID`),
    INDEX `nr` (`nr`),
    INDEX `nr_2` (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_elem_advance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_elem_advance`;

CREATE TABLE `care_tz_billing_elem_advance`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `nr` BIGINT DEFAULT 0 NOT NULL,
    `date_change` BIGINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `is_medicine` TINYINT DEFAULT 0 NOT NULL,
    `is_radio_test` TINYINT NOT NULL,
    `is_comment` TINYINT DEFAULT 0 NOT NULL,
    `is_paid` TINYINT DEFAULT 0 NOT NULL,
    `amount` BIGINT DEFAULT 0 NOT NULL,
    `amount_doc` BIGINT NOT NULL,
    `times_per_day` SMALLINT(10) NOT NULL,
    `days` SMALLINT(10) NOT NULL,
    `price` VARCHAR(255) DEFAULT '' NOT NULL,
    `balanced_insurance` VARCHAR(20),
    `insurance_id` BIGINT,
    `description` VARCHAR(255) DEFAULT '' NOT NULL,
    `notes` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_number` BIGINT DEFAULT 0 NOT NULL,
    `prescriptions_nr` BIGINT DEFAULT 0 NOT NULL,
    `is_deposit_item` TINYINT(1) DEFAULT 0 NOT NULL,
    `User_Id` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`ID`),
    INDEX `nr` (`nr`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_billing_special
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_billing_special`;

CREATE TABLE `care_tz_billing_special`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `encounter_nr` VARCHAR(100) DEFAULT '' NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `fullname` VARCHAR(100) DEFAULT '' NOT NULL,
    `dept_nr` VARCHAR(100) DEFAULT '' NOT NULL,
    `type` VARCHAR(100) DEFAULT '' NOT NULL,
    `remain` DOUBLE(11,0) DEFAULT 0 NOT NULL,
    `total` DOUBLE(11,0) DEFAULT 0 NOT NULL,
    `billno` BIGINT DEFAULT 0 NOT NULL,
    `paid` DOUBLE(11,0) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_company
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_company`;

CREATE TABLE `care_tz_company`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) DEFAULT '' NOT NULL,
    `contact` VARCHAR(255) DEFAULT '' NOT NULL,
    `email` VARCHAR(60) NOT NULL,
    `phone_code` INTEGER(5) NOT NULL,
    `phone_nr` VARCHAR(20) NOT NULL,
    `po_box` VARCHAR(255) DEFAULT '' NOT NULL,
    `city` VARCHAR(255) DEFAULT '' NOT NULL,
    `start_date` BIGINT DEFAULT 0 NOT NULL,
    `end_date` BIGINT DEFAULT 0 NOT NULL,
    `invoice_flag` TINYINT DEFAULT 0 NOT NULL,
    `credit_preselection_flag` TINYINT DEFAULT 0 NOT NULL,
    `hide_company_flag` TINYINT DEFAULT 0 NOT NULL,
    `prepaid_amount` INTEGER NOT NULL,
    `modify_id` VARCHAR(25) NOT NULL,
    `enable_member_expiry` TINYINT(2) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_dhis_element
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_dhis_element`;

CREATE TABLE `care_tz_dhis_element`
(
    `codeid` INTEGER(10) NOT NULL AUTO_INCREMENT,
    `icd_code` CHAR(10),
    `dataelement_id` INTEGER(10),
    `categoryid` INTEGER NOT NULL,
    `optionid` INTEGER NOT NULL,
    `icd_desease_name` TEXT,
    `dhis_dataelement` TEXT,
    `dhis_under5` TEXT,
    `dhis_under5id` INTEGER(10),
    PRIMARY KEY (`codeid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_dhis_period
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_dhis_period`;

CREATE TABLE `care_tz_dhis_period`
(
    `periodid` INTEGER NOT NULL AUTO_INCREMENT,
    `periodtypeid` INTEGER,
    `startdate` DATE NOT NULL,
    `enddate` DATE NOT NULL,
    PRIMARY KEY (`periodid`),
    UNIQUE INDEX `periodtypeid` (`periodtypeid`, `startdate`, `enddate`),
    INDEX `fk_period_periodtypeid` (`periodtypeid`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_diagnosis
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_diagnosis`;

CREATE TABLE `care_tz_diagnosis`
(
    `case_nr` BIGINT NOT NULL AUTO_INCREMENT,
    `parent_case_nr` BIGINT DEFAULT -1 NOT NULL,
    `PID` BIGINT DEFAULT 0 NOT NULL,
    `encounter_nr` BIGINT DEFAULT 0 NOT NULL,
    `timestamp` BIGINT DEFAULT 0 NOT NULL,
    `ICD_10_code` VARCHAR(10) DEFAULT '' NOT NULL,
    `ICD_10_description` VARCHAR(50) DEFAULT '' NOT NULL,
    `type` VARCHAR(25) DEFAULT '' NOT NULL,
    `comment` VARCHAR(255),
    `doctor_name` VARCHAR(200),
    PRIMARY KEY (`case_nr`),
    INDEX `parent_case_nr` (`parent_case_nr`, `PID`, `encounter_nr`, `timestamp`),
    INDEX `ICD_10_code` (`ICD_10_code`),
    INDEX `encounter_nr_2` (`encounter_nr`),
    INDEX `PID_2` (`PID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_district
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_district`;

CREATE TABLE `care_tz_district`
(
    `district_id` INTEGER NOT NULL AUTO_INCREMENT,
    `district_code` INTEGER(10) NOT NULL,
    `district_name` VARCHAR(100) NOT NULL,
    `is_additional` TINYINT NOT NULL,
    PRIMARY KEY (`district_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_druglist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_druglist`;

CREATE TABLE `care_tz_druglist`
(
    `item_id` BIGINT NOT NULL AUTO_INCREMENT,
    `item_number` VARCHAR(50) DEFAULT '' NOT NULL,
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `mems_item_code` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_pack_size` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_price_per_pack_size` DOUBLE DEFAULT 0 NOT NULL,
    `mems_sizes` VARCHAR(50) DEFAULT '' NOT NULL,
    `item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `dosage` VARCHAR(50) DEFAULT '' NOT NULL,
    `unit_price` VARCHAR(50) DEFAULT '' NOT NULL,
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    PRIMARY KEY (`item_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugliststruc
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugliststruc`;

CREATE TABLE `care_tz_drugliststruc`
(
    `item_id` BIGINT DEFAULT 0 NOT NULL,
    `item_number` VARCHAR(5) DEFAULT '' NOT NULL,
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `mems_item_code` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_pack_size` VARCHAR(255) DEFAULT '' NOT NULL,
    `mems_price_per_pack_size` DOUBLE DEFAULT 0 NOT NULL,
    `mems_sizes` VARCHAR(50) DEFAULT '' NOT NULL,
    `item_description` VARCHAR(100),
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `dosage` VARCHAR(50) DEFAULT '' NOT NULL,
    `unit_price` VARCHAR(50) DEFAULT '0.00',
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    PRIMARY KEY (`item_number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugs_reordering_level
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugs_reordering_level`;

CREATE TABLE `care_tz_drugs_reordering_level`
(
    `item_id` INTEGER NOT NULL,
    `reordering_level` INTEGER,
    PRIMARY KEY (`item_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices`;

CREATE TABLE `care_tz_drugsandservices`
(
    `item_id` BIGINT NOT NULL AUTO_INCREMENT,
    `item_number` VARCHAR(50) DEFAULT '' NOT NULL,
    `partcode` VARCHAR(255) NOT NULL,
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `is_radio_test` TINYINT NOT NULL,
    `item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `unit_price` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_1` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_2` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_3` DOUBLE(10,2) DEFAULT 0.00,
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    `sub_class` VARCHAR(25) NOT NULL,
    `not_in_use` INTEGER(4) NOT NULL,
    `min_level` INTEGER(20) DEFAULT 0 NOT NULL,
    `unit_price_4` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_5` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_6` DOUBLE(10,2) DEFAULT 0.00,
    `unit_price_7` INTEGER(10) NOT NULL,
    `unit_price_8` INTEGER(10) NOT NULL,
    `unit_price_9` INTEGER(10) NOT NULL,
    `unit_price_10` INTEGER(10) NOT NULL,
    `unit_price_11` INTEGER(10) NOT NULL,
    `unit_cost` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`item_id`),
    INDEX `IX_ITEM_NUMBER` (`item_number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_archive
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_archive`;

CREATE TABLE `care_tz_drugsandservices_archive`
(
    `item_id` BIGINT NOT NULL,
    `item_number` VARCHAR(50) DEFAULT '' NOT NULL,
    `partcode` VARCHAR(255),
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `unit_price` VARCHAR(50) DEFAULT '' NOT NULL,
    `unit_price_1` VARCHAR(50),
    `unit_price_2` VARCHAR(50),
    `unit_price_3` VARCHAR(50),
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    `timestamp` BIGINT,
    INDEX `timestamp` (`timestamp`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_backup
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_backup`;

CREATE TABLE `care_tz_drugsandservices_backup`
(
    `item_id` BIGINT NOT NULL AUTO_INCREMENT,
    `item_number` VARCHAR(50) DEFAULT '' NOT NULL,
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `unit_price` VARCHAR(50) DEFAULT '' NOT NULL,
    `unit_price_1` VARCHAR(50),
    `unit_price_2` VARCHAR(50),
    `unit_price_3` VARCHAR(50),
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    PRIMARY KEY (`item_id`),
    INDEX `IX_ITEM_NUMBER` (`item_number`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_categories`;

CREATE TABLE `care_tz_drugsandservices_categories`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `fieldname` VARCHAR(50) NOT NULL,
    `description` VARCHAR(50) NOT NULL,
    `is_disabled` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_description
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_description`;

CREATE TABLE `care_tz_drugsandservices_description`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `last_change` BIGINT NOT NULL,
    `UID` VARCHAR(50) NOT NULL,
    `Fieldname` VARCHAR(50) NOT NULL,
    `ShowDescription` VARCHAR(50) NOT NULL,
    `FullDescription` VARCHAR(255) NOT NULL,
    `is_insurance_price` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_sub_categories
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_sub_categories`;

CREATE TABLE `care_tz_drugsandservices_sub_categories`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `parent` VARCHAR(50) NOT NULL,
    `is_disabled` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_drugsandservices_update
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_drugsandservices_update`;

CREATE TABLE `care_tz_drugsandservices_update`
(
    `item_id` BIGINT NOT NULL AUTO_INCREMENT,
    `item_number` VARCHAR(50) DEFAULT '' NOT NULL,
    `partcode` VARCHAR(255),
    `is_pediatric` SMALLINT DEFAULT 0 NOT NULL,
    `is_adult` SMALLINT DEFAULT 0 NOT NULL,
    `is_other` SMALLINT DEFAULT 0 NOT NULL,
    `is_consumable` SMALLINT DEFAULT 0 NOT NULL,
    `is_labtest` TINYINT DEFAULT 0 NOT NULL,
    `item_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `item_full_description` VARCHAR(255) DEFAULT '' NOT NULL,
    `unit_price` VARCHAR(50) DEFAULT '' NOT NULL,
    `unit_price_1` VARCHAR(50),
    `unit_price_2` VARCHAR(50),
    `unit_price_3` VARCHAR(50),
    `purchasing_class` VARCHAR(50) DEFAULT '' NOT NULL,
    PRIMARY KEY (`item_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_anterior_segment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_anterior_segment`;

CREATE TABLE `care_tz_eye_anterior_segment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_conjunctiva
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_conjunctiva`;

CREATE TABLE `care_tz_eye_conjunctiva`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `right_eye_test8` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `left_eye_test8` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_cornea
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_cornea`;

CREATE TABLE `care_tz_eye_cornea`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_eyelids
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_eyelids`;

CREATE TABLE `care_tz_eye_eyelids`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `right_eye_test8` VARCHAR(100),
    `right_eye_test9` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `left_eye_test8` VARCHAR(100),
    `left_eye_test9` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_facial_ocular_orbitalsymmetry
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_facial_ocular_orbitalsymmetry`;

CREATE TABLE `care_tz_eye_facial_ocular_orbitalsymmetry`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_history1
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_history1`;

CREATE TABLE `care_tz_eye_history1`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(100) NOT NULL,
    `hid1` VARCHAR(100) NOT NULL,
    `hid1e` VARCHAR(100) NOT NULL,
    `hid1d` VARCHAR(100) NOT NULL,
    `hid2` VARCHAR(100) NOT NULL,
    `hid2e` VARCHAR(100) NOT NULL,
    `hid2d` VARCHAR(100) NOT NULL,
    `hid3` VARCHAR(100) NOT NULL,
    `hid3e` VARCHAR(100) NOT NULL,
    `hid3d` VARCHAR(100) NOT NULL,
    `hid4` VARCHAR(100) NOT NULL,
    `hid4e` VARCHAR(100) NOT NULL,
    `hid4d` VARCHAR(100) NOT NULL,
    `hid5` VARCHAR(100) NOT NULL,
    `hid5e` VARCHAR(100) NOT NULL,
    `hid5d` VARCHAR(100) NOT NULL,
    `hid6` VARCHAR(100) NOT NULL,
    `signature` VARCHAR(100) NOT NULL,
    `remarks` VARCHAR(100) NOT NULL,
    `examination_date` DATE NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_history2
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_history2`;

CREATE TABLE `care_tz_eye_history2`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1` VARCHAR(100) NOT NULL,
    `hid1e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2` VARCHAR(100) NOT NULL,
    `hid2e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3` VARCHAR(100) NOT NULL,
    `hid3e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4` VARCHAR(100) NOT NULL,
    `hid4e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5` VARCHAR(100) NOT NULL,
    `hid5e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid6` VARCHAR(100) NOT NULL,
    `hid6e` VARCHAR(100) NOT NULL,
    `hid6d` VARCHAR(100) NOT NULL,
    `hid7` VARCHAR(100) NOT NULL,
    `hid7e` VARCHAR(100) NOT NULL,
    `hid7d` VARCHAR(100) NOT NULL,
    `hid8` VARCHAR(100) NOT NULL,
    `signature` VARCHAR(100) DEFAULT '' NOT NULL,
    `remarks` VARCHAR(100) DEFAULT '' NOT NULL,
    `examination_date` DATE DEFAULT '0000-00-00' NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_history3
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_history3`;

CREATE TABLE `care_tz_eye_history3`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1` VARCHAR(100) NOT NULL,
    `hid1e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2` VARCHAR(100) NOT NULL,
    `hid2e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3` VARCHAR(100) NOT NULL,
    `hid3e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4` VARCHAR(100) NOT NULL,
    `hid4e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5` VARCHAR(100) NOT NULL,
    `hid5e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid6` VARCHAR(100) DEFAULT '' NOT NULL,
    `signature` VARCHAR(100) DEFAULT '' NOT NULL,
    `remarks` VARCHAR(100) DEFAULT '' NOT NULL,
    `examination_date` DATE DEFAULT '0000-00-00' NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_history4
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_history4`;

CREATE TABLE `care_tz_eye_history4`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1` VARCHAR(100) NOT NULL,
    `hid1e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2` VARCHAR(100) NOT NULL,
    `hid2e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3` VARCHAR(100) NOT NULL,
    `hid3e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4` VARCHAR(100) NOT NULL,
    `hid4e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5` VARCHAR(100) NOT NULL,
    `hid5e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid6` VARCHAR(100) NOT NULL,
    `hid6e` VARCHAR(100) NOT NULL,
    `hid6d` VARCHAR(100) NOT NULL,
    `hid7` VARCHAR(100) NOT NULL,
    `signature` VARCHAR(100) DEFAULT '' NOT NULL,
    `remarks` VARCHAR(100) DEFAULT '' NOT NULL,
    `examination_date` DATE DEFAULT '0000-00-00' NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_history5
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_history5`;

CREATE TABLE `care_tz_eye_history5`
(
    `id` INTEGER DEFAULT 0 NOT NULL,
    `pid` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1` VARCHAR(100) NOT NULL,
    `hid1e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid1d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2` VARCHAR(100) NOT NULL,
    `hid2e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid2d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3` VARCHAR(100) NOT NULL,
    `hid3e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid3d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4` VARCHAR(100) NOT NULL,
    `hid4e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid4d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5` VARCHAR(100) NOT NULL,
    `hid5e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid5d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid6` VARCHAR(100) NOT NULL,
    `hid6e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid6d` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid7` VARCHAR(100) NOT NULL,
    `hid7e` VARCHAR(100) DEFAULT '' NOT NULL,
    `hid7d` VARCHAR(100) DEFAULT '' NOT NULL,
    `signature` VARCHAR(100) DEFAULT '' NOT NULL,
    `remarks` VARCHAR(100) DEFAULT '' NOT NULL,
    `examination_date` DATE DEFAULT '0000-00-00' NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_intraocularpressure
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_intraocularpressure`;

CREATE TABLE `care_tz_eye_intraocularpressure`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `test3` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_lens
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_lens`;

CREATE TABLE `care_tz_eye_lens`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `right_eye_test8` VARCHAR(100),
    `right_eye_test9` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `left_eye_test8` VARCHAR(100),
    `left_eye_test9` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_optic_disc
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_optic_disc`;

CREATE TABLE `care_tz_eye_optic_disc`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_posterior_segment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_posterior_segment`;

CREATE TABLE `care_tz_eye_posterior_segment`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `right_eye_test8` VARCHAR(100),
    `right_eye_test9` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `left_eye_test8` VARCHAR(100),
    `left_eye_test9` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_pupils
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_pupils`;

CREATE TABLE `care_tz_eye_pupils`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_squint_strabismus
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_squint_strabismus`;

CREATE TABLE `care_tz_eye_squint_strabismus`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_trauma
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_trauma`;

CREATE TABLE `care_tz_eye_trauma`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `right_eye_test4` VARCHAR(100),
    `right_eye_test5` VARCHAR(100),
    `right_eye_test6` VARCHAR(100),
    `right_eye_test7` VARCHAR(100),
    `right_eye_test8` VARCHAR(100),
    `right_eye_test9` VARCHAR(100),
    `right_eye_test10` VARCHAR(100),
    `right_eye_test11` VARCHAR(100),
    `right_eye_test12` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `left_eye_test4` VARCHAR(100),
    `left_eye_test5` VARCHAR(100),
    `left_eye_test6` VARCHAR(100),
    `left_eye_test7` VARCHAR(100),
    `left_eye_test8` VARCHAR(100),
    `left_eye_test9` VARCHAR(100),
    `left_eye_test10` VARCHAR(100),
    `left_eye_test11` VARCHAR(100),
    `left_eye_test12` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_eye_visualacuity
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_eye_visualacuity`;

CREATE TABLE `care_tz_eye_visualacuity`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` INTEGER(30),
    `right_eye_test1` VARCHAR(100),
    `right_eye_test2` VARCHAR(100),
    `right_eye_test3` VARCHAR(100),
    `left_eye_test1` VARCHAR(100),
    `left_eye_test2` VARCHAR(100),
    `left_eye_test3` VARCHAR(100),
    `Signature` VARCHAR(100),
    `Examination_date` DATE,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_hospital_doctor_history
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_hospital_doctor_history`;

CREATE TABLE `care_tz_hospital_doctor_history`
(
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `doctor` VARCHAR(45) DEFAULT ' ' NOT NULL,
    `dept` int(11) unsigned DEFAULT 0 NOT NULL,
    `room` VARCHAR(450) NOT NULL,
    `attend` int(11) unsigned DEFAULT 0 NOT NULL,
    `patients` TEXT NOT NULL,
    PRIMARY KEY (`date`,`doctor`,`dept`,`room`),
    INDEX `date` (`date`),
    INDEX `doctor` (`doctor`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_hospital_rooms
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_hospital_rooms`;

CREATE TABLE `care_tz_hospital_rooms`
(
    `name` VARCHAR(20) NOT NULL,
    `notes` VARCHAR(250) NOT NULL,
    `active` int(1) unsigned NOT NULL,
    `dpt` INTEGER DEFAULT 0 NOT NULL,
    `createdby` VARCHAR(45) NOT NULL,
    `createdate` DATE DEFAULT '0000-00-00' NOT NULL,
    PRIMARY KEY (`name`,`dpt`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_hospital_rooms_conf
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_hospital_rooms_conf`;

CREATE TABLE `care_tz_hospital_rooms_conf`
(
    `name` VARCHAR(45) NOT NULL,
    `dpt` VARCHAR(45) NOT NULL,
    `users` TEXT NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    PRIMARY KEY (`name`,`dpt`,`date`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_tz_icd10_quicklist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_icd10_quicklist`;

CREATE TABLE `care_tz_icd10_quicklist`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `parent` BIGINT DEFAULT 0 NOT NULL,
    `description` VARCHAR(50),
    `diagnosis_code` VARCHAR(50),
    PRIMARY KEY (`ID`),
    INDEX `parent` (`parent`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_insurance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_insurance`;

CREATE TABLE `care_tz_insurance`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `parent` BIGINT DEFAULT 0 NOT NULL,
    `company_parent` INTEGER NOT NULL,
    `company_id` BIGINT DEFAULT 0 NOT NULL,
    `PID` BIGINT DEFAULT 0 NOT NULL,
    `ceiling` VARCHAR(255) DEFAULT '' NOT NULL,
    `ceiling_startup_subtraction` VARCHAR(20) DEFAULT '' NOT NULL,
    `plan` VARCHAR(255) DEFAULT '' NOT NULL,
    `start_date` BIGINT DEFAULT 0 NOT NULL,
    `end_date` BIGINT DEFAULT 0 NOT NULL,
    `timestamp` BIGINT NOT NULL,
    `cancel_flag` TINYINT DEFAULT 0 NOT NULL,
    `paid_flag` TINYINT DEFAULT 0 NOT NULL,
    `gets_company_credit` TINYINT DEFAULT 0 NOT NULL,
    `modify_id` VARCHAR(25) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `parent` (`parent`, `company_id`, `PID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_insurance_types
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_insurance_types`;

CREATE TABLE `care_tz_insurance_types`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `ceiling` VARCHAR(20) DEFAULT '0' NOT NULL,
    `prepaid_amount` INTEGER NOT NULL,
    `name` VARCHAR(30) DEFAULT '' NOT NULL,
    `comment` VARCHAR(255) DEFAULT '' NOT NULL,
    `is_disabled` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_insurances_admin
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_insurances_admin`;

CREATE TABLE `care_tz_insurances_admin`
(
    `insurance_ID` SMALLINT(5) NOT NULL AUTO_INCREMENT,
    `insurer` SMALLINT(5) DEFAULT -1 NOT NULL,
    `name` VARCHAR(30),
    `max_pay` INTEGER(10),
    `deleted` TINYINT(1) DEFAULT 0 NOT NULL,
    `creation` TEXT NOT NULL,
    `id_insurer_hist` TEXT,
    `name_hist` TEXT,
    `max_pay_hist` TEXT,
    `deleted_hist` TEXT,
    `contact_person` VARCHAR(60),
    `contact_person_hist` TEXT NOT NULL,
    `po_box` VARCHAR(50),
    `po_box_hist` TEXT NOT NULL,
    `city` VARCHAR(60),
    `city_hist` TEXT NOT NULL,
    `phone` VARCHAR(35),
    `phone_hist` TEXT NOT NULL,
    `email` VARCHAR(60),
    `email_hist` TEXT NOT NULL,
    PRIMARY KEY (`insurance_ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_laboratory
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_laboratory`;

CREATE TABLE `care_tz_laboratory`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `encounter_nr` BIGINT DEFAULT 0 NOT NULL,
    `care_tz_laboratory_tests_id` BIGINT DEFAULT 0 NOT NULL,
    `timestamp` BIGINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `encounter_nr` (`encounter_nr`),
    INDEX `care_tz_laboratory_tests_id` (`care_tz_laboratory_tests_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_laboratory_param
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_laboratory_param`;

CREATE TABLE `care_tz_laboratory_param`
(
    `nr` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `group_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `shortname` VARCHAR(10) NOT NULL,
    `sort_nr` TINYINT NOT NULL,
    `id` VARCHAR(50) NOT NULL,
    `msr_unit` VARCHAR(15) DEFAULT '' NOT NULL,
    `median` VARCHAR(20),
    `hi_bound` VARCHAR(20),
    `lo_bound` VARCHAR(20),
    `hi_critical` VARCHAR(20),
    `lo_critical` VARCHAR(20),
    `hi_toxic` VARCHAR(20),
    `lo_toxic` VARCHAR(20),
    `median_f` VARCHAR(20) NOT NULL,
    `hi_bound_f` VARCHAR(20) NOT NULL,
    `lo_bound_f` VARCHAR(20) NOT NULL,
    `hi_critical_f` VARCHAR(20) NOT NULL,
    `lo_critical_f` VARCHAR(20) NOT NULL,
    `hi_toxic_f` VARCHAR(20) NOT NULL,
    `lo_toxic_f` VARCHAR(20) NOT NULL,
    `median_n` VARCHAR(20) NOT NULL,
    `hi_bound_n` VARCHAR(20) NOT NULL,
    `lo_bound_n` VARCHAR(20) NOT NULL,
    `hi_critical_n` VARCHAR(20) NOT NULL,
    `lo_critical_n` VARCHAR(20) NOT NULL,
    `hi_toxic_n` VARCHAR(20) NOT NULL,
    `lo_toxic_n` VARCHAR(20) NOT NULL,
    `median_y` VARCHAR(20) NOT NULL,
    `hi_bound_y` VARCHAR(20) NOT NULL,
    `lo_bound_y` VARCHAR(20) NOT NULL,
    `hi_critical_y` VARCHAR(20) NOT NULL,
    `lo_critical_y` VARCHAR(20) NOT NULL,
    `hi_toxic_y` VARCHAR(20) NOT NULL,
    `lo_toxic_y` VARCHAR(20) NOT NULL,
    `median_c` VARCHAR(20) NOT NULL,
    `hi_bound_c` VARCHAR(20) NOT NULL,
    `lo_bound_c` VARCHAR(20) NOT NULL,
    `hi_critical_c` VARCHAR(20) NOT NULL,
    `lo_critical_c` VARCHAR(20) NOT NULL,
    `hi_toxic_c` VARCHAR(20) NOT NULL,
    `lo_toxic_c` VARCHAR(20) NOT NULL,
    `method` VARCHAR(255) NOT NULL,
    `field_type` VARCHAR(20) NOT NULL,
    `add_type` VARCHAR(255) DEFAULT '' NOT NULL,
    `add_label` VARCHAR(255) DEFAULT '' NOT NULL,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    `price` VARCHAR(255) NOT NULL,
    `price_3` VARCHAR(10) NOT NULL,
    `price_2` VARCHAR(10) NOT NULL,
    `price_1` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `nr` (`nr`),
    INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_laboratory_param_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_laboratory_param_type`;

CREATE TABLE `care_tz_laboratory_param_type`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `param_id` VARCHAR(50) NOT NULL,
    `input_value` VARCHAR(35) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_laboratory_tests
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_laboratory_tests`;

CREATE TABLE `care_tz_laboratory_tests`
(
    `id` BIGINT NOT NULL AUTO_INCREMENT,
    `parent` BIGINT DEFAULT 0 NOT NULL,
    `name` VARCHAR(255) DEFAULT '' NOT NULL,
    `is_common` TINYINT DEFAULT 0 NOT NULL,
    `is_comment_required` TINYINT DEFAULT 0 NOT NULL,
    `comment` VARCHAR(255) DEFAULT '' NOT NULL,
    `price` DOUBLE DEFAULT 0 NOT NULL,
    `is_enabled` TINYINT DEFAULT 1 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_mtuha_cat
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_mtuha_cat`;

CREATE TABLE `care_tz_mtuha_cat`
(
    `cat_ID` INTEGER(50) NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(100),
    PRIMARY KEY (`cat_ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_mtuha_cat_key
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_mtuha_cat_key`;

CREATE TABLE `care_tz_mtuha_cat_key`
(
    `cat_ID` INTEGER(50) NOT NULL,
    `icd10_key` VARCHAR(50) NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_person_insurance
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_person_insurance`;

CREATE TABLE `care_tz_person_insurance`
(
    `person_insurance_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `insurance` SMALLINT(5) NOT NULL,
    `person` int(11) unsigned NOT NULL,
    PRIMARY KEY (`person_insurance_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_pricedescription
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_pricedescription`;

CREATE TABLE `care_tz_pricedescription`
(
    `account_nr` BIGINT NOT NULL,
    `description` VARCHAR(50) NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_region
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_region`;

CREATE TABLE `care_tz_region`
(
    `region_id` INTEGER NOT NULL AUTO_INCREMENT,
    `region_code` INTEGER(10) NOT NULL,
    `region_name` VARCHAR(100) NOT NULL,
    `is_additional` TINYINT NOT NULL,
    PRIMARY KEY (`region_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_regions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_regions`;

CREATE TABLE `care_tz_regions`
(
    `CODE` VARCHAR(6) NOT NULL,
    `NAME` VARCHAR(30),
    PRIMARY KEY (`CODE`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_religion
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_religion`;

CREATE TABLE `care_tz_religion`
(
    `nr` BIGINT NOT NULL AUTO_INCREMENT,
    `code` VARCHAR(6),
    `name` VARCHAR(30),
    `is_additional` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `CODE` (`code`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_item_amount
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_item_amount`;

CREATE TABLE `care_tz_stock_item_amount`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `Drugsandservices_id` BIGINT DEFAULT 0 NOT NULL,
    `Amount` BIGINT DEFAULT 0 NOT NULL,
    `Stock_place_id` BIGINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_item_properties
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_item_properties`;

CREATE TABLE `care_tz_stock_item_properties`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `Drugsandservices_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `item_description` VARCHAR(25) DEFAULT '0' NOT NULL,
    `UnitOfIssue` VARCHAR(25) NOT NULL,
    `Alternatives` VARCHAR(255) NOT NULL,
    `Maximumlevel` BIGINT DEFAULT 0 NOT NULL,
    `Reorderlevel` BIGINT DEFAULT 0 NOT NULL,
    `Minimumlevel` BIGINT DEFAULT 0 NOT NULL,
    `Orderquantity` BIGINT DEFAULT 0 NOT NULL,
    `is_disabled` INTEGER(1) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_place
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_place`;

CREATE TABLE `care_tz_stock_place`
(
    `ID` BIGINT NOT NULL,
    `Stockname` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_supplier_lists
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_supplier_lists`;

CREATE TABLE `care_tz_stock_supplier_lists`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `Supplier_id` BIGINT NOT NULL,
    `Supplier_item_id1` VARCHAR(30) NOT NULL,
    `Supplier_item_id2` VARCHAR(30) NOT NULL,
    `Supplier_item_name` VARCHAR(100) NOT NULL,
    `Supplier_item_description` VARCHAR(255) NOT NULL,
    `Supplier_item_packsize` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_suppliers
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_suppliers`;

CREATE TABLE `care_tz_stock_suppliers`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(50) NOT NULL,
    `Comment` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_stock_transfer
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_stock_transfer`;

CREATE TABLE `care_tz_stock_transfer`
(
    `ID` BIGINT NOT NULL AUTO_INCREMENT,
    `Drugsandservices_id` BIGINT NOT NULL,
    `Amount` BIGINT NOT NULL,
    `Transfer_from` BIGINT NOT NULL,
    `Transfer_to` BIGINT NOT NULL,
    `Timestamp_started` BIGINT NOT NULL,
    `Timestamp_finished` BIGINT NOT NULL,
    `Cancel_flag` TINYINT NOT NULL,
    PRIMARY KEY (`ID`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_supplier_deatail
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_supplier_deatail`;

CREATE TABLE `care_tz_supplier_deatail`
(
    `Suplier_id` INTEGER NOT NULL AUTO_INCREMENT,
    `Company_Name` VARCHAR(50) NOT NULL,
    `Contact_Person` VARCHAR(50) NOT NULL,
    `Address1` VARCHAR(150) NOT NULL,
    `Address2` VARCHAR(150),
    `Phone1` VARCHAR(50) NOT NULL,
    `Phone2` VARCHAR(50),
    `Cell1` VARCHAR(50) NOT NULL,
    `Cell2` VARCHAR(50),
    `Email` VARCHAR(75) NOT NULL,
    `Fax` VARCHAR(75),
    `Banker` VARCHAR(50),
    `Bank_Details` VARCHAR(100),
    `Account_no` VARCHAR(50),
    `Credit_Limit` VARCHAR(50),
    `Credit_Period` VARCHAR(50),
    PRIMARY KEY (`Suplier_id`),
    INDEX `Company_Name` (`Company_Name`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_tracker
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_tracker`;

CREATE TABLE `care_tz_tracker`
(
    `tracker_ID` BIGINT NOT NULL AUTO_INCREMENT,
    `time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `module` VARCHAR(255) NOT NULL,
    `module_id` BIGINT NOT NULL,
    `refering_module` VARCHAR(255) NOT NULL,
    `refering_module_id` BIGINT NOT NULL,
    `action` VARCHAR(255) NOT NULL,
    `old_value` VARCHAR(255) NOT NULL,
    `new_value` VARCHAR(255) NOT NULL,
    `value_type` VARCHAR(255) NOT NULL,
    `parameters` VARCHAR(255) NOT NULL,
    `comment_user` VARCHAR(255) NOT NULL,
    `session_user` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`tracker_ID`),
    INDEX `time` (`time`, `session_user`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_tribes
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_tribes`;

CREATE TABLE `care_tz_tribes`
(
    `tribe_id` BIGINT NOT NULL AUTO_INCREMENT,
    `tribe_code` VARCHAR(10) DEFAULT '' NOT NULL,
    `tribe_name` VARCHAR(20) DEFAULT '' NOT NULL,
    `is_additional` TINYINT DEFAULT 0 NOT NULL,
    PRIMARY KEY (`tribe_id`),
    INDEX `tribe_id` (`tribe_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_village
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_village`;

CREATE TABLE `care_tz_village`
(
    `village_id` INTEGER NOT NULL AUTO_INCREMENT,
    `village_code` VARCHAR(10) NOT NULL,
    `village_name` VARCHAR(50) NOT NULL,
    `is_additional` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`village_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_tz_ward
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_tz_ward`;

CREATE TABLE `care_tz_ward`
(
    `ward_id` INTEGER NOT NULL AUTO_INCREMENT,
    `ward_code` INTEGER(10) NOT NULL,
    `ward_name` VARCHAR(100) NOT NULL,
    `is_additional` TINYINT NOT NULL,
    PRIMARY KEY (`ward_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_unit_measurement
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_unit_measurement`;

CREATE TABLE `care_unit_measurement`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `unit_type_nr` smallint(2) unsigned DEFAULT 0 NOT NULL,
    `id` VARCHAR(15) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `LD_var` VARCHAR(35) DEFAULT '' NOT NULL,
    `sytem` VARCHAR(35) DEFAULT '' NOT NULL,
    `use_frequency` BIGINT,
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    UNIQUE INDEX `id` (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_user_roles
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_user_roles`;

CREATE TABLE `care_user_roles`
(
    `role_id` INTEGER(2) NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(50) NOT NULL,
    `permission` LONGTEXT,
    `modify_id` VARCHAR(50) NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(50) NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`role_id`),
    INDEX `login_id` (`role_id`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- care_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_users`;

CREATE TABLE `care_users`
(
    `name` VARCHAR(60) DEFAULT '' NOT NULL,
    `login_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `password` VARCHAR(255),
    `personell_nr` int(10) unsigned DEFAULT 0 NOT NULL,
    `lockflag` tinyint(3) unsigned DEFAULT 0,
    `role_id` INTEGER(3) DEFAULT 0 NOT NULL,
    `exc` TINYINT(1) DEFAULT 0 NOT NULL,
    `s_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `s_time` TIME DEFAULT '00:00:00' NOT NULL,
    `expire_date` DATE DEFAULT '0000-00-00' NOT NULL,
    `expire_time` TIME DEFAULT '00:00:00' NOT NULL,
    `status` VARCHAR(15) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `theme_name` VARCHAR(40) NOT NULL,
    PRIMARY KEY (`login_id`),
    INDEX `login_id` (`login_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_version
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_version`;

CREATE TABLE `care_version`
(
    `name` VARCHAR(20) DEFAULT '' NOT NULL,
    `type` VARCHAR(20) DEFAULT '' NOT NULL,
    `number` VARCHAR(10) DEFAULT '' NOT NULL,
    `build` VARCHAR(5) DEFAULT '' NOT NULL,
    `date` DATE DEFAULT '0000-00-00' NOT NULL,
    `time` TIME DEFAULT '00:00:00' NOT NULL,
    `releaser` VARCHAR(30) DEFAULT '' NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- care_ward
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `care_ward`;

CREATE TABLE `care_ward`
(
    `nr` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
    `ward_id` VARCHAR(35) DEFAULT '' NOT NULL,
    `name` VARCHAR(35) DEFAULT '' NOT NULL,
    `is_temp_closed` TINYINT(1) DEFAULT 0 NOT NULL,
    `date_create` DATE DEFAULT '0000-00-00' NOT NULL,
    `date_close` DATE DEFAULT '0000-00-00' NOT NULL,
    `description` TEXT,
    `info` VARCHAR(255),
    `dept_nr` smallint(5) unsigned DEFAULT 0 NOT NULL,
    `room_nr_start` SMALLINT DEFAULT 0 NOT NULL,
    `room_nr_end` SMALLINT DEFAULT 0 NOT NULL,
    `roomprefix` VARCHAR(4),
    `status` VARCHAR(25) DEFAULT '' NOT NULL,
    `history` TEXT NOT NULL,
    `modify_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `modify_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `create_id` VARCHAR(25) DEFAULT '0' NOT NULL,
    `create_time` DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    PRIMARY KEY (`nr`),
    INDEX `ward_id` (`ward_id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- custom_care_person_add_field
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_care_person_add_field`;

CREATE TABLE `custom_care_person_add_field`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `parent` INTEGER NOT NULL,
    `sort_nr` INTEGER NOT NULL,
    `variable_name` VARCHAR(255) NOT NULL,
    `label_name` VARCHAR(255) NOT NULL,
    `is_mandatory` INTEGER NOT NULL,
    `is_visible` INTEGER NOT NULL,
    `input_type` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- custom_field_select_options
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_field_select_options`;

CREATE TABLE `custom_field_select_options`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `parent_id` INTEGER NOT NULL,
    `option_value` VARCHAR(255) NOT NULL,
    `sort_nr` INTEGER NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- custom_person_add_field_value
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `custom_person_add_field_value`;

CREATE TABLE `custom_person_add_field_value`
(
    `id` INTEGER NOT NULL AUTO_INCREMENT,
    `pid` VARCHAR(255) NOT NULL,
    `field_id` INTEGER NOT NULL,
    `value` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- his_cybow_reader
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `his_cybow_reader`;

CREATE TABLE `his_cybow_reader`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `SampleID` VARCHAR(8),
    `DateNTime` DATETIME,
    `URO` VARCHAR(30),
    `GLU` VARCHAR(30),
    `BIL` VARCHAR(30),
    `KET` VARCHAR(30),
    `SG` VARCHAR(30),
    `BLD` VARCHAR(30),
    `pH` VARCHAR(30),
    `PRO` VARCHAR(30),
    `NIT` VARCHAR(30),
    `LEU` VARCHAR(30),
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- his_ms4
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `his_ms4`;

CREATE TABLE `his_ms4`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `SampleID` VARCHAR(8),
    `DateNTime` DATETIME,
    `WBC` DECIMAL(4,2),
    `Lym` DECIMAL(3,1),
    `Mon` DECIMAL(3,1),
    `Neu` DECIMAL(3,1),
    `Eo` DECIMAL(3,1),
    `Ba` DECIMAL(3,1),
    `RBC` DECIMAL(4,2),
    `MCV` DECIMAL(4,1),
    `Hct` DECIMAL(4,1),
    `MCH` DECIMAL(4,1),
    `MCHC` DECIMAL(3,1),
    `RDW` DECIMAL(3,1),
    `Hb` DECIMAL(3,1),
    `THR` INTEGER,
    `MPV` DECIMAL(3,1),
    `Pct` DECIMAL(4,2),
    `PDW` DECIMAL(3,1),
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- his_swelab_alfa
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `his_swelab_alfa`;

CREATE TABLE `his_swelab_alfa`
(
    `ID` INTEGER NOT NULL AUTO_INCREMENT,
    `SampleID` VARCHAR(8),
    `DateNTime` DATETIME,
    `WBC` DECIMAL(3,1),
    `LYM` DECIMAL(3,1),
    `LYMPa` DECIMAL(3,1),
    `MID` DECIMAL(3,1),
    `MIDPa` DECIMAL(3,1),
    `GRA` DECIMAL(3,1),
    `GRAPa` DECIMAL(3,1),
    `HGB` DECIMAL(3,1),
    `MCH` DECIMAL(3,1),
    `MCHC` DECIMAL(3,2),
    `RBC` DECIMAL(3,2),
    `MCV` DECIMAL(4,1),
    `HCT` DECIMAL(3,1),
    `RDWa` DECIMAL(4,1),
    `RDW` DECIMAL(3,1),
    `PLT` INTEGER,
    `MPV` DECIMAL(3,1),
    `PDW` DECIMAL(4,1),
    `PCT` DECIMAL(4,2),
    `LPCR` DECIMAL(4,1),
    PRIMARY KEY (`ID`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- locations
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `locations`;

CREATE TABLE `locations`
(
    `loccode` VARCHAR(5) DEFAULT '' NOT NULL,
    `locationname` VARCHAR(50) DEFAULT '' NOT NULL,
    `deladd1` VARCHAR(40) DEFAULT '' NOT NULL,
    `deladd2` VARCHAR(40) DEFAULT '' NOT NULL,
    `deladd3` VARCHAR(40) DEFAULT '' NOT NULL,
    `deladd4` VARCHAR(40) DEFAULT '' NOT NULL,
    `deladd5` VARCHAR(20) DEFAULT '' NOT NULL,
    `deladd6` VARCHAR(15) DEFAULT '' NOT NULL,
    `tel` VARCHAR(30) DEFAULT '' NOT NULL,
    `fax` VARCHAR(30) DEFAULT '' NOT NULL,
    `email` VARCHAR(55) DEFAULT '' NOT NULL,
    `contact` VARCHAR(30) DEFAULT '' NOT NULL,
    `taxprovinceid` TINYINT DEFAULT 1 NOT NULL,
    `cashsalecustomer` VARCHAR(10) DEFAULT '' NOT NULL,
    `cashsalebranch` VARCHAR(10) DEFAULT '' NOT NULL,
    `managed` INTEGER DEFAULT 0,
    PRIMARY KEY (`loccode`),
    INDEX `taxprovinceid` (`taxprovinceid`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- sessions
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions`
(
    `SESSKEY` CHAR(32) NOT NULL,
    `EXPIRY` int(11) unsigned NOT NULL,
    `EXPIREREF` VARCHAR(64),
    `DATA` TEXT NOT NULL,
    PRIMARY KEY (`SESSKEY`)
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- tbl_who_icd10
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `tbl_who_icd10`;

CREATE TABLE `tbl_who_icd10`
(
    `Ebene` VARCHAR(255) DEFAULT '' NOT NULL,
    `Ort` VARCHAR(255) DEFAULT '' NOT NULL,
    `Art` VARCHAR(255) DEFAULT '' NOT NULL,
    `Generiert` VARCHAR(255) DEFAULT '' NOT NULL,
    `KapNr` VARCHAR(255) DEFAULT '' NOT NULL,
    `GrVon` VARCHAR(255) DEFAULT '' NOT NULL,
    `Code` VARCHAR(255) DEFAULT '' NOT NULL,
    `NormCode` VARCHAR(255) DEFAULT '' NOT NULL,
    `CodeOhnePunkt` VARCHAR(255) DEFAULT '' NOT NULL,
    `Titel` VARCHAR(255) DEFAULT '' NOT NULL,
    `MortL1` VARCHAR(255) DEFAULT '' NOT NULL,
    `MortL2` VARCHAR(255) DEFAULT '' NOT NULL,
    `MortL3` VARCHAR(255) DEFAULT '' NOT NULL,
    `MortL4` VARCHAR(255) DEFAULT '' NOT NULL,
    `MorbL` VARCHAR(255) DEFAULT '' NOT NULL
) ENGINE=MyISAM;

-- ---------------------------------------------------------------------
-- temp
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `temp`;

CREATE TABLE `temp`
(
    `prescription_nr` INTEGER(25) NOT NULL
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
