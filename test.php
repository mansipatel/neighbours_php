<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Neighbour Space</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
</head>

<?php

$email = $_SESSION['email'];

include "connectdb.php";

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
} 
?>
<body>
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Neighbour </span>  Space<small>  Share & Care</small></a></h1>
      </div>
     
	 
	  <div class = "message">
		  <b>Welcome  <?php echo $_SESSION['email']; ?></b>
		  </div>
      <div class="menu_nav">

        <ul>
		
          <li><a href="index.html">Profile</a></li>
		  <li> <a href="logout.php">Logout</a></li>
        </ul>
		
        <div class="clr"></div>
      </div>
	  
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
        </div>
        <div class="sidebar">
          <div class="gadget">
            <h2 class="star"><span>Sidebar</span> Menu</h2>
            <div class="clr"></div>
            <ul class="sb_menu">
              <li class="active"><a href="homePage.php">Home</a></li>
              <li><a href="friend_list.php">Friends</a></li>
              <li><a href="#">Neighbours</a></li>
              <li><a href="friend_req.php">Pending Friend Requests</a></li>
              <li><a href="block_requests.php">Block Requests</a></li>
              <li><a href="messages.php">Feeds</a></li>
			  <li><a href="#">Add Friend</a></li>
			  <li><a href="#">Add Neighbour</a></li>
			   <li><a href="sendMessage.php">Post Message</a></li>
            </ul>
          </div>
        
        
        </div>
      </div>
    </div>
  </div>

</div>
<?php
 $message = '';
 $msgTitle ='';
 ?>
 <form method ="post">
 </br>
</br>

<div class="topic">Complete details</div>
</br>
</br>
<hf> 
<tr><td> Status :</td>
<td> <textarea name='statusDesc' rows='5' cols='30'></textarea>
</td>
</tr>
</br>
</br>
</br>


<?php
$query = "SELECT PcID FROM PC";
$result = mysql_query($sql);

echo "<select name='PcID'>";
while ($row = mysql_fetch_array($result)) {
    echo "<option value='" . $row['PcID'] . "'>" . $row['PcID'] . "</option>";
}
echo "</select>";

?>


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
	echo '<form action="upload.php" method="post" enctype="multipart/form-data">
    				Select image to upload:
    				<input type="file" name="fileToUpload" id="fileToUpload">
    				<input type="submit" value="Upload Image" name="submit">
					</form>';
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
</form>
</body>
</html>
