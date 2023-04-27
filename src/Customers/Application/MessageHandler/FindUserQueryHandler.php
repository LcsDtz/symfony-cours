<?php

namespace App\Customers\Application\MessageHandler;

use App\Customers\Application\Message\FindUserQuery;
use App\Customers\Domain\Entity\User;
use App\Customers\Domain\Repository\UserRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class FindUserQueryHandler
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(FindUserQuery $findUserQuery): ?User
    {
        return $this->userRepository->find($findUserQuery->id);
    }
}