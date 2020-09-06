<?php
namespace App\Interfaces;

interface IUserDeatails{
    public function getFirst_name();
    public function setFirst_name($first_name);

    public function getLast_name();
    public function setLast_name($last_name);

    public function getAge();
    public function setAge($age);

    public function getLocation();
    public function setLocation($location);
}