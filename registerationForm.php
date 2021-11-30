<!DOCTYPE html>
<html>
<?php

@ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
if (mysqli_connect_error())
{
  echo 'Error connecting to database :<br  />'.mysqli_connect_error();
  Exit;
}

 ?>
<head>
  <title>User Registration Form</title>
  <script language="JaveScript"  type="text/javascript">
  function ValidateForm ()
    {
      // Create a variable to refer to the form
      var form = document.Registerationform;
      var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;
      if (form.firstname.value == '') {
        alert('firstname is empty.');
        return false;
      }

     if (form.surname.value == '') {
       alert('surrname is empty.');
       return false;
     }
     if (form.mobilePhone.value == '') {
       alert('Mobile phone is empty.');
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
<h2><strong>Registeration Form</strong></h2>
<form name="Registerationform" method="post" action="registerationUserDisplay.php"  onsubmit="return ValidateForm();">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">
      <td>First Name</td>
      <td>

        <input name="firstname" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>
      <td>Surname</td>
      <td>
        <input name="surname" type="text" style="width: 200px;" maxlength="100" />*</td>
    </tr>

        <td>Date Of Birth(YYYY-MM-DD)</td>
        <td>

          <input type='date'  name='DOB' placeholder='YYYY-MM-DD' required pattern="\d{4}-\d{2}-\d{2}" >
         <span class="validity"></span>
      </tr>


    <tr>
      <td>Mobile</td>
      <td>
        <input name="mobilePhone" type="text" style="width: 150px;" maxlength="15" /></td>
    </tr>
      <td>Password</td>
      <td>
        <input name="password" type="password" style="width: 200px;" maxlength="20" />*</td>
    </tr>
      <td>Confirm Password</td>
      <td>
        <input name="confirmPassword" type="password" style="width: 200px;" maxlength="20" />*</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
      <td>
        <input type="reset" name="reset" value="Reset" />
		<input type="submit" name="submit" value="Submit" /></td>
      <td>
        <div align="right">* indicates required field</div></td>
    </tr>
    <title>HTML Backgorund Color</title>
   </head>
   <body style="background-color:#dce6f2;">
  </table>
</form>
</body>
</html>
