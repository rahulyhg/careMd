<?php

require_once('./roots.php');
require_once '../vendor/autoload.php';
require_once '../generated-conf/config.php';

use  CareMd\CareMd\CareConfigGlobalQuery;


$timeOut = CareConfigGlobalQuery::create()->filterByType('timeout_time')->select('value')->findOne();

$data['timeout'] = (int)$timeOut*1000;

$data['loginUrl'] = $root_path . "main/login.php";


header('Content-type: application/json');
echo json_encode( $data );
