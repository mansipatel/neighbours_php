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
<?php include "header.php"; ?>

<?php
 $message = '';
 $msgTitle ='';
 ?>
 <form method ="post">
 </br>
</br>

<div class="topic">Post a Message</div>
</br>
</br>
<hf> 
<tr><td> Message :</td>
<td> <textarea name='messageDesc' rows='5' cols='30'></textarea>
</td>
</tr>
</br>
</br>
</br>
<tr><td> Message Type :</td>
<td><select name="msgType">
  <option value="C">Custom</option>
  <option value="N">NeighBourhood</option>
  <option value="B">Block</option>
  <option value="F">Friends</option>
</select></td>
</tr>
</br>
</br>
<tr>
<td>Message Title:</td>
<td> <input type = 'text' name='messageTitle' value = '<?php echo $msgTitle;?>' />
</td>
</tr>
</br>
</br>

<tr><td> Recipient  Name   </td>
<td></td>
</tr>

<td><input type='submit' class= 'btn' align = 'center' name = 'Send' value='Send' /></td>

</hf>
</p>
<?php
	if(isset($_POST['Send']))
	{	 
		
		$msgType = $_POST['msgType'];
		$msgTitle = $_POST['messageTitle'];
		$message = $_POST['messageDesc'];
		$result=$mysqli->prepare('Call neighbours.post_message(? , ? , ? , ? , 0 , @msg_id);'); 
		$result->bind_param("siss", $message ,$userId , $msgTitle, $msgType);
		$result->execute();
		echo '<script> alert("Message Sent Successfully"); </script>';
	}
 ?>
</form>
</body>
</html>
