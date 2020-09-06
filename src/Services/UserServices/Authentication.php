<?php

namespace App\Services\UserServices;

use Doctrine\DBAL\Types\GuidType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Authentication{

    private $session;

    public function __construct(SessionInterface $session){
        $this->session=$session;
    }
    public function authentication_User($user , $data){
        if($data['login'] == $user->getLogin() && $data['password'] == $user->getPassword()){
            $this->session->start();
            $this->session->set('userSession', [
                'sessionValue' => new GuidType(),
                'is_authentication' => true,
                'login'=>$user->getLogin(),
            ]);
            return true;
        }else{
            return false;
        }
    }
}