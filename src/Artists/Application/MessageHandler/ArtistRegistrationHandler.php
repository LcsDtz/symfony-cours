<?php

namespace App\Artists\Application\MessageHandler;

use App\Artists\Domain\Entity\Artist;
use App\Customers\Application\Message\UserRegistration;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler(priority: 64)]
class ArtistRegistrationHandler
{
    public function __invoke(UserRegistration $userRegistration): void
    {
        if ($userRegistration->form->get('artist')->getData()) {
            $artist = new Artist();
            $artist->setName($userRegistration->user->getDisplayName());
            $artist->setUser($userRegistration->user);

            $userRegistration->user->addArtist($artist);
        }
    }
}