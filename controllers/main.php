<?php
    require_once('./controlers/main_controler.php');
    $controler = new main_controler(); 

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
