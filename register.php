<?php

$pageTitle = 'Register';

require('shared/header.php');

?>
<div>
<h2>User Registration</h2>

  
</div>
  <?php
  if(!empty($_GET['duplicate'])){
    echo '<h4 class="err">Username already exists</h4>';
  }
  ?>
<section class="formFormatting">
  <form class="simple-form-style" method="post" action="save-registration.php">

    <fieldset>
      <h5>Passwords must be a minimum of 8 characters, including 1 digit, 1 upper-case letter, and 1 lower-case letter.</h5>
      
      <label for="username">Username: *</label>

      <input name="username" id="username" required type="email" placeholder="email@email.com" /><br>

      <label for="password">Password: *</label>

      <input type="password" name="password" id="password" required 

          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /><img id="showHide" src="images/show.png" alt="Show/Hide" 
          onClick="showHidePass();" /> <br>

      <label for="confirm">Confirm Password: *</label>

      <input type="password" name="confirm" id="confirm" required
        onkeyup="return passwordMatch();"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /><span id="Error"></span><br>

    <button class="offset-button" onclick="return passwordMatch();">Register</button>
    </fieldset>
  </form>
</section>
</main>
<?php include('shared/footer.php'); ?>