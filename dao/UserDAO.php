<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace dao;

use PDO;
use model\User;

/**
 * Class UserDAO
 * @package dao
 */
class UserDAO
{
    /**
     * @var PDO
     */
    private $pdo;

    /**
     * BookDAO constructor.
     */
    public function __construct()
    {
        $this->pdo = Connection::getInstance()->getPdo();
    }

    /**
     * @return array
     */
    public function getUsers()
    {
        $users = array();
        $req = $this->pdo->prepare(
            'SELECT id_user, login, password
                      FROM user'
        );
        $req->execute();

        $user = null;
        while ($user = $req->fetchObject(User::class)) {
            $users[] = $user;
        }

        $req->closeCursor();

        return $users;
    }

    /**
     * @param $id
     * @return User
     */
    public function getUserById($id_user)
    {
        $user = new User();

        $req = $this->pdo->prepare(
            'SELECT id_user, login, password
                      FROM user 
                      WHERE id_user = :id_user'
        );
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $req->execute();

        if (($a = $req->fetchObject(User::class)) !== false) {
            $user = $a;
        }

        $req->closeCursor();

        return $user;
    }

    public function getFirstUser()
    {
        $user = new User();

        $req = $this->pdo->prepare(
            'SELECT id_user, login, password
                      FROM user 
                      WHERE id_user = (SELECT MIN(id_user) FROM user)');
        $req->execute();

        if (($a = $req->fetchObject(User::class)) !== false) {
            $user = $a;
        }

        $req->closeCursor();

        return $user;
    }

    public function getLastUser()
    {
        $user = new User();

        $req = $this->pdo->prepare(
            'SELECT id_user, login, password
                      FROM user 
                      WHERE id_user = (SELECT MAX(id_user) FROM user)');
        $req->execute();

        if (($a = $req->fetchObject(User::class)) !== false) {
            $user = $a;
        }

        $req->closeCursor();

        return $user;
    }

    /**
     * @param User $user
     * @return User
     */
    public function createUser(User $user)
    {
        $req = $this->pdo->prepare(
            'INSERT INTO user (login, password) 
                      VALUES (:login, :password)'
        );
        $req->bindParam(':login', $user->login, PDO::PARAM_STR);
        $req->bindParam(':password', $user->password, PDO::PARAM_STR);
        $req->execute();

        $user->setIdUser($this->pdo->lastInsertId());

        return $user;
    }

    public function updateUser(User $user)
    {
        if ($user->id_user != null) {
            $req = $this->pdo->prepare(
                'UPDATE user SET 
                          login = :login,
                          password = :password
                          WHERE id_user = :id_user'
            );
            $req->bindParam(':id_user', $user->id_user, PDO::PARAM_INT);
            $req->bindParam(':login', $user->login, PDO::PARAM_STR);
            $req->bindParam(':password', $user->password, PDO::PARAM_STR);
            $req->execute();
        }
        return $user;
    }

    public function deleteUser($id_user)
    {
        $req = $this->pdo->prepare(
            'DELETE FROM user 
                      WHERE id_user = :id_user'
        );
        $req->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        return $req->execute();
    }
}