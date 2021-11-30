<!DOCTYPE html>
<html>
<head>
  <title>User Registration Form</title>
</head>

<body>

<?php

   @ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
   if (mysqli_connect_error())
   {
     echo 'Error connecting to database :<br  />'.mysqli_connect_error();
     Exit;
   }
	//create short variable names from the data received from the form
	$firstname = $_POST['firstname'];
	$surname = $_POST['surname'];
	$DOB = $_POST['DOB'];
	$mobilePhone = $_POST['mobilePhone'];
	$password = $_POST['password'];
	$confirmPassword = $_POST['confirmPassword'];





  $error_message = '';

  if (empty($firstname) || empty($surname) || empty($mobilePhone) || empty($DOB) ||
    empty($password) || empty($confirmPassword))
  {
      $error_message = 'one of the required values was blank.';
  }

  elseif (!is_numeric ($mobilePhone))
  {
    $error_message = 'your mobilePhone phone number is not numeric.';
  }
  elseif (strlen($password) < 8)
  {
      $error_message = 'your password is not long enough.';
  }
   elseif ($password != $confirmPassword)
  {
      $error_message = 'your password do not match.';
  }

  $mobile_query = "SELECT MobilePhone FROM attendees WHERE MobilePhone = '".$mobilePhone."'";
  $mobile_results = $db->query($mobile_query);

  if ($mobile_results->num_rows > 0)
  {
    $error_message = 'Your mobile phone already exits, choose another. ';
  }

  if ($error_message != '')
  {
    echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>. ';
    echo '</body></html>';
    exit;
  }
  else
  {
    $query = "INSERT INTO attendees VALUES ('".$mobilePhone."', '".$firstname."', '".$DOB."', '".$surname."', '".$password."' , '')";
    $result = $db->query($query);
    if ($result)
    {
       echo '<p>User details inserted into database!</p>';

    }
    else
    {
      echo '<p>Erorr inserting details. Erorr message:</p>';
      echo '<p>'.$db->error.'</p>';
    }
  }
?>
<a href="loginUser.php">Back to Login Page</a>

<h2><strong>Registration Form</strong></h2>
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr style="background-color: #FFFFFF;">
      <td>First Name</td>
      <td>
        <?php echo $firstname; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;">
      <td>Surname</td>
      <td>
        <?php echo $surname; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;">
    <tr style="background-color: #FFFFFF;">
      <td>D.O.B.</td>
      <td>
        <?php echo $DOB; ?></td>
    </tr>
      <td>mobilePhone</td>
      <td>
        <?php echo $mobilePhone; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;">
    <tr style="background-color: #FFFFFF;">
      <td>Password</td>
      <td>
        <?php echo $password; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;">
      <td>Confirm Password</td>
      <td>
        <?php echo $confirmPassword; ?></td>

    </tr>
  </table>
</body>
</html>
