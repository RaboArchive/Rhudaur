<?php
    class Display_Controller {
        public function __construct (PDOForum $pdo) {
            $this->PDO = $pdo;
        }

        public function displayAllTopics () {
            $toPrint = "<div id='topicContainer'>";
            foreach ($this->PDO->getAllTopics() as $topic) {
                $imgLockedsrc = "";
                if ($topic->isLocked() == 0) {
                    $imgLockedsrc = './views/res/unlocked.png';
                } else {
                    $imgLockedsrc = './views/res/locked.png';
                }

                $toPrint = $toPrint . "<div class='row topic'>";
                $toPrint = $toPrint .  "<div class='col s2'><img src='$imgLockedsrc' width='50px' height='50px'></div>";
                $toPrint = $toPrint .  "<div class='col s8'><a href='?action=topic&t=" . $topic->getId() . "'>" . $topic->getName() . "</a></div>";
                $toPrint = $toPrint .  "<div class='col s2'>" . $topic->getLastMessageDate()->format('Y-m-d H:i:s') . "</div>";
                $toPrint = $toPrint .  '</div>';
            }
            echo "$toPrint </div>";
        }

        public function displayTopic (int $id) {
            $topic = $this->PDO->getTopic($id);
            $toPrint = '<div id="messageContainer">';
            $messages = $this->PDO->getMessagesInTopic($topic);
            $pos = sizeof($messages) + 1;
            foreach ($messages as $message) {
                $toPrint = $toPrint . "<div class='row message'>";
                $toPrint = $toPrint . "<div class='col s12 headerMsg'><p>". $message->getDatetime()->format('Y-m-d H:i:s') ."</p></div>";
                $toPrint = $toPrint . "<div class='col s3 userMsg'><p>" . $this->PDO->getUser($message->getAuthor())->getUsername() ."</p></div>";
                $toPrint = $toPrint . "<div class='col s9 contentMsg'> ". $message->getContent() ."</div>";
                $toPrint = $toPrint . '</div>';
            }
            echo "$toPrint </div>";
            if (isset($_SESSION['user'])) {
                require_once('./views/components/postMessage.php');
            } else {
                echo "<h3>You must be logged to post messages :)</h3>";
            }
        }
    }