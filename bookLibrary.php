<?php
// Page title and shared header
$pageTitle = 'Book Library';
include('shared/header.php');

try {
    // Prepare to retrieve from SQL database
    include('shared/databases.php'); // Shared database include
    $sql = "SELECT * FROM books";
    $cmd = $database->prepare($sql);
    // Retrieve and fetch all entries that were specified
    $cmd->execute();
    $books = $cmd->fetchAll();
} catch (Exception $err) {
    header('location:error.php');
    exit();
}
?>
<section class="formFormatting">
<div class="table-container">
    <h2>Book Library</h2>
    <table>
        <thead>
            <th>Book Title</th>
            <th>Book Cover</th>
            <th>Book Author</th>
            <th>Publish Year</th>
            <th>Book Genre</th>
            <th>Book Publisher</th>
            <th>Made Into Movie</th>
            <th>Streaming Service</th>
            <?php if (!empty($_SESSION['username'])) : ?>
                <th>Actions</th>
            <?php endif; ?>
        </thead>
        <tbody>
            <?php foreach ($books as $book) : ?>
                <tr>
                    <td><?= $book['bookTitle'] ?></td>
                    <td>
                        <?php if ($book['bookCover'] != null) : ?>
                            <img src="images/bookCovers/<?= $book['bookCover'] ?>" class="imgFormat" />
                        <?php endif; ?>
                    </td>
                    <td><?= $book['bookAuthor'] ?></td>
                    <td><?= $book['publishYear'] ?></td>
                    <td><?= $book['bookGenre'] ?></td>
                    <td><?= $book['bookPublisher'] ?></td>
                    <td><?= $book['madeIntoMovie'] ?></td>
                    <td><?= $book['streamingService'] ?></td>
                    <?php if (!empty($_SESSION['username'])) : ?>
                        <td class="actions">
                            <a href="edit-book.php?bookId=<?= $book['bookId'] ?>">Edit</a>&nbsp;
                            <a href="delete-book.php?bookId=<?= $book['bookId'] ?>" onclick="return confirmDelete();">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</section>
</main>
<?php include('shared/footer.php'); ?>
