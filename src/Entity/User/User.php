<?php

namespace App\Entity\User;

use App\Interfaces\IUser;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements IUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $email;
    /**
     * @ORM\Column(type="string")
     */
    private $password;
    /**
     * @ORM\Column(type="string")
     */
    private $login;
    /**
     * @ORM\Column(type="object")
     * @OneToOne(targetEntity="UserDetails", mappedBy="user")
     */
    private $user_details;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail() : ?string
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword() : ?string
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password=$password;

        return $this;
    }

    public function getLogin() :?string
    {
        return $this->login;
    }
    public function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }

    public function getUser_Details() : UserDetails{
        return $this->user_details;
    }
    public function setUser_Details(UserDetails $user_details){
        $this->user_details=$user_details;
        return $this;
    }

}
