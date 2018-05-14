<?php

require_once('model/DAO/Message.php');
require_once('model/DAO/User.php');
require_once('model/DAO/Topic.php');


class PDOForum
{

    /**
     * @var PDO
     */
    public $conn;

    /**
     * PDOForum constructor.
     */
    public function __construct()
    {
        $this->conn = new PDO("sqlite:model/projet-forum.db");
    }

    /**
     * @param string $username
     * @return User
     */
    public function getUser(string $username)
    {
        $q = $this->conn->prepare('SELECT * FROM users WHERE users.username = :username');
        $q->execute([':username' => $username]);
        return User::fromDB($q->fetch());
    }

    public function newUser(string $username, string $password, bool $admin = false)
    {
        if (!empty($this->getUser($username)))  // User exists
            throw new Exception("User with this name already exists.");

        $user = User::fromArgs($username, $password, $admin);
        $this->saveUser($user);
        return $user;
    }

    /**
     * @param User $user
     */
    public function saveUser(User $user)
    {
        if (!empty($this->getUser($user->getUsername()))) { // User exists
            $q = $this->conn->prepare('UPDATE users SET password=:pw, admin=:adm');
            $q->execute([':pw' => $user->getPasswordHash(), ':adm'=>$user->isAdmin()]);
        } else {
            $q = $this->conn->prepare('INSERT INTO users(username, password, admin) VALUES (:username, :password, :admin)');
            $q->execute([':username'=>$user->getUsername(), ':password'=>$user->getPasswordHash(), ':admin'=>$user->isAdmin()]);
        }
    }
    /**
     * @param int $tid
     * @return Topic
     */
    public function getTopic(int $tid)
    {
        $q = $this->conn->prepare('SELECT * FROM topics WHERE topics.id = :tid');
        $q->execute([':tid' => $tid]);
        return Topic::fromDB($q->fetch());
    }

    /**
     * @return array
     */
    public function getAllTopics()
    {
        $q = $this->conn->prepare('SELECT * FROM topics');
        $q->execute();
        $retval = [];
        foreach ($q->fetchAll() as $topicArray)
        {
            array_push($retval, Topic::fromDB($topicArray));
        }
        return $retval;
    }


    /**
     * @param Topic $topic
     */
    public function saveTopic(Topic $topic)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * @param int $tid
     * @param int $mid
     * @return Message
     */
    public function getMessage(int $tid, int $mid)
    {
        $q = $this->conn->prepare('SELECT * FROM messages WHERE messages.topicid = :tid and messages.position = :index');
        $q->execute([':tid' => $tid, ':index' => $mid]);
        return Message::fromDB($q->fetch());
    }

    /**
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
            array_push($retval, Message::fromDB($messageArray));
        }
        return $retval;
    }

    public static function saveMessage(Message $mess)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }



}