<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'assets.php' ?>
</head>

<?php
$email = $_SESSION['email'];

include "connectdb.php";

if(!isset($_SESSION['username'])) { //if not yet logged in
//   header("Location: login.php");// send to login page
//   exit;
} 
?>
<body>
<?php include 'header.php' ?>

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
