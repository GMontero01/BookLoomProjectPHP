<?php
$username = $_POST['username'];                 //Get username and 
$password = $_POST['password'];                 //password from user
try {
    include('shared/databases.php');                //Connect to db 
    $sql = "SELECT * FROM bookUsers WHERE username = :username";
    $cmd = $database->prepare($sql);                        
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);    
    $cmd->execute();
    $existingUser = $cmd->fetch();

    if (empty($existingUser)){
        $database = null;                           //look for username in db
        header('location:login.php?invalid=true');
    }

    if (!password_verify($password, $existingUser['password'])){
        $database = null;                           //user is valid check for password
        header('location:login.php?invalid=true');

    }else{                                          //Login valid username and 
        session_start();                            //password match user in db 
        $_SESSION['username'] = $username;    //Store user identity in Session var 
        $database = null;
        header('location:bookLibrary.php');
    }  
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>