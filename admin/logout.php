<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/E-Commerce/core/init.php';
	unset($_SESSION['SBUser']);
	header('Location:login.php')
	?>