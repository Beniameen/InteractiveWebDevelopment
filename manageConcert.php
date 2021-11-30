<?php

session_start();
// Is the admin logged in?
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}

@ $db = new mysqli ('localhost', 'root', '', 'concertbookings');
if (mysqli_connect_error())
{
  echo 'Error connecting to database :<br  />'.mysqli_connect_error();
  Exit;
}


?>


<!DOCTYPE html>
<html>

   <head>
     <title>add concert Form</title>
     <script language="JaveScript"  type="text/javascript">
     function ValidateForm()
       {
         // Create a variable to refer to the form
         var form = document.addconcertform;

         if (new Date(form.concert_date.value) < new Date()) {
           alert('Date is in the past.');
           return false;
         }
         return true;
         }
         </script>
      <form name="addconcertform" method="post" action="addconcertvalidate.php"  onsubmit="return ValidateForm();">

   <body>


         <tr>

               <h1><center>Welcome to Free-Gigs, the Free Concert Website!</center></h1>
            </td>
         </tr>
         <tr valign = "top">

               <b>Admin</b></br>
			   <br>
			   <br />


	<ul>

        <li>
          <a href="manageband.php">Manage band</a>
        </li>
        <li>
          <a href="managevenues.php">Manage Venues</a>
        </li>
        <li>
          <a href="logout.php">Log Out</a>
        </li>
      </ul>
            </td>


	<p>

        <tr><h1>Add Concert:</h1></tr>


    <label for="bands">Band:</label>
	<select name="band_id">
	   <?php
	   $band_query = 'SELECT * FROM bands';
	   $band_results = $db->query($band_query);

	   while ($band_row = $band_results->fetch_assoc())
	   {
		   echo '<option value="'.$band_row['band_id'].'">';
		   echo $band_row['band_name'].'</option>';
	   }
	   ?>
	</select>
	<br><br>
	<label for="venues">Venue:</label>
	<select name="venue_id">

	   <?php
	   $venue_query = 'SELECT * FROM venues';
	   $venue_results = $db->query($venue_query);

	   while ($venue_row = $venue_results->fetch_assoc())
	   {
		   echo '<option value ="'.$venue_row['venue_id'].'">';
		   echo $venue_row['venue_name'].'</option>';

	   }
	   ?>
</select>
<br><br>
	<label>Date: <input type='datetime-local' name='concert_date' placeholder='YYYY-MM-DD' required pattern="\d{4}-\d{2}-\d{2}">
	<span class="validity"></span>
  <br />
  <br>
 <label>18+ Only: <input type="checkbox" name='over_18' value="BOOLEAN" />
   <br><br>
<input type="submit" name="Add Cocert" value="Add Cocert" />

<?php

   @ $db = new mysqli('localhost', 'root', '','concertbookings');
   if (mysqli_connect_errno())
   {
     echo 'Could not conenct the database - Please try again later';
     exit;
   }

   $query = "SELECT concert_date,band_name, venue_name, concert_id, venuecapacity
   FROM concerts as c join bands as b on c.band_id = b.band_id join venues as v on c.venue_id = v.venue_id
  WHERE concert_date > CURDATE()  ORDER BY concert_date ";


   if($result = mysqli_query($db, $query)){
       if(mysqli_num_rows($result) > 0){

       echo "<tr><h1>Upcoming Concerts:</h1></tr>";
               while($row = mysqli_fetch_array($result)){
                   echo "<tr>";
                   echo "<li><a>" . $row['concert_date'] . "\n";
                   echo "<td>" . $row['band_name'] . "\n";
                   echo "<td> is playing at \n";
                   echo "<td>" . $row['venue_name'] . "<br />\n";
                   echo '<p><a href="cancelconcert.php?concert_id=' . $row['concert_id'] . '"
                    onclick="return confirm(\'Are you sure you want to Cancel this Concert?\');">cancel</a></p></td></tr>';
                  echo "</tr>";
               }

           mysqli_free_result($result);
       } else{
           echo "No records matching your query were found.";
       }
    }else{
       echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
   }
   $query = "SELECT concert_date,band_name, venue_name, concert_id, venuecapacity
   FROM concerts as c join bands as b on c.band_id = b.band_id join venues as v on c.venue_id = v.venue_id
    WHERE concert_date < CURDATE()  ORDER BY concert_date ";


   if($result = mysqli_query($db, $query)){
       if(mysqli_num_rows($result) > 0){

       echo "<tr><h1> Past Concerts:</h1></tr>";
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
    }else{
       echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
   }


 ?>

	</select>
</td>
  <br />
</td>
  <br />
	</label>
	<br><br>
    <label>
<body style="background-color:#dce6f2;">
	</label>
            </td>
         </tr>
         <tr>

               <center>


               </center>
            </td>
         </tr>

      </table>
   </body>
</form>
</html>
