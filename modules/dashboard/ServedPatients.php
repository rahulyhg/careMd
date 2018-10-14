<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 300);
require_once('./roots.php');
require_once('./colorHelper.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

$period = @$_GET['period']?$_GET['period']:"ThisYear";


use  CareMd\CareMd\CareEncounterQuery;
use  CareMd\CareMd\CareEncounterEventSignallerQuery;

$year = date('Y');
$months = array(
	'01' => 'Jan', 
	'02' => 'Feb',
	'03' => 'Mar',
	'04' => 'Apr',
	'05' => 'May', 
	'06' => 'Jun', 
	'07' => 'Jul', 
	'08' => 'Aug',
	'09' => 'Sep',
	'10' => 'Oct', 
	'11' => 'Nov',
	'12' => 'Dec'
);

if ($period == "ThisYear") {
	$data['labels'] = array_values($months);	
}


$legendNames = array();
$patientsStatus = array();
$servedPatients = array();
$unservedPatients = array();

$colorHelper = new ColorHelper();


if ($period == "ThisYear") {
	foreach ($months as $keyMonth => $month) {
		$minDate = $year."-".$keyMonth.'-01';
		$maxDate = $year."-".$keyMonth.'-31';
		$patients = CareEncounterQuery::create()
		->filterByEncounterDate(array("min" => $minDate." 00:00:00", "max" => $maxDate." 23:59:59"))
		->orderBy('CareEncounter.EncounterDate', 'desc')
		->limit(10000)
		->find()
		->toArray();

		$patientsNumbers = array();
		foreach ($patients as $patient) {
			array_push($patientsNumbers, $patient['EncounterNr']);
		}
		$totalServedPatients = CareEncounterEventSignallerQuery::create()
		->filterByEncounterNr($patientsNumbers)
		->find()
		->count();
		$totalPatients = count($patients);
		$totalUnservedPatients = $totalPatients - $totalServedPatients;

		array_push($servedPatients, $totalServedPatients);
		array_push($unservedPatients, $totalUnservedPatients);
	}	
}


$data['datasets'] = array(
	array(
		'label' => 'Served Patients',
		'backgroundColor' => $colorHelper->rand_color(),
		'data' => $servedPatients,
	),
	array(
		'label' => 'Unserved Patients',
		'backgroundColor' => $colorHelper->rand_color(),
		'data' => $unservedPatients
	)
);


header('Content-type: application/json');
echo json_encode( $data );


