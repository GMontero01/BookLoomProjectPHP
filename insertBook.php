<?php 
$pageTitle = "Saving your new book entry...";
include('shared/header.php');

// get input from user and store in vars
$bookTitle = $_POST['bookTitle'];
$bookAuthor = $_POST['bookAuthor'];
$publishYear = $_POST['publishYear'];
$bookGenre = $_POST['bookGenre'];
$streamingService = $_POST['streamingService'];
$madeIntoMovie = $_POST['madeIntoMovie'];
$bookPublisher = $_POST['bookPublisher'];
$check = true;

if (empty($bookTitle) || empty($bookGenre) || empty($streamingService) || empty($publishYear) || empty($bookAuthor) || empty($madeIntoMovie) || empty($bookPublisher)) {
    // Checking if any field is empty 
    echo 'All entries are required<br />';
    $check = false;
}

if(is_numeric($publishYear)){                                 //Published Year must be > 1700
    if ($publishYear < 1700){
        echo 'Publish year must be post 1700';
        $check = false;
    }
}
else{
    echo 'Publish year must be a year before 1700';
    $check = false;
}

if ($check == true){
    include('shared/databases.php');    //Initializing the database
    $sql = "INSERT INTO books (bookTitle, bookAuthor, publishYear, bookGenre, streamingService, madeIntoMovie, bookPublisher) 
    VALUES (:bookTitle, :bookAuthor, :publishYear, :bookGenre, :streamingService, :madeIntoMovie, :bookPublisher)";
    $cmd = $database->prepare($sql);    //link data base with sql cmd

    $cmd->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR, 255);
    $cmd->bindParam(':bookAuthor', $bookAuthor, PDO::PARAM_STR, 255);
    $cmd->bindParam(':publishYear', $publishYear, PDO::PARAM_INT);
    $cmd->bindParam(':bookGenre', $bookGenre, PDO::PARAM_STR, 75);                      //Maping each input to its own collumn 
    $cmd->bindParam(':streamingService', $streamingService, PDO::PARAM_STR, 75);
    $cmd->bindParam(':madeIntoMovie', $madeIntoMovie, PDO::PARAM_BOOL);
    $cmd->bindParam(':bookPublisher', $bookPublisher, PDO::PARAM_STR, 75);

    $cmd->execute();

    $database = null;

    echo 'Book saved to Book Library';
}
?>
</body>
</html>
