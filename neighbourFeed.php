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

<?php
echo '<form method  ="post">';
if ($stmt = $mysqli->prepare("select m.id , m.msg_title , m.msg_text , u.first_name , m.msg_time  from neighbours.messages  m ,  neighbours.users u , neighbours.message_recipients r where   m.id = r.msg_id   and m.msg_by = u.id  and r.recipient_type = 'N' and r.recipient_id=  (select hood_id from neighbours.users where id = '$userId') ")) 
	
{
		$stmt->execute();
		$stmt->bind_result($msg_id , $msg_title , $msg_text , $first_name , $msg_time );
		if($stmt != null)
		{
		$stmt->store_result();
			if( $stmt->num_rows > 0)
			{	echo '</br>';
				echo '</br>';
				echo '</br>';
				echo '</br>';
				echo "<div class='table-style-three'><table>
					<thead><tr><th>Message Title</th><th>Message Text</th><th>Posted By</th><th>Posted Date</th></tr></thead>";
			}
			while($stmt->fetch()) 
			{
			echo '<hd>';
			echo '</hd>';
			echo "<tr><td> <a href = 'messageThread.php?msgId=$msg_id'>$msg_title</a> </td><td>$msg_text </td><td> $first_name </td><td> $msg_time</td>
			</tr>";
				
			}
			echo "</table></div>";			
		}
		  else
		{
		"There is some sql error encountered in status query";
		}
		$stmt->close();
}
?>
</body>
</html>