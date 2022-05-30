<?php

namespace App\Model;

use DateTimeInterface;

class Contract
{
    public function __construct(
        private \DateTimeInterface $startsAt,
        private \DateTimeInterface $expiresAt,
        private Author $author
    ) {
        if ($expiresAt < $startsAt) {
            throw new \InvalidArgumentException(
                '"expiresAt" date must be after "startsAt".'
            );
        }
    }

    public function author(): Author
    {
        return $this->author;
    }

    public function expiresAt(): DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function startsAt(): DateTimeInterface
    {
        return $this->startsAt;
    }
}
