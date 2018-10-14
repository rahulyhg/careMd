<?php

require_once('./roots.php');
require_once('./colorHelper.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CarePersonQuery;
use  CareMd\CareMd\CareTzInsuranceQuery;
use  CareMd\CareMd\CareTzCompanyQuery;

$activeProviders = array();
$activePatientProviders = array();
$providers = CareTzCompanyQuery::create()->find()->toArray();
$startDate = time();
$num = 1;

$period = @$_GET['period']?$_GET['period']:"ThisYear";

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


foreach ($providers as $key => $provider) {

	$activeCompany = CareTzInsuranceQuery::create()
	->where('CareTzInsurance.company_id =?', $provider['Id'])
	->orderBy('CareTzInsurance.Id', 'desc')
	->findONe();

	if (@$activeCompany && $activeCompany->getEndDate() >= $startDate) {
		array_push($activeProviders, $provider);		
	}
}

$series = array();
$legendNames = array();

$colorHelper = new ColorHelper();

foreach ($activeProviders as $activeProvider) {
	$row = array();
	if($period == "ThisYear"){
		foreach ($months as $keyMonth => $month) {
			$minDate = $year."-".$keyMonth.'-01';
			$maxDate = $year."-".$keyMonth.'-31';
			$totalPatients = CarePersonQuery::create()
			->filterByCreateTime(array("min" => $minDate." 00:00:00", "max" => $maxDate." 23:59:59"))
			->filterByInsuranceId($activeProvider['Id'])
			->orderBy('CarePerson.CreateTime', 'desc')
			->limit(2500)
			->find()
			->count();

			array_push($row, $totalPatients);
		}
	}
	$numPatient = 0;
	foreach ($row as $value) {
		$numPatient += $value;
	}
	if ($numPatient > 0) {
		$preparedData = array(
			'label' =>$activeProvider['Name'],
			'fill' => false,
			'backgroundColor' => $colorHelper->rand_color(),
			'borderColor' => $colorHelper->rand_color(),
			'data'=>$row
		);

		array_push($series, $preparedData);
	}
}
$data['series'] = $series;

header('Content-type: application/json');
echo json_encode( $data );


