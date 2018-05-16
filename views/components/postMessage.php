<form action="" method="post">
    <fieldset>
      <input class="hide" type="text" name="action" value="topic">
      <?php
        echo '<input class="hide" type="text" name="t" value="' . $topic->getId() . '">';
        echo '<input class="hide" type="text" name="p" value="' . $pos . '">';
      ?>
      <input type="text" name="text" placeholder="Your message here"><br>
      <input type="submit" value="Submit">
    </fieldset>
</form>