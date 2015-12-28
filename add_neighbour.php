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
$active_link = "add_neighbour";
include "header.php"; 
?>

<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";

if ($stmt = $mysqli->prepare("select DISTINCT(u.id), u.first_name , u.last_name , n.hood_address, b.block_address from neighbours.users u, neighbours.neighbourhoods  n,neighbours.blocks b where u.hood_id = n.id and u.block_id = b.id and b.id = (select block_id from neighbours.users u2 
where u2.id = '$userId') and u.id not in (select neighbour_id from neighbours.neighbours where user_id = '$userId') and u.id != '$userId'")) {
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
	echo "You have no more new neighbours to make!!";
	echo '</hd>';
	}
	else
	{
	echo '<div align  = left><hd>';
	echo "You have '$stmt->num_rows' new neighbours";
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
  echo "<input type='submit' class= 'btn' name = 'send' value='Add' />";
  echo '</div>';
  echo '</div>';
  }	  
  else
  {
	echo '<hd>';
	
	echo "SQL error encountered";
	
	echo '</hd>';
	}
  $stmt->close();
 
}

if(isset($_POST['send']))
	{
	$result=$mysqli->prepare('insert into neighbours.neighbours (user_id , neighbour_id)values (? , ?)'); 
	echo $_POST['radioChk'];
	$result->bind_param("ii", $userId , $_POST['radioChk']);
	$result->execute();
	echo '<script> alert("Neighbour added Successfully"); </script>';
	header("Refresh:0");
	}
echo '</form>';
?>
</body>
</html>	
