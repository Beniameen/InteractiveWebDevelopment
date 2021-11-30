<html>
<body>
      <table width = "100%" border = "0">

         <tr>
            <td  bgcolor = "#dce6f2">
               <h1><center>Welcome to Free-Gigs, the Free Concert Website!</center></h1>
            </td>
         </tr>
         <tr valign = "top">
		 <td bgcolor = "#dce6f2" width = "50">

<?php

$link = mysqli_connect("localhost", "root", "", "concertbookings");
   // Check connection
   if($link === false){
       die("ERROR: Could not connect. " . mysqli_connect_error());
   }

//Start or resume a session
session_start();

if ( !isset($_SESSION['user']) || $_SESSION['user'] == '' )
{
	header('Location: login.php');
	exit;
}

echo '<p>You are logged as, '.$_SESSION['user'].' </p>'.'<br>';


?>


         <tr valign = "top">
            <td bgcolor = "#dce6f2" width = "100">
               <b><h2>Admin</h2></b></br>

	<ul>
	    <li>
          <a href="manageband.php">Manage Band</a>
        </li>
		<br>
        <li>
          <a href="manageVenues.php">Manage Vanues</a>
        </li>
		<br>
        <li>
          <a href="manageConcert.php">Manage Concert</a>
        </li>
		<br>
        <li>
          <a href="logout.php">Log Out</a>
        </li>
      </ul>
	        </td>

		</td>
	</tr>

         </tr>

      </table>


   </body>

</html>
