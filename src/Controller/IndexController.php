<?php

namespace App\Controller;

use App\Entity\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    private $session;

    private $emi;

    public function __construct(SessionInterface $session , EntityManagerInterface $entityManager){
        $this->session = $session;
        $this->emi = $entityManager;
    }
    //Основная страница!!!
    /**
     * @Route("/index",name="index",methods={"GET"})
     */
    public function index(){
        $authorizationUser = $this->session->get('userSession');
        return $this->render('index/index.html.twig',[
            'is_Authentication'=>$authorizationUser['is_authentication'],
            'login'=>$authorizationUser['login'],
        ]);
    }

    //Страница профиля!!!
    /**
     * @Route("/user",name="user",methods={"GET"})
     */
    public function user(){
        $profile = $this->userProfile();
        return $this->render('user/user.html.twig',[
            'login'=>$profile->getLogin(),
            'email'=>$profile->getEmail(),
            'first_name'=>$profile->getUser_Details()->getFirst_name(),
            'last_name'=>$profile->getUser_Details()->getLast_name(),
            'age'=>$profile->getUser_Details()->getAge(),
            'location'=>$profile->getUser_Details()->getLocation(),
        ]);
    }
    //Профиль пользователя!!!
    public function userProfile(){
        try {
            $user = $this->session->get('userSession');
            $userRepositroy = $this->emi->getRepository(User::class);
            $userProfile = $userRepositroy->findOneBy([
                'login'=>$user['login'],
            ]);
        }catch (Exception $exception){
            $exception->getMessage();
        }
        return $userProfile;
    }
}
