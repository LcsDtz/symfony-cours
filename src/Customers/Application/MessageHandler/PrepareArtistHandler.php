<?php

namespace App\Customers\Application\MessageHandler;

use App\Customers\Application\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(priority: 64)]
final class PrepareArtistHandler
{
    public function __invoke(UserRegistration $userRegistration): void
    {
        if ($userRegistration->form->get('artist')->getData()) {
            $userRegistration->user->setRoles(['ROLE_ARTIST']);
        }
    }
}