<?php
/**
 * Created by PhpStorm.
 * User: antonin
 * Date: 29/05/18
 * Time: 14:02
 */

require_once('model/DAO/user.php');

class UserController
{
    /**
     * @return User|null
     */
    public function getCurrentUser()
    {
        if (isset($_SESSION['user']))
            return unserialize($_SESSION['user']);
        else
            return null;
    }
}