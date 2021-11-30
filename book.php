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

	$query="SELECT b.mobilePhone, b.concert_id , c.concert_date FROM bookings as b join Concerts as c
	on b.concert_id = c.concert_id
	 where mobilePhone=$mobilePhone and concert_date > CURDATE()";

	$results= $db->query($query);
		if ($results->num_rows == 2)
		{
			echo  'Your maximum bookings reached';
			echo '<p><a href="attendeesection.php">Go back to previous</a></p>';
		}

		else {


 $query="SELECT venuecapacity from venues join concerts on venues.venue_id=concerts.venue_id
  where concerts.concert_id=$concert_id";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_array($result);


	$query = "SELECT booking_id, concert_id FROM bookings
	where bookings.concert_id=$concert_id";

	$results = $db->query($query);
	if ($results->num_rows==$row['venuecapacity'])
	{
	echo 'Sorry :( it is Fully Booked';
	echo '<p><a href="attendeesection.php">Go back to previous</a></p>';
   }
else {


$query= "SELECT * FROM attendees WHERE mobilePhone =$mobilePhone  AND (DATE_ADD(DOB, INTERVAL 18 year)
<= (SELECT concert_date FROM concerts WHERE concert_id =$concert_id ) or
(SELECT over_18 FROM concerts WHERE concert_id = $concert_id) = 'n')";
$results = $db->query($query);
if ($results->num_rows > 0)

{
	$query = "SELECT mobilePhone, concert_id FROM bookings
	 where mobilePhone=$mobilePhone and concert_id=$concert_id";

	$results = $db->query($query);
 if ($results->num_rows > 0)
{
	echo 'you are already booked this concert';
	echo '<p><a href="attendeesection.php">Go back to previous</a></p>';
}
else {


	$query = "INSERT INTO bookings VALUES (null , '".$mobilePhone."', '".$concert_id."')";
	$result = $db->query($query);
	if ($result)
	{
		 echo '<p>Booking is Done!</p>';
		 echo '<p><a href="attendeesection.php">Go back to previous</a></p>';

	}
	else
	{
		echo '<p>Erorr Making the booking. Erorr message:</p>';
		echo '<p>'.$db->error.'</p>';
	}
}

}
else {
echo 'You are not old enough to book the concert';
echo '<p><a href="attendeesection.php">Go back to previous</a></p>';
}

}
}
?>
