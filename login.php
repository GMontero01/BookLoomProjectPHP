<?php

$pageTitle = 'Login';

require 'shared/header.php';

?>

  <h2>Login</h2>
  <?php
  if (!empty($_GET['invalid'])){
    echo '<h5> INVALID LOGIN</h5>';
  }
    ?>
  
  <section class="formFormatting">
  <form class="simple-form-style" class="login-form" method="post" action="validateUser.php">
    <fieldset>
      <h5>Please enter your credentials.</h5>
      <label for="username">Username:</label>
      <input name="username" id="username" required type="email" placeholder="email@email.com" /><br>

      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required /><br>

      <button class="offset-button">Login</button>
    </fieldset>
  </form>
  </section>
</body>
</main>
<?php include('shared/footer.php'); ?>