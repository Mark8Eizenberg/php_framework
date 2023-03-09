<?php

namespace Core;

use Exception;

class Authentication
{

    private Database $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    private static function encodePassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @throws Exception database must be included first with constructor
     */
    public function getUser($email, $password)
    {
        if (!isset($this->db)) {
            throw new Exception("You need initialize database first");
        }

        $query = <<<QUERY
            Select u.name, u.email, u.id, u.password 
                from demo.users as u 
                where u.email = :email
            QUERY;

        $user = $this->db->query($query, [
            'email' => $email
        ])->find();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }

        unset($user['password']);
        return $user;
    }

    public function addUser($name, $email, $password): bool
    {
        if (!isset($this->db)) {
            throw new Exception("You need initialize database first");
        }

        $user = $this->getUser($email, $password);

        if ($user) {
            return false;
        }

        $password = $this->encodePassword($password);

        $query = <<<QUERY
            insert into demo.users(name, email, password)
                values(:name, :email, :password);
        QUERY;

        $this->db->query($query, [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);

        return true;
    }

    public static function authorizeUser($user)
    {
        $_SESSION['user'] = $user;
    }

    public static function unauthorizeUser()
    {
        unset($_SESSION['user']);
    }

    public static function getCurrentUser()
    {
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        return null;
    }

}