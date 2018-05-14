<?php

class Message
{
    /**
     * @var User
     */
    private $author;

    /**
     * @var Topic
     */
    private $topic;

    /**
     * @var integer
     */
    private $positionInTopic;

    /**
     * @var string
     */
    private $content;

    /**
     * @var DateTime
     */
    private $datetime;

    /**
     * Message constructor.
     */
    private function __construct() {}

    /**
     * @param array $sqlArray Array returned from database
     * @return Message
     */
    public static function fromDB(array $sqlArray)
    {
        if(empty($sqlArray)) return null;
        $message = new self();
        $message->author =             $sqlArray['authorid'];
        $message->content =            $sqlArray['message'];
        $message->topic =              $sqlArray['topicid'];
        $message->positionInTopic =    $sqlArray['position'];
        $message->datetime =           new DateTime($sqlArray['date']);
        return $message;
    }

    /**
     * @param int $authorid
     * @param string $message
     * @param int $topicId
     * @param int $positionInTopic
     * @param DateTime $dt
     * @return Message
     */
    public static function fromArgs(int $authorid, string $message, int $topicId, int $positionInTopic, DateTime $dt)
    {
        $m = new self();
        $m->author = $authorid;
        $m->content = $message;
        $m->topic = $topicId;
        $m->positionInTopic = $positionInTopic;
        $m->datetime = $dt;
        return $m;
    }

    /**
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return Topic
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @return int
     */
    public function getPositionInTopic()
    {
        return $this->positionInTopic;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return DateTime
     */
    public function getDatetime(): DateTime
    {
        return $this->datetime;
    }


}