<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "assets.php";?>
</head>

<?php
include "include.php";
include "connectdb.php";
$userId = $_SESSION['userId'];

if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
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
$requests = "";
echo '<div>';
if ($stmt = $mysqli->prepare("select DISTINCT(u.id), u.first_name , u.last_name , n.hood_address, b.block_address from neighbours.users u, neighbours.neighbourhoods  n,neighbours.blocks b where u.hood_id = n.id and u.block_id = b.id  and u.id not in (select friend_id from neighbours.friends where user_id = '$userId') and u.id not in (select user_id from neighbours.friend_requests where status = 'pending' and sender_id = '$userId') ;")) {
  $stmt->execute();
  $stmt->bind_result( $id, $first_name , $last_name , $hood_address , $block_address);
  if($stmt != null)
  {
	 echo '</br>';
	 echo '</br>';
        $stmt->store_result();		 
	if($stmt->num_rows == 0)
	{
	echo '<hd>';
	echo "You have no more new friends to make!!";
	echo '</hd>';
	}
	else
	{
	echo '<div align  = left><hd>';
	echo "You have '$stmt->num_rows' new friend suggestions";
	echo '</hd>';
	echo '</br>';
	echo '</br>';
	echo '</br>';
	echo '</div>';
	echo "<div class='table-style-three' align = left><table>
<thead><tr><th>Select</th><th>Name</th><th>Neighbourhood</th><th>Block</th></tr></thead>";
}
while($stmt->fetch()) {
			
echo "<tr><td><input type = 'radio' name = 'radioChk' value = '$id'/>";
echo "</td><td> $first_name $last_name</td><td> $hood_address</td><td> $block_address</td></tr>";
}

  echo "</table>";
  echo '</div>';
  echo'</br>';
echo'</br>';
echo '<div align = left>';
  echo "<input type='submit' class= 'btn' name = 'send' value='Send' />";
  echo '</div>';
  echo '</div>';
  }	  
  else
  {
	echo '<hd>';
	
	echo"There is some sql error encountered";
	
	echo '</hd>';
	}
  $stmt->close();
 
}

if(isset($_POST['send']))
	{
	$result=$mysqli->prepare('CALL neighbours.send_friend_request(?, ?,@return_bit);'); 
	echo $_POST['radioChk'];
	$result->bind_param("ii",$_POST['radioChk'] , $userId);
	$result->execute();
	echo '<script> alert("Friend Request Sent Successfully"); </script>';
	header("Refresh:0");
	}
echo '</form>';
?>
</body>
</html>	