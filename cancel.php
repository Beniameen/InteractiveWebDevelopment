<?php
session_start();
if ( !isset($_SESSION['mobilePhone']) || $_SESSION['mobilePhone'] == '' )
{
	header('Location: LoginUser.php');
	exit;
}
$mobilePhone = $_SESSION['mobilePhone'];

$concert_id=$_GET['concert_id'];

@ $db = new mysqli('localhost', 'root', '','concertbookings');
if (mysqli_connect_errno())
{
  echo 'Could not conenct the database - Please try again later';
  exit;
}



$query = "DELETE from bookings
 where  concert_id=$concert_id and mobilePhone = $mobilePhone ";
 $results = $db->query($query);
 if ($results)
 {
    echo '<p>Booking is Cancelled!</p>';
    header('Location: attendeesection.php');

 }
?>
