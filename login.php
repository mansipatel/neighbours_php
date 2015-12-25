<html>
	<?php
     
    	session_start();
     	include "connectdb.php";
    ?>

  	<?php
    	$_SESSION['email'] = $_POST["email"];
     	header('Location: homePage.php');
		exit;
  //    	if (isset($_POST['first_name'])){
  //    		echo $_POST['email'];
  //    		echo "<body> <h1>My Example</h1>";
  //    	}
  //    	else
  //    	{
  //    		$input_email = $_POST["email"];
  //    		$input_pass = $_POST["password"];
  //    		echo $input_email;
  //    		echo $input_pass;
  //    		//$query = 'select * from users where email= "mpatel08@yahoo.com" and password="UYBn678"';
  //    		$query = 'select * from users where email=$input_email and password=$input_pass';
  //    		$stmt = $mysqli->prepare($query);
  //    		// echo "Hello";	
  //    		// echo $stmt;
  //    		// echo "Hello you ";	
  //    		if($stmt != null) 
  //    		{
  // 				echo "Hello there";
		// 		$stmt->execute();
		// 	  	$stmt->bind_result($pa);
		// 	  	if($stmt != null)
		// 	  	{
		// 		  header('Location: homePage.php');
		// 		  exit;
		// 		}
		// 	  	else
		// 	  	{
		// 	  		echo "Hello there";	
		// 		  	header('Location: index.html');
		// 		  	print "Invalid email or password";
		// 		  	exit;
		//   		}
		//   	}
		//   	else
		//   	{
		//   		echo "Hello there";
		// 	  	// header('Location: index.html');
		// 	  	echo "Please Signup!!";
		// 	  	exit;
		//   	}
	  		
		// }
	?>
</HTML>
