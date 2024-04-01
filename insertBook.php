<?php 
include('shared/authenticate.php');
//page title and shared header
$pageTitle = "Saving your new book entry...";
include('shared/header.php');




if  ($_FILES['bookCover']['size'] > 0){
    $pictureName = $_FILES['bookCover']['name'];
    $uniqueName = session_id() . '-' . $pictureName;
    

    $pictureSize = $_FILES['bookCover']['size'];
    

    $tempServerLocation = $_FILES['bookCover']['tmp_name'];
    

    $type = mime_content_type($tempServerLocation);
    

    if($type != 'image/png' && $type != 'image/jpeg'){
        echo 'Photo must be a .png or .png';
        exit();
    }else{
       move_uploaded_file($tempServerLocation, 'images/bookCovers/' . $uniqueName); 
    }
    
}

// get input from user and store in vars
$bookTitle = $_POST['bookTitle'];
$bookAuthor = $_POST['bookAuthor'];
$publishYear = $_POST['publishYear'];
$bookGenre = $_POST['bookGenre'];
$streamingService = $_POST['streamingService'];
$madeIntoMovie = $_POST['madeIntoMovie'];
$bookPublisher = $_POST['bookPublisher'];
$check = true;

if (empty($bookTitle)){
    // Checking if any field is empty 
    echo 'Title is required <br />';
    $check = false;
}
if (empty($bookGenre)){  
    echo 'Book genre is required <br />';
    $check = false;
}
if (empty($streamingService)) {
    echo 'All entries are required<br />';
    $check = false;
}
if (empty($publishYear) ) {
    echo 'Publish year is required <br />';
    $check = false;
}
if (empty($bookAuthor)) {
    echo 'Author is required<br />';
    $check = false;
}
if (empty($madeIntoMovie)) {
    echo 'Made into movie is required <br />';
    $check = false;
}
if (empty($bookPublisher)) {
    echo 'Book Publisher is required <br />';
    $check = false;
}

if(is_numeric($publishYear)){                       //Published Year must be > 1700
    if ($publishYear < 1700){
        echo 'Publish year must be post 1700';
        $check = false;
    }
}
else{
    echo 'Publish year must be a year before 1700'; 
    $check = false;                                 //ensures miss entry are not inserted into the database
}

if ($check == true){
    try {
        include('shared/databases.php');    //Initializing the database
        $sql = "INSERT INTO books (bookTitle, bookAuthor, publishYear, bookGenre, streamingService, madeIntoMovie, bookPublisher,bookCover) 
        VALUES (:bookTitle, :bookAuthor, :publishYear, :bookGenre, :streamingService, :madeIntoMovie, :bookPublisher, :bookCover)";
        $cmd = $database->prepare($sql);    //link data base with sql cmd

        $cmd->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR, 255);
        $cmd->bindParam(':bookAuthor', $bookAuthor, PDO::PARAM_STR, 255);
        $cmd->bindParam(':publishYear', $publishYear, PDO::PARAM_INT);
        $cmd->bindParam(':bookGenre', $bookGenre, PDO::PARAM_STR, 75);                      //Maping each input to its own collumn 
        $cmd->bindParam(':streamingService', $streamingService, PDO::PARAM_STR, 75);
        $cmd->bindParam(':madeIntoMovie', $madeIntoMovie, PDO::PARAM_BOOL);
        $cmd->bindParam(':bookPublisher', $bookPublisher, PDO::PARAM_STR, 75);
        $cmd->bindParam('bookCover', $uniqueName, PDO::PARAM_STR, 100);

        $cmd->execute();

        $database = null;
        
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
    
    header('location:bookLibrary.php');
}
?>
</body>
</html>
