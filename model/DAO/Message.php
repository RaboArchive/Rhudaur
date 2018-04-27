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
    private $message;

    /**
     * @var DateTime
     */
    private $datetime;

    /**
     * Message constructor.
     * @param array $sqlArray Array returned from database
     */
    public function __construct(array $sqlArray)
    {
        $this->author =             $sqlArray['authorid'];
        $this->message =            $sqlArray['message'];
        $this->topic =              $sqlArray['topicid'];
        $this->positionInTopic =    $sqlArray['position'];
        $this->datetime =           new DateTime($sqlArray['date']);
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
    public function getMessage()
    {
        return $this->message;
    }


}