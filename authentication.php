<?php 

session_start(); 
 $server="localhost";
 $aunmae="root";
 $apassword = "";
 $db_name = "registration";





 $conn2 = mysqli_connect($server, $aunmae, $apassword, $db_name);


 





date_default_timezone_set('Asia/Manila');
$currentDate = date('Y-m-d H:i:s');



if(isset($_POST['sub']))
{ 
    if(empty(trim($_POST["codebox"]))){
        header("Location: index.php?error=Please Enter the Authentication Code");
		exit();
    } else{ 

        
        $codebox = $_POST['codebox'];
        $userid = $_SESSION['id'];
        $act = "Login";
        
		$sql_code = "SELECT * FROM authentication WHERE a_code='$codebox'";

		$result2 = mysqli_query($conn2, $sql_code);

		$sql3 = "SELECT exp_time FROM authentication where a_code='$codebox'";
        $result3 = mysqli_query($conn2, $sql3);

        $sql4 = "INSERT INTO event_log(user_id, activity) VALUES ('$userid','$act' )";

		

		if(mysqli_num_rows($result2) === 1) {
			$row2 = mysqli_fetch_assoc($result2);
			if($row2['a_code'] === $codebox){
			$_SESSION['a_code'] = $row2['a_code'];
			$_SESSION['authen_id'] = $row2['authen_id'];
				if (mysqli_num_rows($result3) === 1){
					 $row3 = mysqli_fetch_assoc($result3);
                	if(($row3["exp_time"]) > ($currentDate)){
						$result4 = mysqli_query($conn2, $sql4) or die(mysqli_error($conn2));
				            if($result4){
							header("Location: frontpage.php");	
							}
							else{
							echo "Event recorder crash";
							}
			}
		}else{
			header("Location: authentication.php?error=Incorrect Code");
			exit();
		}
       }else{
			header("Location: authentication.php?error=Incorrect Code ");
			exit();
		}
        
     

       }
          
    }
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Authenticator</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="modal/bootstrap.min.css">
    <script type="text/javascript" src="modal/jquery.min.js"></script>
    <script type="text/javascript" src="modal/popper.min.js"></script>
    <script type="text/javascript" src="modal/bootstrap.min.js"></script>
</head>
<body>



	
<!-- Trigger/Open The Modal -->
				<button id="myBtn">Click Here to Authenticate</button>
				<!-- The Modal -->
				<form action="" method="POST" class="form2">
				<div id="myModal" class="modal">

				  <!-- Modal content -->
				  <div class="modal-content">
				    <span class="close">&times;</span>
				    <h4>Authentication Code</h4>
				    <?php if (isset($_GET['error'])) { ?>
			<p class="error"><?php echo $_GET['error']; ?></p>
						<?php } ?>
				    <input type="text" name="codebox" placeholder="Type here the Authentication Code">
				    <input type="submit"class="btn btn-primary" value="Submit" name="sub">
				  </div>

				</div>
				</form>

				<a href="random-code.php" style="color: red;" target="_blank" >GET CODE</a>



<script>
	// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>


</body>
</html>	