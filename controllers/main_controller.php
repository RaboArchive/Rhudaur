<?php
    class Main_Controller {
        public function __construct () {}
        
        public function route ($action) {
            echo "$action <br>";
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
            require_once("./controllers/topic_controller.php");
            displayAllTopics();
        }
        private function topic () {
            require_once("./controllers/topic_controller.php");
        }
        private function user () {
            //require_once("./controllers/topic_controller.php");
        }
        private function login () {
            //require_once("./controllers/topic_controller.php");
        }
        private function logout () {
            //require_once("./controllers/topic_controller.php");
        }
        private function register () {
            //require_once("./controllers/topic_controller.php");
        }

        // Utils
        // Clean received string
        private function sanitize ($data) {
            return htmlspecialchars($data);
        }
      }
?>