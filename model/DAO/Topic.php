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
     * Topic constructor.
     * @var array $sqlArray
     */
    public function __construct(array $sqlArray)
    {
        $this->id = $sqlArray['id'];
        $this->name = $sqlArray['name'];
        $this->locked = (bool) $sqlArray['locked'];
        $this->lastMessageDate = new DateTime($sqlArray['lastMessageDate']);
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
}