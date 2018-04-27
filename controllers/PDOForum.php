<?php

require_once('../model/DAO/Message.php');
require_once('../model/DAO/User.php');
require_once('../model/DAO/Topic.php');


class PDOForum
{

    /**
     * @var PDO
     */
    public $conn;

    /**
     * @return PDO
     */
    public function __construct()
    {
        return new PDO("sqlite:../model/projet-forum.db");
    }

    /**
     * @param PDO $conn
     * @param string $username
     * @return User
     */
    public function getUser(string $username)
    {
        $q = $this->conn->prepare('SELECT * FROM users WHERE users.username = :username');
        $q->execute([':username' => $username]);
        return $q->fetch();
    }

    /**
     * @param PDO $conn
     * @param User $user
     */
    public function saveUser(User $user)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * @param PDO $conn
     * @param int $tid
     * @return Topic
     */
    public function getTopic(int $tid)
    {
        $q = $this->conn->prepare('SELECT * FROM topics WHERE topics.id = :tid');
        $q->execute([':tid' => $tid]);
        return $q->fetch();
    }

    /**
     * @param PDO $conn
     * @return array
     */
    public function getAllTopics()
    {
        $q = $this->conn->prepare('SELECT * FROM topics');
        $q->execute();
        return $q->fetchAll();
    }



    /**
     * @param PDO $conn
     * @param Topic $topic
     */
    public function saveTopic(Topic $topic)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * @param PDO $conn
     * @param int $tid
     * @param int $mid
     * @return Message
     */
    public function getMessage(int $tid, int $mid)
    {
        $q = $this->conn->prepare('SELECT * FROM messages WHERE messages.topicid = :tid and messages.position = :index');
        $q->execute([':tid' => $tid, ':index' => $mid]);
        return new Message($q->fetch());
    }

    /**
     * @param PDO $conn
     * @param Topic $t
     * @return array
     */
    public function getMessagesInTopic(Topic $t)
    {
        $q = $this->conn->prepare('SELECT * FROM messages WHERE messages.topicid = :tid order by date');
        $q->execute([':tid' => $t->getId()]);
        $retval = [];
        foreach ($q->fetchAll() as $messageArray)
        {
            array_push($retval, $messageArray);
        }
        return $retval;
    }

    public static function saveMessage(Message $mess)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }


}