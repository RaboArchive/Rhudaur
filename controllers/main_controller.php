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
                if (isset($_SESSION['user'])) {
                    var_dump($this->PDO->newMessage($_POST['text'], (int)$_POST['t'], $_SESSION['user'], $_POST['p']));
                }
                // then display the topic
                $this->DisplayController->displayTopic($_POST['t']);
           }
        }
         private function user () {
            //require_once("./controllers/topic_controller.php");
        }
        private function login () {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require_once('./views/components/login.php');
            } else { // POST
                 $user = $this->PDO->getUser($_POST['username']);
                 if ($user->checkPassword($_POST['pass'])) {
                     session_start();
                     $_SESSION['user'] = $user;
                     $this->index();
                 }
                 else {
                     $GLOBALS['retry'] = true;
                     $this->login();
                 }
            }
        }

        private function logout () {
            unset($_SESSION['user']);
            $this->index();
        }

        private function register () {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                require_once('./views/components/register.php');
            } else { // POST
                try {
                    if ($_POST['pass1'] === $_POST['pass2']) {
                        $u = $this->PDO->newUser($_POST['username'], $_POST['pass1'], false);
                        session_start();
                        $_SESSION['user'] = $u;
                        $this->index();
                    } else {
                        $GLOBALS['retry'] = "Entered passwords don't match";
                        $this->register();
                    }
                }catch (Exception $e) {
                    $GLOBALS['retry'] = 'Username already exists';
                    $this->register();
                }
            }
        }

        // Utils
        // Clean received string
        private function sanitize ($data) {
            return htmlspecialchars($data);
        }
      }