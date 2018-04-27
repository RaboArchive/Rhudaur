<?php

class User
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $admin;

    /**
     * User constructor.
     * @param array $sqlArray
     */
    public function __construct(array $sqlArray)
    {
        $this->username = $sqlArray['username'];
        $this->password = $sqlArray['password'];
        $this->admin = $sqlArray['admin'];
    }

    /**
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $testValue
     * @return bool
     */
    public function checkPassword(string $testValue) {
        // FIXME: introduce crypto asap
        return $testValue === $this->password;
    }

    /**
     * @return bool
     */
    public function isAdmin() {
        return $this->admin;
    }
}