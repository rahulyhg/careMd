<?php

require_once('./roots.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CareEncounterQuery;

$encounterNr = $_GET['encounterNr'];
$patient = CareEncounterQuery::create()->findOneByEncounterNr($encounterNr);
$patient->setIsDischarged(0);
$patient->setDischargeDate("");
$patient->setDischargeTime("");
// $patient->setStatus("");
$patient->save();

$data['updated'] = 1;
header('Content-type: application/json');
echo json_encode( $data );


 ?>