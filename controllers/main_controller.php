<?php
    class main_controller {
        public function __construct () {}
        
        public function route ($action) {
            echo $action;
            $action = $this->sanitize($action);
            switch ($action) {
                case "topic":
                    echo "TODO : $action";
                break;
                case "user":
                    echo "TODO : $action";
                break;
                case "login":
                    echo "TODO : $action";
                break;
                case "logout":
                    echo "TODO : $action";
                break;
                case "register":
                    echo "TODO : $action";
                break;
                default: 
                    echo "TODO : $action";
            }
        }

        private function displayTopic () {
            require_once("./controllers/display_controller.php");
        }

        // Clean received string
        private function sanitize ($data) {
            // TODO
            return $data;
        }
      }
?>