<?php
session_start(); 
// Is the admin logged in? 
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}
?>


<?php
include ("connection.php");
error_reporting(0);

$band=$_GET['del_id'];
$query = "SELECT band_name FROM concerts INNER JOIN bands ON (bands.band_id = concerts.band_id) WHERE concerts.band_id ='".$band."' ";

$results =$dbcon->query($query);

if ($results->num_rows >=1) {
	echo '<p> 
	band already exists</p>';


}
else {
	$query = "DELETE FROM bands WHERE band_id = '$band' ";
    $results =$dbcon->query($query);
	header ('Location: manageband.php');
}

?> 