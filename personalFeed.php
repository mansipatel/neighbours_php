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
<?php include "header.php";?>
<?php
	echo '<form method  ="post">';
	if ($stmt = $mysqli->prepare("select u.first_name, m.msg_title , m.msg_text , m.msg_time, m.id
	from neighbours.messages  m ,  neighbours.users u
	where   m.msg_by = u.id and u.id in (select friend_id from neighbours.friends where user_id = '$userId')"))
	{
		$stmt->execute();
		$stmt->bind_result($first_name , $msg_title , $msg_text , $msg_time ,$msg_id);
		if($stmt != null)
		{
		$stmt->store_result();
			if( $stmt->num_rows > 0)
			{	echo '</br>';
				echo '</br>';
				echo '</br>';
				echo '</br>';
				echo "<div class='table-style-three'><table>
					<thead><tr><th>Message Title</th><th>Message Text</th><th>Posted By</th><th>Posted Date</th></tr></thead>";
			}
			while($stmt->fetch()) 
			{
			echo '<hd>';
			echo '</hd>';
			echo "<tr><td> <a href = 'messageThread.php?msgId=$msg_id'>$msg_title</a> </td><td>$msg_text </td><td> $first_name </td><td> $msg_time</td>
			</tr>";
				
			}
			echo "</table></div>";			
		}
		  else
		{
			"There is some sql error encountered in status query";
		}
		$stmt->close();
}
?>
</body>
</html>
