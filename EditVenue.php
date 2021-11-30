<?php
session_start();
// Is the admin logged in?
if (!isset($_SESSION['user']))
{
   header("location:login.php");
   exit();
}

@ $db = new mysqli('localhost', 'root', '','concertbookings');
if (mysqli_connect_errno())
{
  echo 'Could not conenct the database - Please try again later';
  exit;
}
error_reporting(0);

$venue_name = $_GET['venue_name'];
$edit = $_GET['edit_id'];
$venuecapacity = $_GET['venuecapacity'];
?>

<!DOCTYPE html>
<html>

   <head>
      <title>Edit venue</title>
      <script language="JaveScript"  type="text/javascript">
      function ValidateForm ()
        {
          var form = document.Editvenueform;
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
<form action="EditVenue.php?edit_id=<?php echo $_GET['edit_id']; ?>" method="POST">
<tr>
<td>Name</td>
<td><input type="hidden" value="<?php echo "$edit" ?>" name="venue_id" ></td>
<td><input type="text" name="venue_name" value="<?php echo "$venue_name" ?>" ></td>

<td>Capacity</td>
<td><input type="hidden" value="<?php echo "$edit" ?>" name="venue_id" ></td>
<td><input type="number" min=5 value="<?php echo "$venuecapacity" ?>" name="venuecapacity" ></td>

</tr>
<td><input type="submit" id="button" name="submit" value="Update"><td>

</tr>
</form>
</body>
</html>

<?php
$venue_id = $_GET['edit_id'];
$venue_name = $_POST['venue_name'];
$venuecapacity = $_POST['venuecapacity'];




if($_POST['submit'])
{
  if (empty($venue_name) || empty($venuecapacity))
  {

    die('You forgot to enter a new venue name or capacity!');
  }


  $query="SELECT venuecapacity from venues where venue_id = $venue_id";

                      $result = mysqli_query($db, $query);
                      $row = mysqli_fetch_array($result);
  if ($venuecapacity <  $row['venuecapacity'])
   {
     die('You cannot decrease the capacity');
   }


$query = "UPDATE venues SET venue_name='$venue_name', venue_id='$venue_id', venuecapacity='$venuecapacity'
 WHERE venue_id= $venue_id ";
$results =$db->query($query);

if($results)
{
	echo "<meta http-equiv='refresh' content='0;url=manageVenues.php'>";
}
else
{
	echo "Not updated";
}
}


?>
