<?php
    require_once('controllers/display_controller.php');
    require_once('controllers/PDOForum.php');
    class Main_Controller {
        public function __construct () {
            $this->PDO = new PDOForum();
            $this->DisplayController = new Display_Controller($this->PDO);
        }
        
        public function route ($action) {
            echo "& $action &";
            $action = $this->sanitize($action);
            switch ($action) {
                case "topic":
                    $this->topic();
                break;
                case "user":
                    $this->user();
                break;
                case "login":
                    $this->login();
                break;
                case "logout":
                    $this->logout();
                break;
                case "register":
                    $this->register();
                break;
                default: 
                    $this->index();
            }
        }

        private function index () {
            $this->DisplayController->displayAllTopics();
        }
        private function topic () {
           if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $this->DisplayController->displayTopic($_GET['t']);
           } else {
               // add msg to db

               // then display the topic
               $this->DisplayController->displayTopic($_POST['t']);
           }
        }
         private function user () {
            //require_once("./controllers/topic_controller.php");
        }
        private function login () {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require_once('./views/components/login.html');
            } else { // POST
                 echo 'POST';
            }
        }
        private function logout () {
            // TODO
        }
        private function register () {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require_once('./views/components/register.html');
            } else { // POST
                 echo 'POST';
            }
        }

        // Utils
        // Clean received string
        private function sanitize ($data) {
            return htmlspecialchars($data);
        }
      }