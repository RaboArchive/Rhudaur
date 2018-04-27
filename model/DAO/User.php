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

   private function __construct() {}

    /**
     * @param array $sqlArray
     * @return User
     */
    public static function fromDB(array $sqlArray)
    {
        $u = new self();
        $u->username = $sqlArray['username'];
        $u->password = $sqlArray['password'];
        $u->admin = $sqlArray['admin'];
        return $u;
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $admin
     * @return User
     */
    public static function fromArgs(string $username, string $password, bool $admin)
    {
        $u = new self();
        $u->username = $username;
        $u->password = $password;
        $u->admin = $admin;
        return $u;
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