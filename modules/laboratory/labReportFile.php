<?php

require_once('./roots.php');

require ($root_path . 'include/inc_environment_global.php');

require_once $root_path.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;


if(isset($_FILES)) {
    $errors= array();
	$file_name = $_FILES['resultfile']['name'];
	$file_size =$_FILES['resultfile']['size'];
	$file_tmp =$_FILES['resultfile']['tmp_name'];
	$file_type=$_FILES['resultfile']['type'];
	$file_ext=strtolower(end(explode('.', $file_name)));

	$extensions= array("xls","xlsx","csv", 'xlsm', 'xlsb', 'xltx', 'xltm', 'xlt', 'xml', 'xlam', 'xla', 'xlw', 'xlr');

	if(in_array($file_ext,$extensions)=== false){
	 $errors[]="The Selected file isn't an excel file. Please select excel file.";
	}

	if(empty($errors)==true){

		$uploadDirectory = "uploads/";
		if (!file_exists($uploadDirectory)) {
			$oldmask = umask(0);
		    mkdir($uploadDirectory, 0777, true);
		    umask($oldmask);
		}

		$filePath = $uploadDirectory.$file_name;
	 	move_uploaded_file($file_tmp, $filePath);

		$inputFileType = IOFactory::identify($filePath);;
		
		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
		$spreadsheet = $reader->load($filePath);
		
		$sheetData = $spreadsheet->getActiveSheet();
		$sheetData->getCell('A1')->setValue('');
		$rows = $sheetData->toArray();
		$values = $rows[1][0];

		$values = str_replace("", '', $values);
		$values = str_replace(PHP_EOL, ',', $values);
		$tests = explode(',', $values);

		 echo "<pre>"; print_r($_COOKIE);echo "</pre>";

		 die();
	}else{
	 print_r($errors);
	}

}



