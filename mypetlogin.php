<?php
$link = mysqli_connect("uta.cloud", "sriharic_sri15", "India47$", "sriharic_pet");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
 if (empty($email)) {
    echo "<script> alert('Email is required')
    window.location='login.html';</script>";
  } else {
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script> alert('Invalid Email format')
 	window.location='login.html';</script>";  
    }
  }


$password = mysqli_real_escape_string($link, $_REQUEST['password']);

$sql = $link->query("Select roleid from user where email='$email' and password = '$password'");
$row= mysqli_fetch_assoc($sql);
$roleid = $row['roleid'];
if (isset($sql)){
	if ($roleid == 1)
	{
	header('Location: loginbusiness.html' );
	} 
	else{
	header('Location: loginclient.html');	
	}
}
