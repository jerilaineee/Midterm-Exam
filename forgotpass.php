<!DOCTYPE html>
<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registration";

$conn3 = mysqli_connect($dbhost ,$dbuser,$dbpass,$dbname);

if(isset($_POST['submitn']))
{ 
        $myemail = $_POST['email'];
        
		$query_email= "SELECT * FROM user_profile WHERE email='$myemail'";
		$exist_em = mysqli_query($conn3, $query_email);

		$resultmails = mysqli_query($conn3, $query_email);

		if (empty($myemail)){
				header("Location: forgotpass.php?error= Enter your verified email");
						exit();

		}else if (!filter_var($myemail, FILTER_VALIDATE_EMAIL)) {
       header("Location: forgotpass.php?error=Invalid email");
        exit();

        }else if(mysqli_num_rows($exist_em) < 1 ){
			header("Location: forgotpass.php?error= The Email Address Doesn't exists");		
			exit();	

		}else if(mysqli_num_rows($resultmails) === 1) {

			$row3 = mysqli_fetch_assoc($resultmails);
			 $_SESSION['email'] = $row3['email'];
			if($row3['email'] === $myemail){

					header("Location: changepass.php");
                 
		           	
		       			}
					}
				}

		?>
<html>
<head>
	<title>Forgot Password</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
	<div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="" method="POST">
                    <h2 class="text-center">Forgot Password</h2>
                    <?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
					<?php } ?>
                    <p class="text-center">Enter your email Address</p>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter your Email Address">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="submitn" value="Continue">
                    </div>
                </form>
            </div>
        </div>
    </div>
<body>

</body>
</html>