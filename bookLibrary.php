<?php
// Page title and shared header
$pageTitle = 'Book Library';
include('shared/header.php');
include('shared/databases.php'); // shared database include

//prepare to retrieve from sql database
$sql = "select * from books";
$cmd = $database->prepare($sql);

//retrieve and fetch all entries that were specified
$cmd->execute();
$books = $cmd->fetchAll();

// echo out the table to the site
    echo'<h2>Book Library</h2>';
    echo '<table><thead><tr><th>Book Title</th><th>Book Author</th><th>Publish Year</th><th>Book Genre</th><th>Book Publisher</th><th>Made Into Movie</th><th>Streaming Service</th></tr></thead><tbody>';

    foreach ($books as $books){ 
        echo '<tr>
            <td>'.$books['bookTitle'].'</td>
            <td>'.$books['bookAuthor'].'</td>
            <td>'.$books['publishYear'].'</td>
            <td>'.$books['bookGenre'].'</td>
            <td>'.$books['bookPublisher'].'</td>
            <td>'.$books['madeIntoMovie'].'</td>
            <td>'.$books['streamingService'].'</td>
            </tr>';
        }

    echo '</table>';

$database = null;
?>
</main>