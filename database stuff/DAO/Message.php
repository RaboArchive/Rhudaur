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