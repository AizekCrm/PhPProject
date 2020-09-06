<?php

namespace App\Controller;

use App\Form\UserType;
use App\Services\UserServices\Authorization;
use App\Services\UserServices\Registration;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/authorization",name="authorizationRender",methods={"GET"})
     */
    public function authorizationRender(){
        $form = $this->createForm(UserType::class);
        return $this->render('user/authorization.html.twig',[
            'user_form'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/authorization",name="authorization",methods={"POST"})
     * @param Request $request
     * @param Authorization $authorization
     */
    public function authorization(Request $request, Authorization $authorization){
        $data_form = $request->request->get('user');
        $aut_User = $authorization->authorization_User($data_form);

        if($aut_User == true){
            return $this->redirectToRoute('index');
        }else{
            return $this->redirectToRoute('authorization');
        }
    }

    /**
     * @Route("/registration",name="registrationRender",methods={"GET"})
     */
    public function registrationRender(){
        $form = $this->createForm(UserType::class);
        return $this->render('user/registration.html.twig', [
            'registration'=> $form->createView(),
        ]);
    }

    /**
     * @Route("/registration",name="registration",methods={"POST"})
     * @param Request $request
     * @param Registration $registration
     */
    public function registration(Request $request, Registration $registration){
        $data_form_user = $request->request->get('user');
        $reg_User = $registration->registration_User($data_form_user);
        if($reg_User == true){
            return $this->redirectToRoute('authorization');
        }else{
            return $this->redirectToRoute('registration');
        }
    }
}
