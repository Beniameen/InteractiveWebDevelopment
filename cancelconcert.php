<?php
session_start();
// Is the admin logged in?
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}

$concert_id=$_GET['concert_id'];

@ $db = new mysqli('localhost', 'root', '','concertbookings');
if (mysqli_connect_errno())
{
  echo 'Could not conenct the database - Please try again later';
  exit;
}



 $query = "SELECT concert_date,band_name, venue_name, concert_id
                   FROM concerts as c join bands as b on c.band_id = b.band_id join venues as v on c.venue_id = v.venue_id
                   WHERE concert_id = $concert_id ";

                    $result = mysqli_query($db, $query);
                    $row = mysqli_fetch_array($result);
 																$date =$row['concert_date'];
 																$venuename= $row['venue_name'];
 																$bandname=$row['band_name'];

 $query =" UPDATE attendees
 SET cancelmessage = CONCAT(cancelmessage, '(We regret to inform you that the $date concert featuring $bandname at $venuename has been cancelled.)<br>')
       WHERE mobilePhone IN (SELECT mobilePhone
                    FROM bookings
                    WHERE concert_id = $concert_id)";
                      $results = $db->query($query);

		 $query = "DELETE from concerts
		  where  concert_id=$concert_id  ";
		  $results = $db->query($query);
		  if ($results)
		  {
		     echo '<p>concert is Cancelled!</p>';

		  }
 $query = "DELETE from bookings
  where  concert_id=$concert_id  ";
  $results = $db->query($query);
  if ($results)
  {
     header('Location: manageConcert.php');
}






?>
