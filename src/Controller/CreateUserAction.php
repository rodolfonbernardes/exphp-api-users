<?php


namespace App\Controller;
use App\Entity\User;
use App\Message\CreateUserMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserAction
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/users", methods={"POST"})
     */
    public function __invoke(Request $request): Response
    {
        $requestContent = $request->getContent();
        $json = json_decode($requestContent, true);

        $user = new User($json['name'], $json['email']);
        foreach ($json['telephones'] as $telephone) {
            $user->addTelephone($telephone['number']);
        }

        $this->bus->dispatch(new CreateUserMessage($user));
        return new Response('', Response::HTTP_CREATED);
    }

}