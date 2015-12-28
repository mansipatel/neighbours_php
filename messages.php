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
<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Neighbour </span>  Space<small>  Share & Care</small></a></h1>
      </div>
     
	 
	  <div class = "message">
		  <b>Welcome  <?php echo $_SESSION['firstName']; ?></b>
		  </div>
      <div class="menu_nav">

        <ul>
		
          <li><a href="index.html">Profile</a></li>
		  <li> <a href="logout.php">Logout</a></li>
        </ul>
		
        <div class="clr"></div>
      </div>
	   
		
		<div id="roundbar-blue">
	<ul>
		<li class="first"><a style="color:white" href="personalFeed.php">Personal Feeds</a></li>
		<li class="active"><a style="color:white" href="neighbourFeed.php">Neighbourhood Feeds</a></li>
		<li class="last"><a style="color:white" href="blockFeed.php">Block Feeds</a></li>
	</ul> 
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
			  <li><a href="addFriend.php">Add Friend</a></li>
			  <li><a href="add_neighbour.php">Add Neighbour</a></li>
			   <li><a href="sendMessage.php">Post Message</a></li>
			   <li><a href="blockChange.php">Block Change</a></li>

            </ul>
          </div>
        
        
  
      </div>
    </div>
  </div>

</div>
</body>
</html>