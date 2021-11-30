<?php


@ $db = new mysqli('localhost', 'root', '','concertbookings');
if (mysqli_connect_errno())
{
  echo 'Could not conenct the database - Please try again later';
  exit;
}
?>
<html>
<head>
   <title>change password form</title>

   <script language="JaveScript"  type="text/javascript">
   function ValidateForm ()
     {
       // Create a variable to refer to the form
       var form = document.changepasswordform;
       var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;
       if (form.mobilePhone.value == '') {
         alert('mobilePhone is empty.');
         return false;
       }

      if (form.password.value == '') {
        alert('password is empty.');
        return false;
      }
      if (form.confirmPassword.value == '') {
        alert('confirm password is empty.');
        return false;

    }

    if (form.password.value.length < 8) {
      alert('Password must be at least 8 characters long.');
      return false;
    }
    if (form.password.value != form.confirmPassword.value) {
      alert('Password does not match confirmation.');
      return false;
    }
       return true;
     }

   </script>
   </head>
<body>
  <form action="updatepassword.php?" method="POST">
  <tr>
    <td>Mobile</td>
    <td>
      <input name="mobilePhone" type="text" style="width: 150px;" maxlength="15" /></td>
  </tr>
<tr>
<td>New Password</td>
<td>
  <input name="password" type="password" style="width: 200px;" maxlength="20" />*</td>
</tr>
<td>Confirm Password</td>
<td>
  <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20" />*</td>
</tr>
<td>
<td><input type="submit" id="button" name="submit" value="Change Password"><td>
</tr>
</form>
</body>
</html>

<?php

if(!empty($_POST))
{
 $confirmPassword = $_POST['confirmPassword'];
	$password = $_POST['password'];
  $mobilePhone= $_POST['mobilePhone'];

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
  elseif (strlen($password)  != strlen($confirmPassword) )
  {
      $error_message = 'your password dont match.';
  }
  if ($error_message != '')
  {
    echo 'Error: '.$error_message.'Please enter value</a>. ';
    echo '</body></html>';
    exit;
  }
  else
  {



$query = "UPDATE attendees SET password= $password WHERE mobilePhone = $mobilePhone";
$results =$db->query($query);

if($results)
{
	echo 'Password updated';
  echo '<p><a href="LoginUser.php">Press here to go to the main page</a></p>';
}
else
{
	echo "Not updated";
}
}
  }
?>
