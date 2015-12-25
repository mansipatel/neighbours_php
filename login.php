<html>
<?php
     
    	session_start();
     	include "connectdb.php";
     	include "include.php";
    ?>

  	<?php
    	$_SESSION['email'] = $_POST["email"];
     	
     	$input_email = $_POST["email"];
     	$input_pass = $_POST["password"];
     	$input_firstname = $_POST["first_name"];
     	$input_lastname = $_POST["last_name"];
     	$input_username = $_POST["username"];
     	$input_zip = $_POST["zip"];
     	$creation_date = date('Y-m-d H:i:s');
     	if (isset($_POST['first_name'])){
     		// echo $_POST['email'];
     		$input_zip = $_POST["zip"];
     		$query = "insert into  neighbours.users(username ,email, password, first_name, last_name,creation_date,zip)
     		 values (?,?,?,?,?,?,?)";
				$stmt = $mysqli->prepare($query);
				$stmt->bind_param("vii", $input_username , $input_email, $input_pass, 
					$input_firstname, $input_lastname, $creation_date, $input_zip);
				if($stmt->execute())
				$stmt->close();
				header('Location: homePage.php');
					exit;
     	}
     	else
     	{
     
     		// echo $input_email;
     		// echo $input_pass;
     		//$query = 'select * from neighbours.users where email= "mpatel08@yahoo.com" and password="UYBn678"';
     		$query = 'select email,password from neighbours.users 
     			where email="' . $input_email . '" and password="' . $input_pass . '"';
     		// echo $query;

     		$stmt = $mysqli->prepare($query);
     		if($stmt) 
     		{
     			echo "inhere";
  				$stmt->execute();
			  	$stmt->bind_result($email, $password);
			  	$stmt->store_result();
			  	$stmt->fetch();
			  	
			  	if($input_email == $email && $input_pass == $password)
			  		
			  	{

			  			header('Location: homePage.php');
					exit;
			  	}
				else
		  		{
			  		header('Location: index.html');
			  		echo "Check username and Password!!";

			  		exit;
		  		}
			}
		  	else
		  	{
			  	header('Location: index.html');
			  	echo "<h2>Check username and Password!!</h2>";
			  	exit;
		  	}
	  		
		}
	?>
</HTML>
