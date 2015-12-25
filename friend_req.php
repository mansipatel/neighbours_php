<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "assets.php";?>
</head>

<?php
$_SESSION['username'] = 'adm';
$_SESSION['userid'] = 6;
$userId = $_SESSION['userid'];
$userId = 6;
include "connectdb.php";
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
} 
?>
<body>

<?php include "header.php"; ?>

<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";
if ($stmt = $mysqli->prepare("select u.first_name , u.last_name , n.hood_address , b.block_address , fr.sender_id  from neighbours.users u , neighbours.friend_requests fr , neighbours.neighbourhoods  n , neighbours.blocks b 
where fr.sender_id = u.id  and u.hood_id = n.id and u.block_id = b.id and fr.user_id = '6' and fr.status = 'pending';")) {
  $stmt->execute();
  $stmt->bind_result( $first_name , $last_name , $hood_address , $block_address , $sender_id);
  if($stmt != null)
  {
	 echo '</br>';
	 echo '</br>';
		 
	if($stmt->num_rows == 0)
	{
	echo '<hd>';
	echo "You have no pending friend requests";
	echo '</hd>';
	}
	else
	{
	echo '<hd>';
	echo "You have '$stmt->num_rows' pending friend requests";
	echo '</hd>';
	echo '</br>';
	echo '</br>';
	echo '</br>';
	
	echo "<div class='table-style-three'><table>
<thead><tr><th>Name</th><th>Profile</th><th>Neighbourhood</th><th>Block</th><th>Accept</th><th>Reject</th></tr></thead>";
}
      while($stmt->fetch()) {
			
echo "<tr><td> $first_name  $last_name</td><td>Profile Pic</td><td> $block_address</td><td> $hood_address</td>
<td><input type='submit' class= 'btn' name = 'Accept' value='Accept' id = 'accept.$sender_id' onClick = 'return acceptFriendReq($sender_id);'/></td>
<td><input type='submit'  class = 'btn' name = 'Reject' value='Reject' id = 'reject.$sender_id' onClick = 'rejFriendReq($sender_id)'/></td>
</tr>
";

  }
  echo "</table></div>";
  }	  
  else
  {
	echo '<hd>';
	
	echo "You have no pending friend requests";
	
	echo '</hd>';
	}
  $stmt->close();
 
}
else
{
	echo"There is some sql error encountered";
}
if(isset($_POST['Accept']))
{ 
		echo $sender_id;
		$result=$mysqli->prepare('CALL neighbours.accept_friend_request("6" , ? , "accepted" ,@return_bit)'); 
		$result->bind_param("i", $sender_id);
		$result->execute();
		echo '<script> alert("Success"); </script>';
}
if(isset($_POST['Reject']))
{ 
		echo $sender_id;
		$result=$mysqli->prepare('CALL neighbours.decline_friend_request("6" , ? , "rejected" ,@return_bit)'); 
		$result->bind_param("i", $sender_id);
		$result->execute();
		echo '<script> alert("Success"); </script>';
}
echo '</form>';
?>



</body>

</html>