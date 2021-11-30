<?php
require_once('connection.php');
session_start();

$error=''; //Variable to Store error message;
if(isset($_POST['submit'])){
 if(empty($_POST['user']) || empty($_POST['pass'])){
 $error = "Username or Password is Invalid";
 }
 else
 {
	 $query = "SELECT * FROM admin WHERE username='" .$_POST['user']."' and password='".$_POST['pass']."'";
     $result=mysqli_query($dbcon,$query);


    	if ($result->num_rows == 0)
    {
			echo '<div style="color: red;">Invalid login.  Try again.</div>';
	}
    else {
      	$user = $result->fetch_assoc();
      $_SESSION['user']=$_POST['user'];
  		header("location:adminheader.php");
	}
 }

 }

?>
