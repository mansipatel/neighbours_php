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

</div>

<?php
$sender_id = 0;
echo '<form method  ="post">';
$requests = "";
if ($stmt = $mysqli->prepare("select u.status , u.block_id from neighbours.users u where u.id = '$userId'")) 
	/*To ensure only members of that block can view the requests made by people wishing to join that block */
{
		$stmt->execute();
		$stmt->bind_result($status , $block_id);
		if($stmt != null)
		{
			while($stmt->fetch()) {
			$statusCheck = $status;	
		}
		}
		  else
		{
		"There is some sql error encountered in status query";
		}
		$stmt->close();
}
				if($statusCheck == 'confirmed') //So only users who are accepted members of that block can view the block requests and not anyone else
				{
					if ($stmt2 = $mysqli->prepare("SELECT u.first_name,u.last_name,n.hood_address,b.block_address,u.id
													FROM
												neighbours.neighbourhoods n,neighbours.blocks b,neighbours.users u
												LEFT OUTER JOIN neighbours.block_requests br 
												ON br.requester_id = u.id
												WHERE
												u.status = 'pending'
												AND u.hood_id = n.id
												AND u.block_id = b.id
												AND u.block_id = '$block_id'
												AND NOT EXISTS (select br.approver_id from  neighbours.block_requests br where br.approver_id = '$userId' and br.requester_id = u.id)"))
					{
					$stmt2->execute();
					$stmt2->bind_result( $first_name , $last_name , $hood_address , $block_address , $sender_id);
					    $stmt2->store_result();
						if($stmt2 != null)
							{
							echo '</br>';
							echo '</br>';
							if( $stmt2->num_rows > 0)
							{
							echo '<hd>';
							echo "You have pending block requests";
							echo '</hd>';	
							echo '</br>';
							echo '</br>';
	
							echo "<div class='table-style-three'><table>
							<thead><tr><th>Name</th><th>Profile</th><th>Neighbourhood</th><th>Block</th><th>Accept</th><th>Reject</th></tr></thead>";
							}
							while($stmt2->fetch()) {
								echo '<hd>';
								echo '</hd>';
								echo "<tr><td> $first_name  $last_name</td><td>Profile Pic</td><td> $block_address</td><td> $hood_address</td>
								<td><input type='submit' class= 'btn' name = 'Accept' value='Accept' id = 'accept.$sender_id' onClick = 'return acceptFriendReq($sender_id);'/></td>
								<td><input type='submit'  class = 'btn' name = 'Reject' value='Reject' id = 'reject.$sender_id' onClick = 'rejFriendReq($sender_id)'/></td>
								</tr>";

							}
						echo "</table></div>";
							}	  
						else
							{
							echo"There is some sql error encountered in block_requests query";
							}
					 $stmt2->close();
					}
				}
				
				if(isset($_POST['Accept']))
				{
				$query = "insert into  neighbours.block_requests ( approver_id ,requester_id ) values (?,?)";
				$stmt = $mysqli->prepare($query);
				$stmt->bind_param("ii", $userId , $sender_id);
				if($stmt->execute())
				$stmt->close();
				}			
		
  



$mysqli->close();
echo '</form>';
?>
</body>
</html>
