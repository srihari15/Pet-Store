<?php
	require("PHPMailer-master/src/PHPMailer.php");
  require("PHPMailer-master/src/SMTP.php");
    require("PHPMailer-master/src/Exception.php");


    $mail = new PHPMailer\PHPMailer\PHPMailer();

/*$mail = new PHPMailer(true);*/
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("uta.cloud", "sriharic_sri15", "India47$", "sriharic_pet");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$first_name = mysqli_real_escape_string($link, $_REQUEST['fname']);
  if (empty($first_name)) {
    echo "<script> alert('FirstName is required')
    window.location='client.html';</script>";
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$first_name)) {
      echo "<script> alert('Only letters and white space allowed')
      window.location = 'client.html';</script>" ;  
    }}
  

$last_name = mysqli_real_escape_string($link, $_REQUEST['lname']);
if (empty($last_name)) {
    echo "<script> alert('LastName is required')
    window.location='client.html';</script>";
  } else {
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$last_name)) {
      echo "<script> alert('Only letters and white space allowed')
      window.location = 'client.html';</script>" ;  
    }
  }

$email = mysqli_real_escape_string($link, $_REQUEST['email']);
  if (empty($email)) {
        echo "<script> alert('Email is required')
    window.location='client.html'</script>";
  } else {
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script> alert('Invalid Email format')
    window.location='client.html'</script>";  
    }
  }

 
// Attempt insert query execution
$sql =  $link->query("INSERT INTO user (email,password,roleid) VALUES ('$email',1234567,2)");
if($sql){
$sql2 = $link->query("Select userid from user where email='$email'");
$row= mysqli_fetch_assoc($sql2);
$userid = $row['userid'];
$sql1 = $link->query("INSERT INTO client (fname,lname,email,phone,userid) VALUES ('$first_name','$last_name','$email',100,'$userid')");
}
if($sql1){
    echo "Records added successfully.";

    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'sriharichandramouli.uta.edu';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'srihari@sriharichandramouli.uta.edu';                 // SMTP username
    $mail->Password = 'India47$';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('srihari@sriharichandramouli.uta.edu', 'Srihari');
    $mail->addAddress($email, $first_name);     // Add a recipient
   


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Login Details';
    $mail->Body    = 'Password is <b>1234567</b>';
    if($mail->send()){
    	echo 'Message has been sent';
    }
 	else {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
} 
else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

  
// Close connection
mysqli_close($link);
?>