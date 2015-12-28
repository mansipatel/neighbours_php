<div class="main">
  <div class="main_resize">
    <div class="header">
      <div class="logo">
	<a href="/homePage.php" style="text-decoration: none;">
          <h1 style="display: inline;"><span style="font-weight: bold;">Neighbour </span>
	    <span style="color: gray; font-weight: bold">Space</span></h1>
	    <br />
	  <small>Share & Care</small>
	</a>
      </div>
      <div class="menu_nav">
	<b>Welcome  <?php echo $_SESSION['firstName']; ?></b>
        <ul>
          <li><a href="/profile.php">Profile</a></li>
	  <li> <a href="logout.php">Logout</a></li>
        </ul>
        <div class="clr"></div>
      </div>
    </div>
    <div class="content">
      <div class="content_bg">
        <div class="mainbar">
        </div>
        <div class="sidebar" style="height: 1100px;">
	  <?php
	     $userId = $_SESSION['userId'];
	     $filename = "images/profile_images/" . $userId . ".jpg";
	     if (file_exists($filename)){
	     echo "<div class=image-container><img src='" . $filename . "' class=profile-image></div>";
	     }
	     ?>
          <div class="gadget">
            <div class="clr"></div>
            <ul class="sb_menu">
              <li <?php if($active_link=="homePage") echo "class=active"; ?>> <a href="homePage.php">Home</a></li>
              <li <?php if($active_link=="friend_list") echo "class=active"; ?>><a href="friend_list.php">Friends</a></li>
              <li <?php if($active_link=="neighbour_list") echo "class=active"; ?>><a href="neighbour_list.php">Neighbours</a></li>
              <li <?php if($active_link=="friend_req") echo "class=active"; ?>><a href="friend_req.php">Pending Friend Requests</a></li>
              <li <?php if($active_link=="block_requests") echo "class=active"; ?>><a href="block_requests.php">Block Requests</a></li>
              <li <?php if($active_link=="messages") echo "class=active"; ?>><a href="messages.php">Feeds</a></li>
	      <li <?php if($active_link=="addFriend") echo "class=active"; ?>><a href="addFriend.php">Add Friend</a></li>
	      <li <?php if($active_link=="add_neighbour") echo "class=active"; ?>><a href="add_neighbour.php">Add Neighbour</a></li>
	      <li <?php if($active_link=="sendMessage") echo "class=active"; ?>><a href="sendMessage.php">Post Message</a></li>
		  <li <?php if($active_link=="blockChange") echo "class=active"; ?>><a href="blockChange.php">Block Change</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
