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

try{
    include('shared/databases.php');    

    $sql = "SELECT * FROM bookUsers WHERE username = :username";
    $cmd = $database->prepare($sql);
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);           //Checking db for existing user
    $cmd->execute();
    $users = $cmd->fetchAll();

    if (!empty($users)) {
        $database = null;
        header('location:register.php?duplicate=true');
        exit();
    }

    $sql = "INSERT INTO bookUsers (username, password) VALUES (:username, :password)"; 
    $cmd = $database ->prepare($sql);       
    $cmd->bindParam(':username', $username, PDO::PARAM_STR, 50);          //Insert new user into database       
    $cmd->bindParam(':password', $passwordEncrypt, PDO::PARAM_STR, 255);
    $cmd->execute();

    //Disconnect from database
    $database = null;
}
catch (Exception $err) {
    header('location:error.php');
    exit();
}
    
//confirmation
echo 'User Created';

//Redirect new user to login page
?>