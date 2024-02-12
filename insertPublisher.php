<?php
$pageTitle = 'Saving new Publisher entry...';
include('shared/header.php');

$publisherName = $_POST['publisherName'];  
$check = true;

if (empty($publisherName)) {
    $check = false;
    echo 'Publisher name is required';
} else { 
    include('shared/databases.php');

    $sql = "INSERT INTO bookPublishers (publisherName) VALUES (:publisherName)";  
    $cmd = $database->prepare($sql);
    $cmd->bindParam(':publisherName', $publisherName, PDO::PARAM_STR, 75);
    $cmd->execute();

    $database = null;
    echo 'Publisher Saved';
}
?>
</body>
</html>
