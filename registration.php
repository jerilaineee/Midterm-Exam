<?php include 'dbcon.php'

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	 <link rel="stylesheet" type="text/css" href="bootstrap\css\bootstrap.min.css">
	 <link rel="stylesheet" href="style.css">

</head>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery-2.1.1.min.js"></script> 
<script type="text/javascript">
var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Password matched!';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'These passwords do not match.';

  }
}
</script> 
<script type="text/javascript">
function checkPasswordStrength() {
  var number = /([0-9])/;
  var alphabets = /([a-zA-Z])/;
  var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
  
  if($('#password').val().length<8) {
    $('#password-strength-status').removeClass();
    $('#password-strength-status').addClass('weak-password');
    $('#password-strength-status').html("Weak (should be atleast 8 characters.)");
  } else {    
      if($('#password').val().match(number) && $('#password').val().match(alphabets) && $('#password').val().match(special_characters)) {            
      $('#password-strength-status').removeClass();
      $('#password-strength-status').addClass('strong-password');
      $('#password-strength-status').html("Strong");
        } else {
      $('#password-strength-status').removeClass();
      $('#password-strength-status').addClass('medium-password');
      $('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
        } 
  }
}
</script>

<body>

<div>

	<?php
		session_start();
		
		

	if (isset($_POST['sgnp'])){

			$username=($_POST['username']);
			$password=($_POST['password']);
			$email 		= ($_POST['email']);
			$confirm_password 	= ($_POST['confirm_password']);
				

			$query = "insert into user_profile (username,password,email) values('$username', '$password', '$email')";
			
			$run = mysqli_query($conn,$query) or die(mysqli_error($conn));

			if ($run){
				header('Location: index.php');
			}
			else{
				echo "Form not submitted";
				}
			}
		
	
	?>
</div>

<div>
	<form action="registration.php" method="post">
		<div class="container">

			<div class="row">
				<div class="col-sm-3" style="margin: auto;">

					<h2 style="text-align: center;"><font size = "22px">Registration</font></h2>
					<p>Kindly fill out the following field.</p>
					<hr class="mb-3">
						
					<div class="form-group floating-label">
						<label for="username"><b>Username</b></label>
						<input class="form-control" placeholder="Username" type="text" name="username" required><br>
					</div>

					<div class="form-group floating-label">
	          			<div name="pass" id="pass">
				       	 <label for="pass">Password</label>
				         <input type="password"  id="password" class="form-control" placeholder="Password" id="pass" name="password" required onKeyUp="checkPasswordStrength();"> <br>
				        	<div id="password-strength-status"></div>   
	                    </div>     
	                </div> 

	                <div class="form-group floating-label">
	                    <div name="pass" id="pass">
		                    <label for="pass">Confirm Password</label>
		                    <input type="password" onkeyup='check();' id="confirm_password" class="form-control" placeholder="Confirm Password" id="pass" name="confirm_password" required><br>
		                    <span id='message'></span> 
	                   </div>         
	                </div>

					<label for="email"><b>Email Address</b></label>
					<input class="form-control" placeholder="Email Address" type="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Incorrect Format of Email Address"><br>

					<hr class="mb-3">
					<input class="btn btn-primary" type="submit" class="button" value="Register" name="sgnp">

					<form action="index.php" method="post">
						<input type="submit" class="btn btn-primary" value="Back" name="back">
					</form>
					
				</div>
			</div>
		</div>
	</form>

</div>
					
					
</body>
</html>