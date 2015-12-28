<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "assets.php";?>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<?php
include "include.php";
include "connectdb.php";
$userId = $_SESSION['userId'];

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['userId'])) { //if not yet logged in
   header("Location: index.html");// send to login page
   exit;
}

?>
<body>

<?php 
$active_link = "add_friend";
include "header.php"; 
?>


<?php
$sender_id = 0;
echo '<form method  ="post">';

echo'</br>';

echo'</br>';

echo'</br>';
echo '<hd>';
echo 'Please enter the new zip to change your block';
echo'</br>';

echo'</br>';
echo '</hd>';	
echo '<div class = menu_nav align = left >';
echo '<hf><tr><td>Zip Code:  </td>';
echo "<td><input type = 'text' name = 'zip' value = ''/></td></tr>";
echo'</br>';
echo'</br>';

echo'</br>';
echo "<input type='submit' class= 'btn' name = 'Change' value='Change' />";
echo '</hf></div>';
echo'</br>';
if(isset($_POST['zip']))
	$zip = $_POST['zip'];
if(isset($_POST['Change']))
	{
	$stmt1 = $mysqli->prepare("select id from neighbours.neighbourhoods where zip='$zip'");
	     	if($stmt1) 
     		{
  				$stmt1->execute();
			  	$stmt1->bind_result($hood_id);
			  	$stmt1->store_result();
			  	$stmt1->fetch();
			 }

// getting block id
			 $stmt2 = $mysqli->prepare('select id from neighbours.blocks where hood_id="' . $hood_id . '"');
	     	if($stmt2) 
     		{
  				$stmt2->execute();
			  	$stmt2->bind_result($block_id);
			  	$stmt2->store_result();
			  	$stmt2->fetch();
			 }
			 $query = "update neighbours.users set hood_id = ? , block_id = ? , status = 'pending' where id = '$userId'";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("ii", $hood_id , $block_id);
			if($stmt->execute()){
				echo '<script> alert("Block Change carried out Successfully"); </script>';
				$stmt->close();
			}

	}
echo '</form>';
?>
</body>
</html>	