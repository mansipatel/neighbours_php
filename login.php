<html>
<?php
     
    	session_start();
     	include "connectdb.php";
     	#include "include.php";
    ?>

  	<?php
    	$_SESSION['email'] = $_POST["email"];
     	
     	if (isset($_POST['first_name'])){

//getting all values from sign up
	     	$input_email = $_POST["email"];
	     	$input_pass = $_POST["password"];
	     	$input_firstname = $_POST["first_name"];
	     	$input_lastname = $_POST["last_name"];
	     	$input_username = $_POST["username"];
	     	$input_zip = $_POST["zip"];
	     	$creation_date = date('Y-m-d H:i:s');
	     	$last_login = date('Y-m-d H:i:s');
	     	$status = "pending";
	     	

// getting hood id
	     	$stmt1 = $mysqli->prepare('select id from neighbours.neighbourhoods 
     			where zip="' . $input_zip . '"');
	     	if($stmt1) 
     		{
  				$stmt1->execute();
			  	$stmt1->bind_result($hood_id);
			  	$stmt1->store_result();
			  	$stmt1->fetch();
			 }

// getting block id
			 $stmt2 = $mysqli->prepare('select id from neighbours.blocks 
     			where hood_id="' . $hood_id . '"');
	     	if($stmt2) 
     		{
  				$stmt2->execute();
			  	$stmt2->bind_result($block_id);
			  	$stmt2->store_result();
			  	$stmt2->fetch();
			 
//echo $hood_id . ';'. $block_id;

	     		$query = "insert into  neighbours.users(username ,email, password, first_name,
	     			 last_name,creation_date,last_login_time, hood_id, block_id, status, zip)
	     		 values (?,?,?,?,?,?,?,?,?,?,?)";
	     		// echo $query;
				$stmt = $mysqli->prepare($query);
				$stmt->bind_param("sssssssiisi", $input_username , $input_email, $input_pass, 
						$input_firstname, $input_lastname, $creation_date, $last_login,
						 $hood_id, $block_id, $status,$input_zip);
				
				if($stmt->execute()){
					// echo "I am in right page";
					// die();
					header('Location: homePage.php');
					exit;
					$stmt->close();
				}
				else{
               		echo "hi";
               		echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//                header('Location: index_error.html');
			  	// echo "<h2>Check username and Password!!</h2>";
			  	// exit;
				}
			}

	        else{
               echo "hi";
               echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
//                header('Location: index_error.html');
			  	// echo "<h2>Check username and Password!!</h2>";
			  	// exit;
			}
		

     	}
     	else
     	{
     		$input_email = $_POST["email"];
     		$input_pass = $_POST["password"];
     		$query = 'select email,password from neighbours.users 
     			where email="' . $input_email . '" and password="' . $input_pass . '"';
     		
     		$stmt = $mysqli->prepare($query);
     		if($stmt) 
     		{
  				$stmt->execute();
			  	$stmt->bind_result($email, $password);
			  	$stmt->store_result();
			  	$stmt->fetch();
			  	
			  	if($input_email == $email && $input_pass == $password)
			  		
			  	{
			  		$_SESSION['username']='logged_in';
	                $query = 'update neighbours.users set last_login_time = NOW() where email="' . $input_email .'"';
	          
					$stmt = $mysqli->prepare($query);
						
					if($stmt->execute()){
					$stmt->close();
					}
	                header('Location: homePage.php');
					exit;
			  	}
				else
		  		{
			  		header('Location: index_error.html');
			  		echo "Check username and Password!!";

			  		exit;
		  		}
			}
		  	else
		  	{
			  	header('Location: index_error.html');
			  	echo "<h2>Check username and Password!!</h2>";
			  	exit;
		  	}
	  		
		}
	?>
</HTML>
