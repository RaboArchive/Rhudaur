<form action="" method="post">
    <fieldset>
      <legend>Register</legend>
      <input class="hide" type="text" name="action" value="register">
      <input type="text" name="username" placeholder="Username"><br>
      <input type="password" name="pass1" placeholder="Password"><br>
      <input type="password" name="pass2" placeholder="Password"><br>
      <input type="submit" value="Submit">
    </fieldset>
    <?php
        if(isset($GLOBALS['retry']))
            echo '<strong>'.$GLOBALS['retry'].'</strong>';
    ?>
</form>