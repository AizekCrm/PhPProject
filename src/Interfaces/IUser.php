<?php
namespace App\Interfaces;

interface IUser{
    public function getEmail();
    public function setEmail($email);

    public function getPassword();
    public function setPassword($password);

    public function getLogin();
    public function setLogin($login);
}
