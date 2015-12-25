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
<?php include "header.php"; 
$active_link="friend_list";?>


<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";
if ($stmt = $mysqli->prepare("select u.first_name , u.last_name , n.hood_address , b.block_address from neighbours.users u , neighbours.friends fr , neighbours.neighbourhoods  n , neighbours.blocks b 
where fr.user_id = '$userId' and fr.friend_id = u.id  and u.hood_id = n.id and u.block_id = b.id ")) {
  $stmt->execute();
  $stmt->bind_result( $first_name , $last_name , $hood_address , $block_address );
  if($stmt != null)
  {
	 echo '</br>';
	 echo '</br>';
		 
	
	echo '</br>';
	echo '</br>';
	echo '</br>';
	
	echo "<div class='table-style-three'><table>
<thead><tr><th>Name</th><th>Profile</th><th>Neighbourhood</th><th>Block</th></tr></thead>";
      while($stmt->fetch()) {
			echo '<hd>';
			echo '</hd>';
echo "<tr><td> $first_name  $last_name</td><td>Profile Pic</td><td> $block_address</td><td> $hood_address</td>
</tr>
";

  }
  echo "</table></div>";
  }	  
  else
  {
	}
  $stmt->close();
 
}
else
{
	echo"There is some sql error encountered";
}

echo '</form>';
?>
</body>
</html>
