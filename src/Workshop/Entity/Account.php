<?php

namespace Workshop\Entity;

class Account
{
    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $name;

    public function __construct(string $username, string $name)
    {
        $this->username = $username;
        $this->name = $name;
    }
}
