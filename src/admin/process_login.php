<?php
  error_reporting(E_ALL);
  ini_set('display_errors','On');
  require_once("../config/init.php");

 
  sec_session_start(); // Our custom secure way of starting a PHP session.
/*
print_r($_POST);
echo "<br />";
*/
 
if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
 
    if (login($email, $password, $mysqli) == true) {
        // Login success 
        //echo "Inde";
        header('Location: start.php');
    } else {
        // Login failed 
        //echo "Ude";
        header('Location: index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    /*
    $fejlTxt     = "The correct POST variables were not sent to this page.";
    $script_name = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    $errorPage   = "../error.php?err=$fejlTxt&page=".$script_name; 
    //header("Location: $errorPage");
    */
    echo "Error";
}

?>