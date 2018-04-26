<?php

class User
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $password;

    /**
     * @var bool
     */
    private $admin;

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
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
        return $this->admin();
    }
}