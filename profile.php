<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include 'assets.php' ?>
  </head>

  <?php
include "include.php";
include "connectdb.php";

$active_link="";
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.html");// send to login page
   exit;
} 

?>
  <body>
    <?php include 'header.php' ?>

    <?php
$userId = $_SESSION['userId'];
if(isset($_POST['profile_desc'])){ // form is POSTed, save fields
$profile_desc = $_POST['profile_desc'];

$target_dir  = "./images/profile_images/";
$target_file = $target_dir . $userId . ".jpg";

$uploadOk = 1;
move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

//save profile_desc
$query = "Insert into neighbours.profiles(user_id, profile_desc) values(" . $userId . ", '" . mysql_escape_string($profile_desc) . "')";

if(!$mysqli->query($query)){
echo "Error: " . $sql . "<br>" . $mysqli->error;
}
?>
    <h3>Your profile details have been saved!</h3>
    <?php
}
else {
// This is a GET, fetch the profile_desc form db
$query= "select profile_desc from neighbours.profiles where user_id=" . $userId;
$res = $mysqli->query($query);
if($res->num_rows > 0){
?>
<h3>You've entered your profile details</h3>
<?php

}
else{

?>
    <div>
      <form action="profile.php" method="post" enctype="multipart/form-data">
      </br>
    </br>

    <div class="topic">Please fill in your profile details below:</div>
    <br/>
    <h3>About Me</h3>
    <textarea name=profile_desc rows=4 cols=40><?=$profile_desc ?></textarea>
    <br />
    <h3>Profile Picture</h3>
    <input type="file" name="image" id="image" />
    <br /><br /><br />
    <input type="submit" value="Save Profile and Image" name="submit" class="btn btn-primary" />
  </form>
</div>
<?php
}
}
?>
</body>
</html>
