<?php

namespace App\Customers\Application\MessageHandler;

use App\Customers\Application\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsMessageHandler(priority: 64)]
final class SecureUserHandler
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function __invoke(UserRegistration $userRegistration): void
    {
        $userRegistration->user->setPassword(
            $this->userPasswordHasher->hashPassword(
                $userRegistration->user,
                $userRegistration->form->get('plainPassword')->getData()
            )
        );
    }
}
