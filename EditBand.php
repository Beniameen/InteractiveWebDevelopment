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
include("connection.php");
error_reporting(0);

$bname = $_GET['bname'];
$edit = $_GET['edit_id'];
?>





<html>
<head>
   <title>Edit band</title>

<body>
<form action="" method="GET">
<tr>
<td>New Details</td>
<td><input type="hidden" value="<?php echo "$edit" ?>" name="band_id" ></td>
<td><input type="text" value="<?php echo "$bname" ?>" name="band_name" ></td>

</tr>
<tr>
<td><input type="submit" id="button" name="submit" value="Update"><td>
</tr>
</form>
</body>
</html>

<?php
if($_GET['submit'])
{

    $band_id = $_GET ['band_id'];
	$band_name = $_GET['band_name'];

$query = "UPDATE bands SET band_name='$band_name', band_id='$band_id' WHERE band_id='$band_id'";
$results =$dbcon->query($query);

if($results)
{
	echo "<meta http-equiv='refresh' content='0;url=manageband.php'>";
}
else
{
	echo "Not updated";
}
}
?>
