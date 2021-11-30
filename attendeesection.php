<html>
<body>
      <tr>

            <h1>Welcome to Free-Girgs, the Free Concert Website</h1>
            <tr valign = "top">
         </td>
      </tr>
<?php

session_start();

if ( !isset($_SESSION['mobilePhone']) || $_SESSION['mobilePhone'] == '' )
{
	header('Location: LoginUser.php');
	exit;
}

echo '<p>you are logged as, '.$_SESSION['firstname'].' '.$_SESSION['surname'].'</p>';
echo '<p><a href="userlogout.php">Log Out</a></p>';

?>




   <head>

   </head>





            </td>


               <?php

                  @ $db = new mysqli('localhost', 'root', '','concertbookings');
                  if (mysqli_connect_errno())
                  {
                    echo 'Could not conenct the database - Please try again later';
                    exit;
                  }
$mobilePhone = $_SESSION['mobilePhone'];

$query="SELECT  cancelmessage from attendees where mobilePhone = $mobilePhone";
  $result = $db->query($query);
  $row = mysqli_fetch_array($result);
     echo '<p style ="color:red">' .$row['cancelmessage'].' </p>';

    $query="UPDATE attendees SET cancelmessage = ''";
    $result = $db->query($query);

                  $query = "SELECT concert_date,band_name, venue_name, concert_id, venuecapacity , over_18
                  FROM concerts as c join bands as b on c.band_id = b.band_id join venues as v on c.venue_id = v.venue_id
                  WHERE concert_date > CURDATE() ORDER BY concert_date ";


                  if($result = mysqli_query($db, $query)){
                      if(mysqli_num_rows($result) > 0){

                      echo "<tr><h1>Upcoming Concerts:</h1></tr>";
                              while($row = mysqli_fetch_array($result)){
                                  echo "<tr>";
                                  echo "<li><a>" . $row['concert_date'] . "\n";
                                  echo "<td>" . $row['band_name'] . "\n";
                                  echo "<td> is playing at \n";
                                  echo "<td>" . $row['venue_name'] . "<br />\n\n";

                                  if ($row['over_18'] == "y")
                                    {
                                        echo '<p style ="color:green"> over 18 only.</p>';

                                     }
                                 else {
                                 echo '<p style ="color:green"> For any age.</p>';
                                 }

                                  $mobilePhone = $_SESSION['mobilePhone'];
                                  $concert_id=$row['concert_id'];


                                  $queryy = "SELECT mobilePhone, concert_id FROM bookings
                                   where mobilePhone=$mobilePhone and concert_id=$concert_id";
                                  $results = $db->query($queryy);


                          if ($results->num_rows > 0)
                            {
                             echo "Booked \n\n";

                            }
                          else
                          {
                            $query="SELECT b.mobilePhone, b.concert_id , c.concert_date FROM bookings as b join Concerts as c
                            on b.concert_id = c.concert_id
                             where mobilePhone=$mobilePhone and concert_date > CURDATE()";

                            $results= $db->query($query);
                              if ($results->num_rows == 2)
                              {
                                echo  'Your maximum bookings reached';
                              }

                            else {
                            $query = "SELECT booking_id, concert_id FROM bookings
                            where bookings.concert_id=$concert_id";

                            $results = $db->query($query);
                            if ($results->num_rows==$row['venuecapacity'])
                            {
                            echo 'Sorry :( it is Fully Booked';
                            echo '<p> ( '  .$results->num_rows.' /  ' . $row['venuecapacity'] .  ')<br />';
                            }
                          else
                            {
                            echo '<p><a href="book.php?concert_id='. $row['concert_id'] . '">book</a></p>';
                            echo '<p> ( '  .$results->num_rows.' /  ' . $row['venuecapacity'] .  ')<br />';

                            }


}
}
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

                <?php


                $link = mysqli_connect("localhost", "root", "", "concertbookings");
                   // Check connection
                   if($link === false){
                       die("ERROR: Could not connect. " . mysqli_connect_error());
                   }


                   $query = "SELECT c.concert_date,o.concert_id, b.band_name, v.venue_name
                   FROM concerts as c join bands as b on c.band_id = b.band_id
                   join bookings as o on c.concert_id = o.concert_id
                   join venues as v on c.venue_id = v.venue_id
                   where mobilePhone=$_SESSION[mobilePhone] and  concert_date > CURDATE() ORDER BY concert_date";



                   if($result = mysqli_query($link, $query)){
                       if(mysqli_num_rows($result) > 0){
                       echo "<tr><h1>Your bookings:</h1></tr>";
                               while($row = mysqli_fetch_array($result)){
                                   echo "<tr>";
                                   echo "<li><a>" . $row['concert_date'] . "\n";
                                   echo "<td>" . $row['band_name'] . "\n";
                                   echo "<td> is playing at \n";
                                   echo "<td>" . $row['venue_name'] . "<br />\n";
                                   echo '<p><a href="cancel.php?concert_id=' . $row['concert_id'] . '"
                                    onclick="return confirm(\'Are you sure you want to Cancel this Booking?\');">cancel</a></p></td></tr>';
                               }

                           mysqli_free_result($result);
                       } else{
                           echo "You don't have any bookings yet.<br>";
                       }
                   } else{
                       echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                   }



                                      $query = "SELECT c.concert_date,o.concert_id, b.band_name, v.venue_name
                                      FROM concerts as c join bands as b on c.band_id = b.band_id
                                      join bookings as o on c.concert_id = o.concert_id
                                      join venues as v on c.venue_id = v.venue_id
                                      where mobilePhone=$_SESSION[mobilePhone] and  concert_date < CURDATE() ORDER BY concert_date";



                                      if($result = mysqli_query($link, $query)){
                                          if(mysqli_num_rows($result) > 0){
                                          echo "<tr><h1>Your Past Booked Concerts:</h1></tr>";
                                                  while($row = mysqli_fetch_array($result)){
                                                      echo "<tr>";
                                                      echo "<li><a>" . $row['concert_date'] . "\n";
                                                      echo "<td>" . $row['band_name'] . "\n";
                                                      echo "<td> is playing at \n";
                                                      echo "<td>" . $row['venue_name'] . "<br />\n";

                                                  }

                                              mysqli_free_result($result);
                                          } else{
                                              echo "You don't past bookings in history.";
                                          }
                                      } else{
                                          echo "ERROR: Could not able to execute $query. " . mysqli_error($link);
                                      }



                 ?>

<body style="background-color:#dce6f2;">
            </td>
         </tr>
         <tr>
               </center>
            </td>
         </tr>
      </table>
   </body>
</html>
