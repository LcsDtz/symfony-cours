<?php

namespace App\Customers\Application\Message;

use App\Customers\Domain\Entity\User;
use Symfony\Component\Form\FormInterface;

final class UserRegistration
{
    public function __construct(public readonly User $user, public readonly FormInterface $form)
    {
    }
}
