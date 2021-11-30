
<?php
session_start();
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}
?>

<?php

  @ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
  if (mysqli_connect_error())
  {
    echo 'Error connecting to database :<br  />'.mysqli_connect_error();
    Exit;
  }

	$venue_name = $_POST['venue_name'];
  $venuecapacity = $_POST['venuecapacity'];



  $venue_query = "SELECT venue_name FROM venues WHERE venue_name  = '$venue_name'";
  $venue_results = $db->query($venue_query);

$error_message = '';

  if ($venue_results->num_rows > 0)
  {
    $error_message = 'Your venue already exits, choose another. ';
  }
  if ($error_message != '')
  {
    echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>. ';
    echo '</body></html>';
    exit;
  }

  else {
    $query  = "INSERT INTO venues VALUES (null, '".$venue_name."', '".$venuecapacity."')";
    $result = $db->query($query);
  	if ($result)
  	{
  		 echo '<p>New Venue is added!</p>';
  		 echo '<p><a href="manageVenues.php">Go back to previous page</a></p>';

  	}
    else
  	{
  		echo '<p>Erorr adding the venue. Erorr message:</p>';
  		echo '<p>'.$db->error.'</p>';
  	}

  }

?>
