<?php
/**
 * Created by PhpStorm.
 * User: tkint
 * Date: 02/08/2017
 * Time: 22:10
 */

namespace model;


/**
 * Class User
 * @package model
 */
class User
{
    /**
     * @var
     */
    public $id_user;

    /**
     * @var
     */
    public $login;

    /**
     * @var
     */
    public $password;

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function toJSON()
    {
        return json_encode($this);
    }

    /**
     * @param $json
     * @return User
     */
    public static function fromJSON($json)
    {
        $object = json_decode($json, true);
        return self::fromArray($object);
    }

    /**
     * @param $json
     * @return User
     */
    public static function fromArray($array)
    {
        $user = new User();
        if (isset($array['id_user']) && !is_null($array['id_user']))
            $user->setIdUser($array['id_user']);
        if (isset($array['login']) && !is_null($array['login']))
            $user->setLogin($array['login']);
        if (isset($array['password']) && !is_null($array['password']))
            $user->setLogin($array['password']);
        return $user;
    }
}