<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="shared/styles.css"/>
    <script src="./js/scripts.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@400;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<!-- Shared header amongst all pages -->

    <header style="background-image: url('images/headerbackground.jpg'); background-size: cover;">
        <div class="logo-container">
            <a href="index.php" class="logo-container">
                <img src="images/logo.png" alt="BookLoom Logo" class="header-logo">
            </a>
        </div>
        <h1 class="caveat-header">Welcome to BookLoom</h1> 
    </header>
<body>
    <nav>
        <ul>
            <li>
                <a href="index.php">Home</a>
            </li>
            <?php
            if (session_status() == PHP_SESSION_NONE){
              session_start();  
            } 
            if (!empty($_SESSION['username'])) {
                echo '<li>
                 <a href="addBook.php">Add Book</a>    
                </li>'; 
            }?>
            <li>
                <a href="bookLibrary.php">Book Library</a>
            </li>
            <?php
            if (!empty($_SESSION['username'])) {
                echo '<li>
                <a href="addPublisher.php">Add Publisher</a>
                </li>
                <li>
                <a href="logout.php">Logout</a>
                </li>
                <li>
                <a href="#">' . $_SESSION['username'] . '</a>
                </li>';
            }else{
                echo'<li>
                    <a href="register.php">Register</a>
                </li>
                <li>
                    <a href="login.php">Login</a>
                </li>';
            }
            ?>
        </ul>
    </nav>
<main>