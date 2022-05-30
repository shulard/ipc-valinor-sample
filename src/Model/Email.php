<?php

namespace App\Model;

use Stringable;

class Email implements Stringable
{
    public function __construct(
        private string $email
    ) {
        if (false === filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException(
                "Email $email is not valid."
            );
        }
    }

    public function __toString()
    {
        return $this->email;
    }
}
