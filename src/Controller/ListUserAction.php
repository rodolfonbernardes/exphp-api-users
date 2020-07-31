<?php


namespace App\Controller;


use App\Message\ListUserMessage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Routing\Annotation\Route;

class ListUserAction
{
    private MessageBusInterface $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Route("/users", methods={"GET"})
     */
    public function listAction(): Response
    {
        $envelope = $this->bus->dispatch(new ListUserMessage([]));
        $handledStamp = $envelope->last(HandledStamp::class);
        $data = $handledStamp->getResult();

        return new JsonResponse($data);
    }
}