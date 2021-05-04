<?php
session_start();

 $server="localhost";
 $aunmae="root";
 $apassword = "";
 $db_name = "login_db";
 $conn2 = mysqli_connect($server, $aunmae, $apassword, $db_name);
//session_unset();
//session_destroy();
 $id = $_SESSION['userid'];
 $act = "Logout";

 $sql4 = "INSERT INTO event_log(userid, activity) VALUES ('$userid','$act' )";
 $result4 = mysqli_query($conn2, $sql4) or die(mysqli_error($conn2));
 if($result4){
 header("Location: index.php");
 }else{
 echo "Event recorder crash";
 }

