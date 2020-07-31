<?php


namespace App\Controller;


use App\Entity\User;
use App\Message\UpdateUserMessage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Messenger\MessageBusInterface;

class UpdateUserAction
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }


    /**
     * @Route("/users/{id}", methods={"PUT"})
     */
    public function __invoke(Request $request, int $id): Response
    {
        $requestContent = $request->getContent();
        $json = json_decode($requestContent, true);

        $user = new User($json['name'], $json['email']);
        foreach ($json['telephones'] as $telephone) {
            $user->addTelephone($telephone['number']);
        }

        $this->bus->dispatch(new UpdateUserMessage($id, $user));
        return new Response('', Response::HTTP_OK);
    }



}