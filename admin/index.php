<?php
	require_once '../core/init.php';
	if (!is_logged_in()) {
		header('Location:login.php');
	}
	include 'includes/head.php';
	include 'includes/navigation.php';

?>
Welcome to the admin page!


<?php include 'includes/footer.php';?>
	