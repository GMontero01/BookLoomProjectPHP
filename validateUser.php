<?php
$username = $_POST['username'];                 //Get username and 
$password = $_POST['password'];                 //password from user

include('shared/databases.php');                //Connect to db 
$sql = "SELECT * FROM users WHERE username = :username";
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
    $currentSession['username'] = $username;    //Store user identity in currentSession var 
    $database = null;
    header('location:bookLibrary.php');
}
?>