<?php
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "registration";

$conn = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if($_SERVER['REQUEST_METHOD'] == "POST")
{ 

  $pwd = $_POST['newpass'];
  $cpwd = $_POST['confirmpass'];
   $userid = $_SESSION['id'];
   $act = "Change Password";

  
  if(empty( $pwd)){
      header("Location: changepass.php?error= New password is required");
      exit();

    }else if(empty($cpwd)){
      header("Location: changepass.php?error=Confirming password is required");
      exit();

    } else if(!empty($pwd) && !empty($cpwd))
      {
        if( strlen($pwd ) < 8 ) {
          header("Location: changepass.php?error=Password must be atleast 8 characters");
            exit();
        }else if( !preg_match("#[0-9]+#",  $pwd ) ) {
          header("Location: changepass.php?error=Password must include at least one number!");
          exit();
        }else if( !preg_match("#[a-z]+#",  $pwd) ) {
          header("Location: changepass.php?error=Password must include at least one small letter!");
          exit();
        }else if( !preg_match("#[A-Z]+#",  $pwd ) ) {
          header("Location: changepass.php?error=Password must include at least one capital letter!");
          exit();
        }else if( !preg_match("#\W+#", $pwd )) {
          header("Location: changepass.php?error=Password must include at least one symbol!");
          exit();

        }else if($_POST['newpass'] !== $_POST['confirmpass']) {
        header("Location: changepass.php?error=Password and Confirm password should match!");
          exit();
          
        }else{

        	$em=$_SESSION['email'];

        	// echo $em;
        	$query_pass="UPDATE user_profile set password='$cpwd' where email='$em'";
          $sql4 = "INSERT INTO event_log(user_id, activity) VALUES ('$userid','$act' )";

   			  $run2 = mysqli_query($conn,$query_pass) or die(mysqli_error($conn));
          $result4 = mysqli_query($conn, $sql4) or die(mysqli_error($conn));



   			if ($run2){
   				if($result4){
              header("Location: index.php");
             }else{
             echo "Event recorder crash";
             }
   			}
   		}
   	}
   }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Change Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="" method="POST">
                    <h2 class="text-center">New Password</h2>
                    <?php if (isset($_GET['error'])) { ?>
                      <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>
                    <div class="form-group">
                        <label>New Password </label>
                        <input class="form-control" type="password" name="newpass" placeholder="Create new password" required>
                    </div>
                    <div class="form-group">
                        <label>Confirm Password </label>
                        <input class="form-control" type="password" name="confirmpass" placeholder="Confirm your password" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="change-password" value="Change">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>