<?php 
  require_once("dbcon.php");
 ?>

<!DOCTYPE html>
<html>
  <head>
    <style> 
     
      body
        {
           background-image: url("coffee.jpg");
           background-color: #cccccc;
           height: 500px;
           background-position: center;
           background-repeat: no-repeat;
           background-size: auto;
           font-family: Arial, Helvetica, sans-serif;
           font-size: 12px;
          
        }
      .login 
        {
          border-radius: 20px;
          display: inline-block;
          background-color: rgba(255, 176, 102, 0.46);
          padding: 20px;
          width: 350px;
          margin:  140px 440px;

        }
      input[type=text], input[type=password]
        {
          width: 100%;
          padding: 12px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
          margin-top: 6px;
          margin-bottom: 16px;
          resize: vertical;
        }
      .forgot
        {
          width: 100%;
          padding: 12px;
        } 
      .button 
        {
          background-color: dodgerblue;
          border: none;
          color: white;
          padding: 15px 32px;
          text-align: center;
          text-decoration: none;
          display: inline-block;
          width: 100%;
          font-size: 15px;
          margin: 4px 2px;
          cursor: pointer;
        }
    </style>
    <title>LOGIN FORM</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="modal/bootstrap.min.css">
    <script type="text/javascript" src="modal/jquery.min.js"></script>
    <script type="text/javascript" src="modal/popper.min.js"></script>
    <script type="text/javascript" src="modal/bootstrap.min.js"></script>
  </head>
  <body>
    <form action="login1.php" method="post">
      <div class="login">
        <h3 style="text-align: center;">LOGIN FORM</h3>
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
         <?php } ?>
        <!-- Username Textbox -->
        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="username">
        <!-- Password Textbox -->
        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password">
        <!-- Login Button -->
        <input type="submit" class="btn btn-primary" value="Log In" name="loginbt">
        <span class="forgot"><a href="forgotpass.php">Forgot Password?</a></span>
        <span class="register" style="text-align: center;"><a href="registration.php">Sign Up</a></span>  
      </div>
    </form>

  </body>
</html>