<?php

require_once('./roots.php');
require_once '../vendor/autoload.php';
require_once './config.php';

use  CareMd\CareMd\CareConfigGlobalQuery;


$timeOut = CareConfigGlobalQuery::create()->filterByType('timeout_time')->select('value')->findOne();

$hours =  (int)substr($timeOut, 0, 2) * 60 *60;
$minutes = (int)substr($timeOut, 2, 2) * 60;
$seconds = (int)substr($timeOut, 4, 4);

$totalSeconds = $hours + $minutes + $seconds;
$data['timeout'] = $totalSeconds * 1000;

$data['loginUrl'] = $root_path . "main/login.php";


header('Content-type: application/json');
echo json_encode( $data );
