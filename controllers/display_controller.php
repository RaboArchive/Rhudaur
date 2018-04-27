<?php
    class Display_Controller {
        public function __construct (PDOForum $pdo) {
            $this->PDO = $pdo;
        }

        function displayAllTopics () {
            vardump(PDOForum::getAllTopics());

            // Display part
            $toPrint = "<div id='topicContainer'";
            foreach ($topics as $topic) {
                //echo $topic['id'] . " - " . $topic['name'] . " - " . $topic['locked'] . "<br>";

                $imgLockedsrc = "";
                if ($topic['locked'] == 0) {
                    $imgLockedsrc = './views/res/unlocked.png';
                } else {
                    $imgLockedsrc = './views/res/locked.png';
                }

                $toPrint = $toPrint . "<div class='row topic'>";
                $toPrint = $toPrint .  "<div class='col s2'><img src='$imgLockedsrc' width='50px' height='50px'></div>";
                $toPrint = $toPrint .  "<div class='col s8 test'><a href='?action=topic&t=" . $topic['id'] . "'>" . $topic['name'] . "</a></div>";
                $toPrint = $toPrint .  "<div class='col s2'>DATE</div>";
                $toPrint = $toPrint .  '</div>';
            }
            echo "$toPrint </div>";
        }
    }