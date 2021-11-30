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

$venue=$_GET['del_id'];
$query = "SELECT venue_name FROM concerts INNER JOIN venues ON (venues.venue_id = concerts.venue_id) WHERE concerts.venue_id ='".$venue."' ";

$results =$dbcon->query($query);

if ($results->num_rows >=1) {
	echo '<p> 
	venue already exists</p>';


}
else {
	$query = "DELETE FROM venues WHERE venue_id = '$venue' ";
    $results =$dbcon->query($query);
	header ('Location: manageVenues.php');
}
?> 