<?php
session_start();
if (empty($currentSession['username'])){    //authenticate user for private pages 
    header('location:login.php');           //if user not logged in redirect
}
?>