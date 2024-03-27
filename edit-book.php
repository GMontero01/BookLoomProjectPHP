<?php
include('shared/authenticate.php');
$pageTitle = 'Edit Book';
include('shared/header.php');

// get the bookId from the url param using $_GET
$bookId = $_GET['bookId'];

//initialize variables
$bookTitle = null;
$bookAuthor = null;
$publishYear = null;
$bookGenre = null;
$bookPublisher = null;
$madeIntoMovie = null;
$streamingService = null;

// if numeric fetch show from db
if (is_numeric($bookId)){
    //connect
    include('shared/databases.php');

    //run query and populate form for display
    $sql = "SELECT * FROM books WHERE bookId = :bookId";
    $cmd = $database->prepare($sql);
    $cmd->bindParam(':bookId', $bookId, PDO::PARAM_INT);
    $cmd->execute();
    $book = $cmd->fetch();

    $bookTitle = $book['bookTitle'];
    $bookAuthor = $book['bookAuthor'];
    $publishYear = $book['publishYear'];
    $bookGenre = $book['bookGenre'];
    $bookPublisher = $book['bookPublisher'];
    $madeIntoMovie = $book['madeIntoMovie'];
    $streamingService = $book['streamingService'];
    
}
 

?>

<h2>Edit Book Details</h2>
<!-- Form to capture user input for new book entry -->
<form action="update-book.php" method="post">

    <div class="bookDetails">
        <label for="bookTitle">Book Title:</label>
        <input type="text" id="bookTitle" name="bookTitle" required value="<?php echo $bookTitle; ?>" />

        <label for="bookAuthor">Book Author:</label>
        <input type="text" id="bookAuthor" name="bookAuthor" required value="<?php echo $bookAuthor; ?>" />
    
        <label for="publishYear">Publish Year:</label>
        <input name="publishYear" id="publishYear" required placeholder="1900" type="number" min="1700" value="<?php echo $publishYear; ?>" />

        <label for="bookGenre">Book Genre:</label>
        <input type="text" id="bookGenre" name="bookGenre" required value="<?php echo $bookGenre; ?>" />
        
        <div>
        <label for="bookPublisher">Book Publisher:</label>
        <select name="bookPublisher" id="bookPublisher" required> 
            <!-- Connect and pull database for publisher names -->
            <?php
            $sql = "SELECT * FROM bookPublishers ORDER BY publisherName"; // Change 'name' to 'publisherName'
            $cmd = $database->prepare($sql);
            $cmd->execute();
            $publishers = $cmd->fetchAll();

            //check each service and select the one that matches
            foreach ($publishers as $publisher){
                if ($publisher['publisherName'] == $bookPublisher) {
                    echo '<option selected>' . $publisher['publisherName'] . '</option>';
                }
                else{
                    echo '<option>' . $publisher['publisherName'] . '</option>'; // Change 'bookPublisher' to 'publisherName'
                }
                
            }
           // $database = null;
            ?>
        </select>
        </div>
    </div>
<!-- radio button that hides last database drop down menu  -->
    <div class="movieDetails">
        <label for="madeIntoMovie">Made into Movie:</label>
        <input type="radio" id="madeIntoMovieYes" name="madeIntoMovie" value="yes" required />
        <label for="madeIntoMovieYes">Yes</label>

        <input type="radio" id="madeIntoMovieNo" name="madeIntoMovie" value="no" required />
        <label for="madeIntoMovieNo">No</label>

        <!-- Additional question if "Yes" selected -->
        <div class="streamingServiceQuestion">
            <label for="streamingService">Streaming Service:</label>
            <select id="streamingService" name="streamingService" required>
                <?php
                // connect, set up & run query, store data results and loop adding 1 at a time to dropdown 
                $sql = "SELECT * FROM services ORDER BY name";
                $cmd = $database->prepare($sql);
                $cmd->execute();
                $services = $cmd->fetchAll();
                foreach ($services as $service) {
                    echo '<option>' . $service['name'] . '</option>';
                }

                // disconnect
                $database = null;
                ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="bookId" id="bookId" value="<?php echo $bookId; ?>" />
    <button type="submit">Submit</button>
</form>
</main>
