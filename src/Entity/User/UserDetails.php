<?php

namespace App\Entity\User;


use App\Interfaces\IUserDeatails;
use App\Repository\UserDetailsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\OneToOne;

/**
 * @ORM\Entity(repositoryClass=UserDetailsRepository::class)
 */
class UserDetails implements IUserDeatails
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
    private $first_name;
    /**
     * @ORM\Column(type="string")
     */
    private $last_name;
    /**
     * @ORM\Column(type="integer")
     */
    private $age;
    /**
     * @ORM\Column(type="string")
     */
    private $location;
    /**
     * @ORM\Column(type="object")
     * @OneToOne(targetEntity="User", mappedBy="user_details")
     * @JoinColumn(name="user_login", referencedColumnName="login")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirst_name() : ?string
    {
        return $this->first_name;
    }
    public function setFirst_name($first_name)
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLast_name() : ?string
    {
        return $this->last_name;
    }
    public function setLast_name($last_name)
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getAge() : ?int
    {
        return $this->age;
    }
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    public function getLocation() : ?string
    {
        return $this->location;
    }
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    public function getUser() : User{
       return $this->user;
    }
    public function setUser(User $user)
    {
        $this->user=$user;

        return $this;
    }
}
