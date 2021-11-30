<!DOCTYPE html>
<html>
<h2><strong>Welcome to Free-Gigs, the Free Concert Website!</strong></h2>
<?php


session_start();

//If the "uname" session variable is set and not empty, redirect to menu page
if ( isset($_SESSION['mobilePhone']) && $_SESSION['mobilePhone'] != '' )
{
	header('Location: attendeesection.php');
	exit;
}

//If form has been submitted, check login credentials
if ( isset($_POST['mobilePhone']) )
{

	@ $db = new mysqli('localhost', 'root', '','concertbookings');
	if (mysqli_connect_errno())
	{
		echo 'Could not conenct the database - Please try again later';
		exit;
	}

	$query = "SELECT * FROM attendees WHERE  mobilePhone='".$_POST['mobilePhone']."' AND password='".$_POST['password']."'";

	$results = $db->query($query);

	if ($results->num_rows == 0)
	{
		echo '<div style="color: red;">Invalid login.  Try again.</div>';
	}
	else
	{
		//Log the user in
		$user = $results->fetch_assoc();

		//Set session variables then redirect to menu page
		$_SESSION['mobilePhone'] = $user['mobilePhone'];
		$_SESSION['firstname'] = $user['firstname'];
		$_SESSION['surname'] = $user['surname'];
		$_SESSION['level'] = $user['level'];
		header('Location: attendeesection.php');
		exit;
	}
}


               $link = mysqli_connect("localhost", "root", "", "concertbookings");
                  // Check connection
                  if($link === false){
                      die("ERROR: Could not connect. " . mysqli_connect_error());
                  }


                  $query = "SELECT concert_date,band_name, venue_name
                  FROM concerts as c join bands as b on c.band_id = b.band_id join venues as v on c.venue_id = v.venue_id
                  WHERE concert_date > CURDATE() ORDER BY concert_date ";



                  if($result = mysqli_query($link, $query)){
                      if(mysqli_num_rows($result) > 0){
                      echo "<tr><h1>Upcoming Concerts:</h1></tr>";

                              while($row = mysqli_fetch_array($result)){

                                  echo "<tr>";


                                      echo "<li><a>" . $row['concert_date'] . "\n";
                                      echo "<td>" . $row['band_name'] . "\n";
                                      echo "<td> is playing at \n";
                                      echo "<td>" . $row['venue_name'] . "<br />\n";

                                  echo "</tr>";

                              }

                          mysqli_free_result($result);
                      } else{
                          echo "No records matching your query were found.";
                      }
                  } else{
                      echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                  }

                  // Close connection
                  mysqli_close($link);


 ?>
 <br>
 <tr>
	 <td colspan="2"><strong>You cannot book tickets unless you are logged in.</strong></td>
 </tr>
 </br>
 <br>
 <form method="post" action="LoginUser.php">
   mobilePhone: <input type="text" name="mobilePhone" /><br />
   Password: <input type="password" name="password" /><br />
   <input type="submit" value="Log In" />
 </form>
</br>
<head>
  <script language="JaveScript"  type="text/javascript">
  function ValidateForm ()
    {
      // Create a variable to refer to the form
      var form = document.userlogin;

     if (form.mobilePhone.value == '') {
       alert('Mobile phone is empty.');
       return false;

    }
   if (form.password.value.length < 8) {
     alert('Password must be at least 8 characters long.');
     return false;
   }

      return true;
    }

  </script>

  <style>
  aside {
    width: 50%;
    padding-left: 15px;
    margin-left: 15px;
    float: right;
    font-style: italic;
  }
</style>
<body>

       <title>Login User</title>
       <link rel="stylesheet" href="master.css">
     </head>
<main>



<form name="userlogin" method="post" action="LoginUserDisplay.php" onsubmit="return ValidateForm();">
  <table style="width: 500px; border: 0px;" cellspacing="1" cellpadding="1">


    <tr>
      <td>
				<div align="lift"></div> <a href="updatepassword.php">Forgot Password</div></td>
        <div align="middle"> click <a href="registerationForm.php">here</a></li> to register </div></td>
          <div align="lift"></div> <a href="login.php">Admin log in</div></td>
    </tr>
    <title>HTML Backgorund Color</title>
   </head>
   <body style="background-color:#dce6f2;">

  </main>

</form>
</body>
</html>
