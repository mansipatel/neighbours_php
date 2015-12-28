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
if ($stmt = $mysqli->prepare("select m.id , m.msg_text , m.msg_title , m.msg_time , u1.first_name from  neighbours.messages m , neighbours.users u1 where u1.id = m.msg_by and m.id = '$messageId' ")) {	
  $stmt->execute();
  $stmt->bind_result( $msg_id , $msg_text , $msg_title , $msg_time , $msg_posted_by );
  if($stmt != null)
  {
	 echo '</br>';
	
	echo "<div class='table-style-three' align  = center><table>";
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

if ($stmt = $mysqli->prepare("select th.id , th.thread_text , th.thread_time, u1.first_name from  neighbours.threads th , neighbours.users u1 where u1.id = th.thread_by and th.msg_id = '$messageId' ")) {	
  $stmt->execute();
  $stmt->bind_result( $th_id  , $th_text  , $th_time , $th_postedby );
  if($stmt != null)
  {
	 echo '</br>';
	echo "<div class='table-style-three' align = center><table>";
      while($stmt->fetch()) {
			echo '<hf>';
			echo "<tr><td> Reply Text :</td><td>$th_text</td></tr>
			</br></br>
			<tr><td> Reply Time : </td><td> $th_time</td></tr>
			</br></br>
			<tr><td> Reply Posted By : </td><td> $th_postedby</td></tr>
			</br></br>";

		echo '</hf>';
  }
  echo "</table>";
  }
} 
	 echo '</br>';
		 
	
	echo '</br>'; 
echo'<form method = "post">';
echo '<hf>';
echo "<tr><td>Post a Reply :</td>"; 
echo "<td> <textarea name='replyDesc' rows='5' cols='30'></textarea></td></tr>";
echo "<td><input type='submit'  class = 'btn' name = 'Send' value='Send'/></td>";
echo '</hf>';
echo "</div>";

if(isset($_POST['Send']))
	{
	$result=$mysqli->prepare('CALL neighbours.post_reply(? , ? , ? )'); 
	$result->bind_param("isi",$messageId , $_POST['replyDesc'] , $userId);
	$result->execute();
	$stmt->close();
	echo '<script> alert("Reply Posted Successfully"); </script>';

	}			
		
  
echo '</form>';
 ?>
</body>
</html>