<?php

namespace App\Message;
use App\Entity\User;


final class CreateUserMessage
{
    private User $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    public function getUserRequest(): User
    {
        return $this->User;
    }

}
