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
   header("Location: login.php");// send to login page
   exit;
} 
?>
<body>

<?php 
$active_link = "add_neighbour";
include "header.php"; 
?>

<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";

if ($stmt = $mysqli->prepare("select DISTINCT(u.id), u.first_name , u.last_name , n.hood_address, b.block_address from neighbours.users u, neighbours.neighbourhoods  n,
	neighbours.blocks b, neighbours.neighbours ne
	where u.hood_id = n.id and u.block_id = b.id 
	and ne.user_id = '$userId' ;")) {
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
	echo "You have no more new neighbours make!!";
	echo '</hd>';
	}
	else
	{
	echo '<hd>';
	echo "You have '$stmt->num_rows' new neighbours";
	echo '</hd>';
	echo '</br>';
	echo '</br>';
	echo '</br>';
	
	echo "<table class='table table-striped table-bordered table-condensed' style='width: 500px;'>
<thead><tr><th>Name</th><th>Neighbourhood</th><th>Send</th></tr></thead>";
}
while($stmt->fetch()) {
			
echo "<tr><td> $first_name $last_name</td><td> $hood_address</td>
<td><input type='submit' class= 'btn' name = 'send' value='Send' id = 'accept.$sender_id' onClick = 'return acceptFriendReq($sender_id);'/></td>";
  }
  echo "</table>";
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
