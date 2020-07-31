<?php


namespace App\Controller;

use App\Entity\User;
use App\Message\DetailUserMessage;
use App\Message\ListUserMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Routing\Annotation\Route;

class DetailUserAction
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }
    /**
     * @Route("/users/{id}", methods={"GET"})
     */
    public function __invoke(int $id): Response
    {
        $envelope = $this->bus->dispatch(new DetailUserMessage($id));
        $handledStamp = $envelope->last(HandledStamp::class);
        $data = $handledStamp->getResult();

        return new JsonResponse($data);
    }
}