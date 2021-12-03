<?php

namespace App\Entity;
use App\Repository\UsersRepository;
use App\Entity\Users;

class PropertySearch
{
    private $email;
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

}