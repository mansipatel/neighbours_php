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
<?php 
$active_link = "messages";
include "header.php"; 
echo "<table class='table table-striped table-bordered table-condensed' style='width: 500px;'>
<thead><tr><th>Feed: 1</th><th>Feed: 2</th><th>Feed: 3</th></tr></thead>";

echo '<tr><td> <a style="color:black" href="personalFeed.php">Personal Feeds</a></td>
      <td> <a style="color:black" href="neighbourFeed.php">Neighbourhood Feeds</a></td>
      <td> <a style="color:black" href="blockFeed.php">Block Feeds</a></td>';
// echo '<td><>
//     <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><ul>
//     <center><li class="first"><a style="color:black" href="personalFeed.php">Personal Feeds</a></li>
//     <li class="active"><a style="color:black" href="neighbourFeed.php">Neighbourhood Feeds</a></li>
//     <li class="last"><a style="color:black" href="blockFeed.php">Block Feeds</a></li>
//   </ul> 
//   </div>'
?>
<!-- <div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Neighbour </span>  Space<small>  Share & Care</small></a></h1>
      </div>-->
     
	 <!-- <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> -->
   

	  <!-- <div class = "message">
		  <b>Welcome  <?php echo $_SESSION['firstName']; ?></b>
		  </div>
      <div class="menu_nav">

        <ul>
		
          <li><a href="index.html">Profile</a></li>
		  <li> <a href="logout.php">Logout</a></li>
        </ul>
		
        <div class="clr"></div>
      </div>
	   
	
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
             <li ><a href="homePage.php">Home</a></li>
              <li><a href="friend_list.php">Friends</a></li>
              <li><a href="#">Neighbours</a></li>
              <li><a href="friend_req.php">Pending Friend Requests</a></li>
              <li><a href="block_requests.php">Block Requests</a></li>
              <li class="active"><a href="messages.php">Feeds</a></li>
			  <li><a href="#">Add Friend</a></li>
			  <li><a href="#">Add Neighbour</a></li>
			   <li><a href="sendMessage.php">Post Message</a></li>
            </ul>
          </div>
        
        
  
      </div>
    </div>
  </div>

</div> -->
</body>
</html>