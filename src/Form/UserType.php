<?php

namespace App\Form;

use App\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class , ['label' => 'Логин'])
            ->add('password', PasswordType::class , ['label'=>'Пароль'])
            ->add('email', EmailType::class , ['label'=>'Почта'])
            ->add('first_name', TextType::class , ['label'=>'Имя'])
            ->add('last_name', TextType::class , ['label'=>'Фамилия'])
            ->add('age', TextType::class , ['label'=>'Возраст'])
            ->add('location', TextType::class , ['label'=>'Город'])
            ->add('submited',SubmitType::class,['label'=>'Регистрация'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
