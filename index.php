<?php
    session_start();
?>
<html>
    <header>
        <title>Rhudaur - THE forum made in PHP</title>
    </header>
    <body>
        <?php
            // Contains header + nav bar
            require_once('./views/header.php');
        ?>
        <div class="container">
            <?php
                require_once('./controllers/main.php');
            ?>
        </div>
        <?php
            require_once('./views/footer.html');
        ?>
    </body>
</html>