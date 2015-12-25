<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "assets.php";?>
</head>
<body>

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
<?php 
include "header.php"; 
 $message = '';
 $msgTitle ='';
 if(isset($_GET["msgId"]))
{
	$messageId =  $_GET["msgId"];
}
if ($stmt = $mysqli->prepare("select m.id , m.msg_text , m.title , m.msg_time , u1.first_name, u2.first_name ,  th.thread_text , th.thread_time from messages  m , threads th , users u1 , users u2 where u1.id = m.msg_by and u2.id = th.thread_by and m.id = th.msg_id group by th.msg_id ")) {
  $stmt->execute();
  $stmt->bind_result( $msg_id , $msg_text , $msg_title , $msg_time , $msg_posted_by , $thread_posted_by  , $thread_text , $thread_time );
  if($stmt != null)
  {
	 echo '</br>';
	 echo '</br>';
		 
	
	echo '</br>';
	echo '</br>';
	echo '</br>';
	
	echo "<div class='table-style-three'><table>";
      while($stmt->fetch()) {
			echo '<hf>';
			echo "<tr><td> Message Text :</td><td>$msg_text</td></tr>
			</br></br>
			<tr><td> Message Title : </td><td> $msg_title</td></tr>
			</br></br>
			<tr><td> Message Time : </td><td> $msg_time</td></tr>
			<tr><td> Message Posted By : </td><td> $msg_posted_by</td></tr>
			</br></br>";

		echo '</hf>';
  }
  echo "</table></div>";
  }	
}  
 ?>
</body>
</html>