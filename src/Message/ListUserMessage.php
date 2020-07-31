<?php

namespace App\Message;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;

final class ListUserMessage
{
    private array $User;

    public function __construct(array $User)
    {
        $this->User = $User;
    }

    public function getUserRequest(): array
    {
        return $this->User;
    }

}
