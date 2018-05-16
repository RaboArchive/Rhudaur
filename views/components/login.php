<form action="" method="post">
    <fieldset>
      <legend>Connection</legend>
      <input class="hide" type="text" name="action" value="login">
      <input type="text" name="username" placeholder="Username"><br>
      <input type="password" name="pass" placeholder="Password"><br>
        <?php
        if ($GLOBALS['retry'] == true)
            echo '<p>Incorrect password, try again.</p>'
        ?>
      <input type="submit" value="Submit">
    </fieldset>
</form>