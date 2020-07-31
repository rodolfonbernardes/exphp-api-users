<?php

namespace App\Message;

use App\Entity\User;

final class UpdateUserMessage
{
    private int  $Id;
    private User $User;

    public function __construct(int $Id, User $User)
    {
        $this->Id = $Id;
        $this->User = $User;
    }
    public function getUserId(): int
    {
        return $this->Id;
    }

    public function getUserRequest(): User
    {
        return $this->User;
    }
}
