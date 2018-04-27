<?php

require_once('../model/DAO/Message.php');
require_once('../model/DAO/User.php');
require_once('../model/DAO/Topic.php');


class PDOForum
{
    /**
     * @param PDO $conn
     * @param string $username
     * @return User
     */
    public static function getUser(PDO $conn, string $username)
    {
        $q = $conn->prepare('SELECT * FROM users WHERE users.username = :username');
        $q->execute([':username' => $username]);
        return $q->fetch();
    }

    /**
     * @param PDO $conn
     * @param User $user
     */
    public static function saveUser(PDO $conn, User $user)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * @param PDO $conn
     * @param int $tid
     * @return Topic
     */
    public static function getTopic(PDO $conn, int $tid)
    {
        $q = $conn->prepare('SELECT * FROM topics WHERE topics.id = :tid');
        $q->execute([':tid' => $tid]);
        return $q->fetch();
    }

    /**
     * @param PDO $conn
     * @param Topic $topic
     */
    public static function saveTopic(PDO $conn, Topic $topic)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    /**
     * @param PDO $conn
     * @param int $tid
     * @param int $mid
     * @return Message
     */
    public static function getMessage(PDO $conn, int $tid, int $mid)
    {
        $q = $conn->prepare('SELECT * FROM messages WHERE messages.topicid = :tid and messages.position = :index');
        $q->execute([':tid' => $tid, ':index' => $mid]);
        return new Message($q->fetch());
    }


    public static function saveMessage(PDO $conn, Message $mess)
    {
        throw new BadMethodCallException("Not implemented yet.");
    }

    public static function new
}