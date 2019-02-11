<?php
$link = mysqli_connect("uta.cloud", "sriharic_sri15", "India47$", "sriharic_pet");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_REQUEST['fname']);
 if (empty($first_name)) {
 	echo "<script> alert('FirstName is required')
 	window.location='contact.html';</script>";
 
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      echo "<script> alert('Only letters and white space allowed')
      window.location = 'contact.html';</script>" ; 
    }}

$last_name = mysqli_real_escape_string($link, $_REQUEST['lname']);
if (empty($last_name)) {
    echo "<script> alert('LastName is required')
 	window.location='contact.html';</script>";
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
            echo "<script> alert('Only letters and white space allowed')
      window.location = 'contact.html';</script>" ; 
    }
  }

$email = mysqli_real_escape_string($link, $_REQUEST['email']);
 if (empty($email)) {
    echo "<script> alert('Email is required')
 	window.location='contact.html';</script>";
  } else {
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "<script> alert('Invalid Email format')
 	window.location='contact.html';</script>"; 
    }
  }


$phone = mysqli_real_escape_string($link, $_REQUEST['phone']);
$comments = mysqli_real_escape_string($link, $_REQUEST['comments']);
 if (empty($comments)) {
    echo "<script> alert('Comments required')
 	window.location='contact.html'</script>";
 }

$sql = $link->query("INSERT INTO contact (fname,lname,email,phone,comments) VALUES ('$first_name','$last_name','$email','$phone','$comments')");
if($sql){
	echo "Records added successfully";
}
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

  
// Close connection
mysqli_close($link);
?>