<?php


namespace App\Services\UserServices;


use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Authorization{

    private $emi;

    private $authentication;

    private $session;

    public function __construct(EntityManagerInterface $entityManager, Authentication $authentication, SessionInterface $session)
    {
        $this->emi=$entityManager;
        $this->authentication = $authentication;
        $this->session = $session;
    }

    public function authorization_User($data){
        try {
            //Получаем репозиторий User!!
            $db = $this->emi->getRepository(User::class);
            //Поиск пользователя в базе данных!!
            $user = $db->findOneBy([
                'login'=>$data['login'],
                'password'=>$data['password']
            ]);
            //Если пользователь с такими данными существует то производим аутентификацию!!
            if(!is_null($user)){
                return $this->authentication->authentication_User($user , $data);
            }else{
                return false;
            }
        }catch (Exception $ex){
            $ex->getMessage();
        }
    }

}