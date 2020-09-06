<?php


namespace App\Services\UserServices;

use App\Entity\User\User;
use App\Entity\User\UserDetails;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;

class Registration{

    private $emi;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->emi=$entityManager;
    }

    public function registration_User($userRegistration){
        try {
            //Получение репозитория User!!
            $user_schema = $this->emi->getRepository(User::class);
            //Поиск пользователя в базе данных!!
            $findUser = $user_schema->findOneBy([
                'login'=>$userRegistration['login'],
                'password'=>$userRegistration['password'],
            ]);
            //Если пользователь с такими данными не найден,
            // то производим запись в базу данных нового пользователя!!
            if(is_null($findUser)){
                //Пользователь!!!
                $user=new User();
                    $user->setLogin($userRegistration['login']);
                    $user->setPassword($userRegistration['password']);
                    $user->setEmail($userRegistration['email']);
                //Детали о пользователе!!!
                $details=new UserDetails();
                    $details->setFirst_name($userRegistration['first_name']);
                    $details->setLast_name($userRegistration['last_name']);
                    $details->setAge($userRegistration['age']);
                    $details->setLocation($userRegistration['location']);
                //(связь между сущностями User и UserDetails)
                $details->setUser($user);
                $user->setUser_Details($details);

                //Запись в БАЗУ ДАННЫХ
                $this->emi->persist($details);
                $this->emi->persist($user);
                $this->emi->flush();
                return true;
            }
            else{
                return false;
            }
        }catch (Exception $ex){
            $ex->getMessage();
        }
    }
}