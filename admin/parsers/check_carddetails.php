<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/E-Commerce/core/init.php';
$name=sanitize($_POST['name']);
$number=sanitize($_POST['number']);
$cvc=sanitize($_POST['cvc']);
$exp_month=sanitize($_POST['exp-month']);
$exp_year=sanitize($_POST['exp-year']);

$errors=array();
$required=array(
'name'=>'Name',
'number'=>'Credit Card Number',
'cvc'=>'CVC',
'exp-month'=>'Expiry Month',
'exp-year'=>'Expiry Year',

);

//check if all required fields are filled out
foreach ($required as $f => $d) {
	if (empty($_POST[$f])||$_POST[$f]=='') {
		$errors[]=$d.' is required';
	}
}
if(strlen($cvc)!=3&& !is_numeric($cvc)){
	$errors[]='CVC must be a 3 digit number';
}
if (!empty($errors)) {
	echo display_errors($errors);
}else{
	echo 'passed';
}
?>
