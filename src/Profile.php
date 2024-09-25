<?php

namespace App;

class Profile
{
    private $name;
    private $birth;
    private $childhood;
    private $education;
    private $career;
    private $legacy;

    public function __construct($data = null)
    {
        if ($data) {
            $this->name = $data['name'];
            $this->birth = $data['birth'];
            $this->childhood = $data['childhood'];
            $this->education = $data['education'];
            $this->career = $data['career'];
            $this->legacy = $data['legacy'];
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBirth()
    {
        return $this->birth;
    }

    public function getChildhood()
    {
        return $this->childhood;
    }

    public function getEducation()
    {
        return $this->education;
    }

    public function getCareer()
    {
        return $this->career;
    }

    public function getLegacy()
    {
        return $this->legacy;
    }
}
