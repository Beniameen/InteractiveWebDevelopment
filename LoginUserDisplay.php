<!DOCTYPE html>
<html>
<head>
  <title>Login User Display</title>
</head>

<body>
<?php
session_start();
if ( !isset($_SESSION['mobilePhone']) || $_SESSION['mobilePhone'] == '' )
{
	header('Location: LoginUser.php');
	exit;
}
@ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
if (mysqli_connect_error())
{
  echo 'Error connecting to database :<br  />'.mysqli_connect_error();
  Exit;
}
	//create short variable names from the data received from the form
	$mobilePhone = $_POST['mobilePhone'];
	$password = $_POST['password'];


  $error_message = '';

   if (empty($mobilePhone) ||  empty($password) )
  {
      $error_message = 'one of the required values was blank.';
  }
  elseif (!is_numeric ($mobilePhone))
  {
    $error_message = 'your home phone number is not numeric.';
  }
  elseif (strlen($password) < 8)
  {
      $error_message = 'your password is not long enough.';
  }

  $mobile_query = "SELECT mobilephone FROM attendees WHERE mobilephone = '".$mobilePhone."'";
  $mobile_results = $db->query($mobile_query);


  if ($error_message != '')
  {
    echo 'Error: '.$error_message.' <a href="javascript: history.back();">Go Back</a>. ';
    echo '</body></html>';
    exit;
  }
  else
  {
    echo '<p><strong>loged in successfully!</strong></p>';
  }
?>



  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
    <tr>
      <td colspan="2"><strong>Login User</strong></td>
    </tr>
      <td>Mobile</td>
      <td>
        <?php echo $mobilePhone; ?></td>
    </tr>
      <td>Password</td>
      <td>
        <?php echo $password; ?></td>
    </tr>
    <tr style="background-color: #FFFFFF;">

    </tr>
  </table>
</body>
</html>
