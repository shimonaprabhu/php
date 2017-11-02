<?php
require_once 'core/init.php';

$full_name=sanitize($_POST['fullname']);
$email=sanitize($_POST['emailid']);
echo $full_name;
echo $email;
/*
$db->query("INSERT INTO contacts(fullname,emailid) VALUES ('$full_name','$email')");*/




$db->query("CREATE PROCEDURE insertcontacts(full_name text, email text)
BEGIN
INSERT INTO contacts(fullname,emailid) values(full_name,email);
END;");

$result = mysqli_query($db,"CALL insertcontacts('$full_name','$email')");


header('Location:project.php');


?>


