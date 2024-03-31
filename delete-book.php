<?php
include('shared/authenticate.php');
// read the bookId from the url parameter using $_GET   
$bookId = $_GET['bookId'];

if (is_numeric($bookId)) {
    // connect to db
    try {
        include('shared/databases.php');

        // prepare SQL DELETE
        $sql = "DELETE FROM books WHERE bookId = :bookId";
        $cmd = $database->prepare($sql);
        $cmd->bindParam(':bookId', $bookId, PDO::PARAM_INT);

        // execute the delete
        $cmd->execute();

        // disconnect
        $databases = null;
    }
    catch (Exception $err) {
        header('location:error.php');
        exit();
    }
    // show a message (temporarily)
    echo 'Show Deleted';

    // redirect back to updated shows.php (eventually)
    header('location:bookLibrary.php');
}
?>