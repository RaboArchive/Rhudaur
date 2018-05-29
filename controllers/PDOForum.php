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
        $u = $q->fetch();
        if ($u === false)
            return null;
        else
            return User::fromDB($u);
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
     * @param string $name
     * @return Topic
     */
    public function newTopic(string $name)
    {
        $id = $this->conn->query('SELECT id FROM topics ORDER BY id DESC LIMIT 1')->fetch();

        $topic = Topic::fromArgs($id, $name, false, new DateTime('now'));
        $this->saveTopic($topic);
        return $topic;
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
     * @return int Number of rows affected, should be 1
     */
    public function saveTopic(Topic $topic)
    {
        if (!empty($this->getTopic($topic->getId()))) { // Topic exists
            $q = $this->conn->prepare('UPDATE topics SET name=:name, locked=:locked, lastMessageDate=:lastMessageDate');
            return $q->execute([':name' => $topic->getName(), ':locked'=>$topic->isLocked(), ':lastMessageDate'=>$topic->getLastMessageDate()]);
        } else { // New topic
            $q = $this->conn->prepare('INSERT INTO topics(id, name, locked, lastMessageDate) VALUES (:id, :name, :locked, :lastMessageDate)');
            return $q->execute([':id'=>$topic->getId(), ':name'=>$topic->getName(), ':locked'=>$topic->isLocked(), ':lastMessageDate'=>$topic->getLastMessageDate()]);
        }
    }



    public function newMessage(String $message, int $topicID, string $authorID, int $positionInTopic)
    {
        $m = Message::fromArgs($authorID, $message, $topicID, $positionInTopic, new DateTime('now'));
        $this->saveMessage($m);
        return $m;
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
        $res = $q->fetch();
        if (!$res) {
            return null;
        } else {
            return Message::fromDB($q->fetch());
        }
    }

    /**
     * @param Topic $t
     * @return array
     */
    public function getMessagesInTopic(Topic $t)
    {
        $q = $this->conn->prepare('SELECT * FROM messages WHERE messages.topicid = :tid order by position ASC');
        $q->execute([':tid' => $t->getId()]);
        $retval = [];
        foreach ($q->fetchAll() as $messageArray)
        {
            array_push($retval, Message::fromDB($messageArray));
        }
        return $retval;
    }

    public function saveMessage(Message $mess)
    {
        if (!empty($this->getMessage($mess->getTopic(), $mess->getPositionInTopic()))) { // Message exists
            $q = $this->conn->prepare('UPDATE messages SET message=:mess, authorid=:author, date=:date, position=:position');
            return $q->execute([':mess' => $mess->getContent(), ':author'=>$mess->getAuthor(), ':date'=>$mess->getDatetime()->format('Y-m-d H:i:s'), ':position'=>$mess->getPositionInTopic()]);
        } else { // New message
            $q = $this->conn->prepare('INSERT INTO messages(topicid, position, message, authorid, date) VALUES (:topic, :pos, :mess, :author, :date)');
            return $q->execute([':topic' => $mess->getTopic(), ':pos'=>$mess->getPositionInTopic(), ':mess' => $mess->getContent(), ':author'=>$mess->getAuthor(), ':date'=>$mess->getDatetime()->format('Y-m-d H:i:s')]);
        }
    }
}