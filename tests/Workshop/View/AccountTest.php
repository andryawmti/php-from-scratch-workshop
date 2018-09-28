<?php

namespace Workshop\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use Workshop\Entity\Tweet;
use Workshop\View\Account;

class AccountTest extends TestCase
{
    /**
     * @var Account
     */
    private $view;

    public function setUp(): void
    {
        $this->view = new Account(
            [
                new Tweet("That's my last tweet", new DateTime("2018-05-09T11:30:00+00:00")),
                new Tweet("That's my first tweet", new DateTime("2016-05-09T11:30:00+00:00")),
            ]
        );
    }

    public function testInvoke(): void
    {
        $this->expectOutputRegex("@<li>\s*That's my last tweet.*</li>\s*<li>\s*That's my first tweet.*</li>@sm");
        ($this->view)();
    }
}
