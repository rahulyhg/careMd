<?php

require_once('./roots.php');
require_once('./colorHelper.php');
require_once $root_path.'vendor/autoload.php';
require_once $root_path.'generated-conf/config.php';

use  CareMd\CareMd\CareTzDiagnosisQuery;

$diseases = array();
$labels = array();
$diseaseData = array();
$background = array();
$colorHelper = new ColorHelper();

$diseaseCodes = CareTzDiagnosisQuery::create()
				->select(array('ICD_10_code', 'ICD_10_description'))
				->distinct()
				->find()
				->toArray();

foreach ($diseaseCodes as $code) {
	$disease = CareTzDiagnosisQuery::create()->filterByIcd10Code($code['ICD_10_code'])->count();
	array_push($diseases, 
		array(
			'name' => $code['ICD_10_description'],
			'code' => $code['ICD_10_code'],
			'total'=> $disease,
		)
	);
}

usort($diseases, function($a, $b) {
    return $b['total'] - $a['total'];
});

$count = @$_GET['count']?$_GET['count']:10;


$topDiseases = array();
if (@$diseases) {
	for ($i=0; $i < $count; $i++) { 
		if (@$diseases[$i]) {
			array_push($topDiseases, $diseases[$i]);
		}
	}
}

foreach ($topDiseases as $topDisease) {
	array_push($labels, $topDisease['name']);
	array_push($diseaseData, $topDisease['total']);
	array_push($background, $colorHelper->rand_color());
}

$data['labels'] = $labels;
$data['data'] = $diseaseData;
$data['background'] = $background;

header('Content-type: application/json');
echo json_encode( $data );

