<?php 
//page title and shared header
include('shared/authenticate.php');
$pageTitle = 'Add Publisher';
include('shared/header.php'); ?>    

<!-- form to take user input for new publisher-->
<h2 class = "h2">Add a New Publisher</h2>
<form method="post" action="insertPublisher.php">
    <div class="publisherDetails">
        <label for="publisherName">Publisher Name:</label>
        <input type="text" name="publisherName" id="publisherName" required />
    <button type="submit">Submit</button>
    </div>
</form>
</main>
</body>
</html>