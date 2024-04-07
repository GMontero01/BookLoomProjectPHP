<?php
include('shared/authenticate.php');
$pageTitle = 'Add Book';
include('shared/header.php');

?>

<h2>Add a new Book</h2>
<!-- Form to capture user input for new book entry -->
<form action="insertBook.php" method="post" enctype="multipart/form-data">

    <fieldset> 
        <div class="bookDetails"> 
        <label for="bookTitle">Book Title:</label>
        <input type="text" id="bookTitle" name="bookTitle" required /><br>

        <label for="bookAuthor">Book Author:</label>
        <input type="text" id="bookAuthor" name="bookAuthor" required /><br>
    
        <label for="publishYear">Publish Year:</label>
        <input name="publishYear" id="publishYear" required placeholder="1900" type="number" min="1700" /><br>

        <label for="bookGenre">Book Genre:</label>
        <input type="text" id="bookGenre" name="bookGenre" required /><br>
        
        <label for="bookPublisher">Book Publisher:</label>
        <select name="bookPublisher" id="bookPublisher" required> 
            <!-- Connect and pull database for publisher names -->
            <?php
            try{
                include('shared/databases.php');
                $sql = "SELECT * FROM bookPublishers ORDER BY publisherName"; // Change 'name' to 'publisherName'
                $cmd = $database->prepare($sql);
                $cmd->execute();
                $publishers = $cmd->fetchAll();

                foreach ($publishers as $publisher){
                    echo '<option>' . $publisher['publisherName'] . '</option>'; // Change 'bookPublisher' to 'publisherName'
                }
                $database = null;
            }
            catch (Exception $err) {
                header('location:error.php');
                exit();
            }
            ?>
        </select><br>
        <label for="photo">Book Cover:</label>
        <input type="file" id="bookCover" name="bookCover" accept="image/*" />
    
    
    
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
                try{
                include('shared/databases.php'); 
                    $sql = "SELECT * FROM services ORDER BY name";
                    $cmd = $database->prepare($sql);
                    $cmd->execute();
                    $services = $cmd->fetchAll();
                    foreach ($services as $service) {
                        echo '<option>' . $service['name'] . '</option>';
                    }

                    // disconnect
                    $database = null;
                }
                catch (Exception $err) {
                    header('location:error.php');
                    exit();
                }
                ?>
            </select>
        </div>
    </div>
    
    <button type="submit">Submit</button>
    </div>
    </fieldset>
</form>
</body>
</main>
<?php include('shared/footer.php'); ?>
