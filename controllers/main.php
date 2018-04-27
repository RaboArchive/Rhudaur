<?php
    echo "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]<br>";

    require_once('./controllers/main_controller.php');
    $controler = new Main_Controller(); 

    // pre-treatment of the params
    $action = '';
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $action = $_GET['action'];
    } else { // Lets assume that there is only GET & POST in the world
        $action = $_POST['action'];
    }
    // In case no arguments are provided
    if (empty($action)) {
        $action = '';
    }

    $controler->route($action);
