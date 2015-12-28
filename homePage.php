<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "assets.php";?>
</head>

<?php
include "connectdb.php";
$active_link="home";
include "include.php";
if(isset($_SESSION['email']))
{
	$email = $_SESSION['email'];
}

if ($stmt = $mysqli->prepare("select u.first_name , u.id from neighbours.users u where u.email = '$email'")) {
  $stmt->execute();
  $stmt->bind_result( $first_name , $userId );
  if($stmt != null)
  {
	  while($stmt->fetch()) { 
	  $_SESSION['userId'] = $userId;
	  $_SESSION['firstName'] = $first_name;
	  
	  }
  }
   $stmt->close();
}
if(empty($_SESSION)) // if the session not yet started 
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: index.html");// send to login page
   exit;
} 
?>
<body>
<?php 
$active_link = "homePage";
include "header.php"; 
?>
<!-- <div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
        <h1><a href="#"><span>Neighbour </span>  Space<small>  Share & Care</small></a></h1>
      </div>
      <div class="search">
        <form method="get" id="search" action="#">
          <span>
          <input type="text" value="Search..." name="s" id="s" />
          <input name="searchsubmit" type="image" src="images/search.gif" value="Go" id="searchsubmit" class="btn"  />
          </span>
        </form>
        <!--/searchform -->
        <div class="clr"></div>
      </div>
	  <div class = "message">
		  <b>Welcome  <?php echo $_SESSION['firstName']; ?></b>
		  </div>
      <div class="menu_nav">

        <ul>
		
          <li><a href="profile.php">Profile</a></li>
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
              <li class="active"><a href="#">Home</a></li>
              <li><a href="friend_list.php">Friends</a></li>
              <li><a href="neighbour_list.php">Neighbours</a></li>
              <li><a href="friend_req.php">Pending Friend Requests</a></li>
              <li><a href="block_requests.php">Block Requests</a></li>
              <li><a href="messages.php">Feeds</a></li>
			  <li><a href="#">Add Friend</a></li>
			   <li><a href="add_neighbour.php">Add Neighbour</a></li>
			   <li><a href="sendMessage.php">Post Message</a></li>
            </ul>
          </div>
        
        
        </div>
      </div>
    </div>
  </div>

</div>
<div class="footer">
  <div class="footer_resize">
    <div class="clr"></div>
  </div>
</div>
 




</body>

</html>
