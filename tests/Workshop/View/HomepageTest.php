<?php

namespace Workshop\Tests;

use PHPUnit\Framework\TestCase;
use Workshop\Entity\Account;
use Workshop\View\Homepage;

class HomepageTest extends TestCase
{
    /**
     * @var Homepage
     */
    private $view;

    public function setUp(): void
    {
        $this->view = new Homepage([new Account("foobar", "Foo Bar")]);
    }

    public function testInvoke(): void
    {
        $this->expectOutputRegex('@<li>\s*<a href="foobar">\s*Foo Bar\s*</a>\s*</li>@sm');
        ($this->view)();
    }
}
