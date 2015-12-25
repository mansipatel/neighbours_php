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
        <div class="sidebar">
          <div class="gadget">
            <h2 class="star"><span>Sidebar</span> Menu</h2>
            <div class="clr"></div>
            <ul class="sb_menu">
              <li <?php if($active_link=="homePage") echo "class=active"; ?> <a href="homePage.php">Home</a></li>
              <li <?php if($active_link=="friend_list") echo "class=active"; ?>><a href="friend_list.php">Friends</a></li>
              <li <?php if($active_link=="neighbours") echo "class=active"; ?>><a href="#">Neighbours</a></li>
              <li <?php if($active_link=="friend_req") echo "class=active"; ?>><a href="friend_req.php">Pending Friend Requests</a></li>
              <li <?php if($active_link=="block_requests") echo "class=active"; ?>><a href="block_requests.php">Block Requests</a></li>
              <li <?php if($active_link=="messages") echo "class=active"; ?>><a href="messages.php">Feeds</a></li>
	      <li <?php if($active_link=="add_friend") echo "class=active"; ?>><a href="#">Add Friend</a></li>
	      <li <?php if($active_link=="add_neighbour") echo "class=active"; ?>><a href="#">Add Neighbour</a></li>
	      <li <?php if($active_link=="sendMessage") echo "class=active"; ?>><a href="sendMessage.php">Post Message</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
