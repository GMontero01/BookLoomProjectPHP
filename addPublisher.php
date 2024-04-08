<?php 
//page title and shared header
include('shared/authenticate.php');
$pageTitle = 'Add Publisher';
include('shared/header.php'); ?>    

<!-- form to take user input for new publisher-->
<h2 class = "h2">Add a New Publisher</h2>
<section class="publisherDetails">
    <form class="simple-form-style" method="post" action="insertPublisher.php">
        <label for="publisherName">Publisher Name:</label>
        <input type="text" name="publisherName" id="publisherName" required />
    <button type="submit">Submit</button><br><br>
    </form>
</section>
</main>
</body>
<?php include('shared/footer.php'); ?>
</html>