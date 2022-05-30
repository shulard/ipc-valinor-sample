<?php

namespace App\Model;

class Author
{
    /**
     * @var non-empty-string
     */
    private string $name;

    public function __construct(
        string $name,
        private Email $email
    ) {
        $this->name = $name;
        if (empty($name)) {
            throw new \InvalidArgumentException(
                "Author name can't be empty."
            );
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function email(): Email
    {
        return $this->email;
    }
}
