<html>
<?php
     
    	session_start();
     	include "connectdb.php";
    ?>

  	<?php
    	$_SESSION['email'] = $_POST["email"];
     	
     	if (isset($_POST['first_name'])){
     		// echo $_POST['email'];
     		echo '<form action="upload.php" method="post" enctype="multipart/form-data">
    				Select image to upload:
    				<input type="file" name="fileToUpload" id="fileToUpload">
    				<input type="submit" value="Upload Image" name="submit">
					</form>';
			$target_dir = "uploads/";
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
     	}
     	else
     	{
     		$input_email = $_POST["email"];
     		$input_pass = $_POST["password"];
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
