<?php


class Topic
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     */
    private $locked;

    /**
     * @var DateTime
     */
    private $lastMessageDate;




    /**
     * Topic constructor. Private as we build it with Topic::fromDB or Topic::fromArgs.
     */
    private function __construct() {}

    /**
     * @param array $sqlArray Array returned from database
     * @return Topic
     */
    public static function fromDB(array $sqlArray)
    {
        if (empty($sqlArray)) return null;
        $t = new self();
        $t->id = $sqlArray['id'];
        $t->name = $sqlArray['name'];
        $t->locked = (bool) $sqlArray['locked'];
        $t->lastMessageDate = new DateTime($sqlArray['lastMessageDate']);
        return $t;
    }

    /**
     * @param int $id
     * @param string $name
     * @param bool $locked
     * @param DateTime $lastMessageDate
     * @return Topic
     */
    public static function fromArgs(int $id, string $name, bool $locked, DateTime $lastMessageDate)
    {
        $t = new self();
        $t->id = $id;
        $t->name = $name;
        $t->locked = $locked;
        $t->lastMessageDate = $lastMessageDate;
        return $t;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * @return DateTime
     */
    public function getLastMessageDate()
    {
        return $this->lastMessageDate;
    }

    /**
     * @param bool $locked
     */
    public function setLocked(bool $locked)
    {
        $this->locked = $locked;
    }
}