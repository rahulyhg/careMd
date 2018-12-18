<?php

ini_set("memory_limit", "-1");
set_time_limit(0);
ini_set("post_max_size", "40M");
ini_set("upload_max_filesize", "40M");
ini_set("max_input_vars", "1000");

$root_path = "../";
include_once('../include/inc_environment_global.php');
global $db;



$nhifPrices = json_decode( $_POST['formdata']);


foreach ($nhifPrices as $nhifPrice) {

	if (@$nhifPrice->PackageID) {

		$ItemCode = $nhifPrice->ItemCode;
		$ItemTypeID = $nhifPrice->ItemTypeID;
		$PackageID = $nhifPrice->PackageID;
		$ItemName = $nhifPrice->ItemName;
		$Strength = $nhifPrice->Strength;
		$Dosage = $nhifPrice->Dosage;
		$UnitPrice = $nhifPrice->UnitPrice;
		$IsRestricted = $nhifPrice->IsRestricted;
		$MaximumQuantity = $nhifPrice->MaximumQuantity;

		if ($PackageID == 103) {
			$columnPrice = "unit_price_1";
		}

		if ($PackageID == 202) {
			$columnPrice = "unit_price_2";
		}

		$existSQL = "SELECT item_description FROM care_tz_drugsandservices WHERE  nhif_item_code = '$ItemCode'"; 
		$drugResult = $db->Execute($existSQL);

		if ($drugResult->RecordCount() > 0) {
			$sql = "UPDATE care_tz_drugsandservices SET $columnPrice = '$UnitPrice', is_restricted = '$IsRestricted', maximum_quantity = '$MaximumQuantity' WHERE  nhif_item_code = '$ItemCode'";
			$db->Execute($sql);
		}else{

			$sql = "INSERT INTO care_tz_drugsandservices (item_description, item_full_description,  $columnPrice, nhif_item_code, is_restricted, maximum_quantity)
						VALUES ('$ItemName', '$ItemName', '$UnitPrice', $ItemCode, $IsRestricted, $MaximumQuantity)";
			$db->Execute($sql);
		}
		
	}

}

$data['success'] = 1;

header('Content-type: application/json');
echo json_encode( $data );

