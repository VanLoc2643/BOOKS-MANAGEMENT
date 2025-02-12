<?php
    session_start();
   
    unset($_SESSION['dangnhapthanhcong']);
   
    if (isset($_COOKIE["remember"])) {//cookie
        setcookie('remember', $email, time() + 0); 
    }
    session_destroy(); 
    header("Location: login.php"); 
 
?>


