<?php

namespace Workshop\Entity;

use DateTime;

class Tweet
{
    /**
     * @var string
     */
    public $text;

    /**
     * @var DateTime
     */
    public $ts;

    public function __construct(string $text, DateTime $ts)
    {
        $this->text = $text;
        $this->ts = $ts;
    }
}
