<?php
    echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]<br>";

    require_once('./controllers/MainController.php');
    $controler = new MainController();

    if(isset($_REQUEST['action']))
        $action = $_REQUEST['action'];
    else
        $action = '';

    $controler->route($action);
