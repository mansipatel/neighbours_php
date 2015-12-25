<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'assets.php' ?>
</head>

<?php
$email = $_SESSION['email'];

include "connectdb.php";
$active_link="friends";

if(!isset($_SESSION['username'])) { //if not yet logged in
//   header("Location: login.php");// send to login page
//   exit;
} 
?>
<body>
<?php include 'header.php' ?>

<?php
if($_POST['profile_desc']){ // form is POSTed, save fields
$userId = $_SESSION['userId'];
$profile_desc = $_POST['profile_desc'];
$image = $_POST['image']'

$target_dir  = "images/profile_images/";
$target_file = $target_dir . $userId . ".jpg";

$uploadOk = 1;
move_uploaded_file($FILES(["image"]["tmp_name"], $target_file)

//save profile_desc
$query = "Insert into neighbours.profiles(user_id, profile_desc) values(" . $userId . ", '" . $profile_desc . "')";
$mysqli->query($query);

}
?>
<form action="profile.php" method="post">
</br>
</br>

<div class="topic">Please fill in your profile details below:</div>
<br/>
<form>
<h3>About Me</h3>
<textarea name='profile_desc' rows='4' cols='40'></textarea>
<br />
<h3>Profile Picture</h3>
<input type="file" name="image" id="image" />
<br /><br /><br />
<input type="submit" value="Save Profile and Image" name="submit" class="btn btn-primary" />
</form>
</body>
</html>
