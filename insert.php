<?php 
	$conn = new mysqli('localhost','root','','registration');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {
		$stmt = $conn->prepare("insert into user_profile(username, password, email) values(?, ?, ?)");
		$stmt->bind_param("sss", $username, $password, $email);
		$execval = $stmt->execute();
		echo $execval;
		
		
		$stmt->close();
		$conn->close();
		header("Location: registration.php");
	}
 ?>