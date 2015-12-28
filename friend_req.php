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
            <div class="clr"></div>
            <ul class="sb_menu">
             <li><a href="homePage.php">Home</a></li>
              <li><a href="friend_list.php">Friends</a></li>
              <li><a href="#">Neighbours</a></li>
              <li class="active"><a href="friend_req.php">Pending Friend Requests</a></li>
              <li><a href="block_requests.php">Block Requests</a></li>
              <li><a href="messages.php">Feeds</a></li>
			  <li><a href="#">Add Friend</a></li>
			  <li><a href="add_neighbour.php">Add Neighbour</a></li>
			   <li><a href="sendMessage.php">Post Message</a></li>
			      <li><a href="blockChange.php">Block Change</a></li>
            </ul>
          </div>
        
        
        </div>
      </div>
    </div>
  </div>

</div>

<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";
if ($stmt = $mysqli->prepare("select u.first_name , u.last_name , n.hood_address , b.block_address , fr.sender_id  from neighbours.users u , neighbours.friend_requests fr , neighbours.neighbourhoods  n , neighbours.blocks b 
where fr.sender_id = u.id  and u.hood_id = n.id and u.block_id = b.id and fr.user_id = '$userId' and fr.status = 'pending';")) {
  $stmt->execute();
  $stmt->bind_result( $first_name , $last_name , $hood_address , $block_address , $sender_id);
  $stmt->store_result();
  if($stmt != null)
  {
	 echo '</br>';
	 echo '</br>';
		 
	if($stmt->num_rows == 0)
	{
	echo '<hd>';
	echo "You have no pending friend requests";
	echo '</hd>';
	}
	else
	{
	echo '<hd>';
	echo "You have '$stmt->num_rows' pending friend requests";
	echo '</hd>';
	echo '</br>';
	echo '</br>';
	echo '</br>';
	
	echo "<div class='table-style-three'><table>
<thead><tr><th>Name</th><th>Profile</th><th>Neighbourhood</th><th>Block</th><th>Accept</th><th>Reject</th></tr></thead>";
}
      while($stmt->fetch()) {
			
echo "<tr><td> $first_name  $last_name</td><td>Profile Pic</td><td> $block_address</td><td> $hood_address</td>
<td><input type='submit' class= 'btn' name = 'Accept' value='Accept' id = 'accept.$sender_id' onClick = 'return acceptFriendReq($sender_id);'/></td>
<td><input type='submit'  class = 'btn' name = 'Reject' value='Reject' id = 'reject.$sender_id' onClick = 'rejFriendReq($sender_id)'/></td>
</tr>
";

  }
  echo "</table></div>";
  }	  
  else
  {
	echo '<hd>';
	
	echo "You have no pending friend requests";
	
	echo '</hd>';
	}
  $stmt->close();
 
}
else
{
	echo"There is some sql error encountered";
}
if(isset($_POST['Accept']))
{ 
		echo $sender_id;
		$result=$mysqli->prepare('CALL neighbours.accept_friend_request(? , ? , "accepted" ,@return_bit)'); 
		$result->bind_param("ii",$userId , $sender_id);
		$result->execute();
		echo '<script> alert("Success"); </script>';
		header("Refresh:0");
}
if(isset($_POST['Reject']))
{ 
		echo $sender_id;
		$result=$mysqli->prepare('CALL neighbours.decline_friend_request(? , ? , "rejected" ,@return_bit)'); 
		$result->bind_param("ii",$userId , $sender_id);
		$result->execute();
		echo '<script> alert("Success"); </script>';
}
echo '</form>';
?>
</body>

</html>