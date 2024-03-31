<?php
include('shared/authenticate.php');
//page title and shared header
$pageTitle = 'Saving new Publisher entry...';
include('shared/header.php');

//store user input in variable
$publisherName = $_POST['publisherName'];  
$check = true;

//if statement to ensure field is not empty 
if (empty($publisherName)) {
    $check = false;
    echo 'Publisher name is required';
} else {
    try{ 
        include('shared/databases.php');  //include shared database file

        $sql = "INSERT INTO bookPublishers (publisherName) VALUES (:publisherName)";  //specify, prepare and save changes to the bookPublisher table
        $cmd = $database->prepare($sql);
        $cmd->bindParam(':publisherName', $publisherName, PDO::PARAM_STR, 75);
        $cmd->execute();

        $database = null;
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
        echo 'Publisher Saved';
}
?>
</body>
</html>
