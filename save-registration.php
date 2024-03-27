<?php
$username = $_POST['username'];
$password = $_POST['password'];                //Get form input from user
$confirm = $_POST['confirm'];               
$check = true;


if (empty($username)) {
    echo 'Username is required<br />';          //Validate user input
    $check = false;
}

if (strlen($password) < 8) {
    echo '8-Char Password is required<br />';
    $check = false;
}

if ($password != $confirm) {
    echo 'Passwords must match<br />';
    $check = false;
}

$passwordEncrypt = password_hash($password, PASSWORD_DEFAULT);       //Encrypt user password

include('shared/databases.php');            
$sql = "INSERT INTO bookUsers (username, password) VALUES (:username, :password)"; 
$cmd = $database ->prepare($sql);//Connect and insert new user into database       
$cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);                   //Connect to db and insert user
$cmd->bindParam(':password', $passwordEncrypt, PDO::PARAM_STR, 255);
$cmd->execute();

//Disconnect from database
$database = null;

//confirmation
echo 'User Created';

//Redirect new user to login page
?>