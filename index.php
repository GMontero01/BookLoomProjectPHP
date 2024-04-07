<!-- Page title and shared header -->
<?php 
    $pageTitle = 'Home';
    include('shared/header.php'); 
    ?>
    <h2 class = "h2">Welcome to BookLoom</h2>
   
        <section class = "features">
            <p>Bookloom is a community-driven platform where book lovers can create accounts, share their favorite books, and discover new reads.</p>
            <br><br>
            <h2>Key Features</h2>
            <ul>
                <p>Create an account to add books to the book Library</p>
                <p>Add your favorite books to the community library and inspire others new reads </p>
                <p>Explore the book library and get great book recommendations.</p>
                <p>Add/delete functionality available when you create an account to ensure proper entries on our library </p>
            </ul>
        </section>

        <section class="join-container">
        <div class="join">
            <h2>Join BookLoom Today!</h2>
            <p>Start adding to the BookLibrary and expand your Book/Movie repertoire.</p>
            <a href="register.php" class="cta-button">Register</a> 
        </div>
        </section>
</main>
</body>
<?php include('shared/footer.php'); ?>
</html>