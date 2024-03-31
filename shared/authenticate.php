<?php
session_start();
if (empty($_SESSION['username'])){    //authenticate user for private pages 
    header('location:login.php');           //if user not logged in redirect
}
?>