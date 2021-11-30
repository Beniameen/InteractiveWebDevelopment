<?php
session_start();
// Is the admin logged in?
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}
?>

<?php
$newrecord ='';


if (isset($_POST['submitted'])) {

	include('connection.php');
	$bname = $_POST ['bname'];


	if (empty($bname)) {

	die('You forgot to enter a new band name!');

}

$band_query = "SELECT band_name FROM bands WHERE band_name  = '$bname'";
$band_results = $dbcon->query($band_query);

if ($band_results->num_rows > 0)
{
  $newrecord = 'Your band already exits, choose another. ';
}
else {
  $sqlinsert = "INSERT INTO bands (band_name) VALUES ('$bname')";
  if (!mysqli_query($dbcon, $sqlinsert)) {
    die('error inserting new record');
      }   // end of my nested if statement

  $newrecord = " New Band has been added";
}

} // end of the main if statement


?>


<!DOCTYPE html>
<html>

   <head>
      <title>Assignment</title>
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
			   <b>Manage band</b>
			   <br />
			   <br />
			   <br />

	<ul>
        <li>
          <a href="manageVenues.php">Manage Venue</a>
        </li>
        <li>
          <a href="manageConcert.php">Manage Concert</a>
        </li>
        <li>
          <a href="logout.php">Log Out</a>
        </li>
      </ul>
            </td>

            <td bgcolor = "#dce6f2" width = "100" height = "200">
	<p>
      Current Bands:
    </p>
    <?php
    require_once ('connection.php');
    $query = "SELECT DISTINCT bands.band_name, bands.band_id FROM concerts INNER JOIN  bands ON (concerts.band_id = bands.band_id)";


    $results = $dbcon->query($query);

    echo '<p style ="color:red">'.$results->num_rows.' bands found that are linked with the concerts and cannot be deleted.</p>';

    echo '<table><tr>';
    foreach($results as $row)

    {

     echo '<tr  style ="color:red"><td>'.'<li>'.$row['band_name'].'</td>'.'</li>';

     echo '<td><a href="EditBand.php?edit_id='.$row['band_id'].'&bn='.$row['band_name'].'">Edit</a></tr> ';
    }




    $con = "SELECT bands.band_name, bands.band_id FROM bands WHERE NOT EXISTS (SELECT band_id FROM concerts WHERE concerts.band_id = bands.band_id)";
    $result = $dbcon->query($con);
    foreach($result as $ro)

    {

    echo '<tr><td>'.'<li>'.$ro['band_name'].'</td>'.'</li>';
    echo '<td><a href="EditBand.php?edit_id='.$ro['band_id'].'&bn='.$ro['band_name'].'">Edit</a> ';
    echo '<a href="DeleteBand.php?del_id='.$ro['band_id'].'"
      onclick="return confirm(\'Do you want to delete the band?\');">Delete</a> </td></tr>';
    }
    echo '</table>';

 ?>
    <p>
      <h2>Add New Band:</h2>
    </p>

	<form method="post" action="addBand.php">
	<input type="hidden" name="submitted" value="true" />
	<fieldset>

		<label>Name:<input type="text" name="bname" /></label>
	</fieldset>
	<br />
	<input type="submit" value="Add Band" />
	</form>
	<span><?php echo $newrecord; ?></span>

            </td>
         </tr>
         <tr>
            <td colspan = "2" bgcolor = "#dce6f2">
               <center>

               </center>
            </td>
         </tr>

      </table>
   </body>

</html>
