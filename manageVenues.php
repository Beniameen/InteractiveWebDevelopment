<?php
session_start();
// Is the admin logged in?
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}
?>
<!DOCTYPE html>
<html>

   <head>
      <title>manage venues</title>
      <script language="JaveScript"  type="text/javascript">
      function ValidateForm ()
        {
          var form = document.managevenueform;
          var regex = /(((0|1)[0-9]|2[0-9]|3[0-1])\/(0[1-9]|1[0-2])\/((19|20)\d\d))$/;
          if (form.venue_name.value == '') {
            alert('venue name is empty.');
            return false;
          }

         if (form.venuecapacity.value == '') {
           alert('venue capacity is empty.');
           return false;
         }

          return true;
        }

      </script>
   </head>

   <body>
      <table width = "100%" border = "0">

         <tr>
            <td colspan = "2" bgcolor = "#dce6f2">
               <h1><center>Welcome to Free-Gigs, the Free Concert Website!</center></h1>
            </td>
         </tr>
         <tr valign = "top">
            <td bgcolor = "#dce6f2" width = "50">
               <b>Admin</b></br>
			   <br>
			   <b>Manage Venues</b>
			   <br />
			   <br />
			   <br />

	<ul>
        <li>
          <a href="manageband.php"  >Manage band</a>
        </li>
		<li>
          <a href="adminheader.php"  >Admin Header</a>
        </li>
        <li>
          <a href="manageconcert.php">Manage Concert</a>
        </li>
        <li>
          <a href="logout.php">Log Out</a>
        </li>
      </ul>
            </td>

            <td bgcolor = "#dce6f2" width = "100" height = "200">

    <?php


      @ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
      if (mysqli_connect_error())
      {
        echo 'Error connecting to database :<br  />'.mysqli_connect_error();
        Exit;
      }

    $query = "SELECT DISTINCT venues.venue_name, venues.venue_id, venues.venuecapacity FROM concerts INNER JOIN  venues ON (concerts.venue_id = venues.venue_id)";


    $results = $db->query($query);




    echo "<table><tr><th>Venue name</th><th>Manage&nbsp;&nbsp;&nbsp;</th><th>&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Venue Capacity</th></tr>";

  	foreach($results as $row)

    {
echo '<tr>


  	  <td>'.$row['venue_name'].'</td>
      <td><a href="EditVenue.php?edit_id='.$row['venue_id'].'&venue_name='.$row['venue_name'].'&venuecapacity='.$row['venuecapacity'].' ">Edit</a></td>
      <td><a>Cannot delete</a></td>
      <td>'.$row['venuecapacity'].'</td>

</tr>';
    }





    $con = "SELECT venues.venue_name, venues.venue_id, venues.venuecapacity FROM venues WHERE NOT EXISTS (SELECT venue_id FROM concerts WHERE concerts.venue_id = venues.venue_id)";
    $result = $db->query($con);
    foreach($result as $row)


    {
      echo '<tr>

  	 <td>'.$row['venue_name'].'</td>
     <td><a href="EditVenue.php?edit_id='.$row['venue_id'].'&venue_name='.$row['venue_name'].'&venuecapacity='.$row['venuecapacity'].'">Edit</a></td>
  	 <td><a href="DeleteVenue.php?del_id='.$row['venue_id'].'"
  	  onclick="return confirm(\'Do you want to delete the venue?\');">Delete</a> </td>
      <td>'.$row['venuecapacity'].'</td>
</tr>';
    }

 ?>
    <p>
      <h2>Add New Venue:</h2>

      <form name="managevenueform" method="post" action="addvenue.php"  onsubmit="return ValidateForm();">
   <form method="post" action="">
	<input type="hidden" name="submitted" value="true" />
	<fieldset>

		<label>Name:<input type="text" name="venue_name" /></label>
    <label>capacity:<input type="number" min= 5  name="venuecapacity" /></label>
	</fieldset>
	<br />
	<input type="submit" value="Add Venue" />
	</form>

         <tr>
            <td colspan = "2" bgcolor = "#dce6f2">
               <center>

               </center>
            </td>
         </tr>

      </table>
   </body>

</html>
