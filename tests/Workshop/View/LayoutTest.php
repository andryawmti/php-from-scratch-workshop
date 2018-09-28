<?php

namespace Workshop\Tests;

use PHPUnit\Framework\TestCase;
use Workshop\View\Account;
use Workshop\View\Layout;

class LayoutTest extends TestCase
{
    /**
     * @var Account
     */
    private $view;

    public function setUp(): void
    {
        $this->view = new Layout(
            "This must be in the title meta but also in the initial h1",
            new class
            {
                public function __invoke(): void
                {
                    ?><p>This is to be found somewhere inside the body tags.</p><?php
                }
            }
        );
    }

    public function testTitleExistsInMeta(): void
    {
        $this->expectOutputRegex("@<title>.*This must be in the title meta but also in the initial h1.*</title>@");
        ($this->view)();
    }

    public function testTitleExistsInInitialH1(): void
    {
        $this->expectOutputRegex(
            "@<body>.*<h1>This must be in the title meta but also in the initial h1</h1>.*</body>@sm"
        );
        ($this->view)();
    }

    public function testBodyFilledIn(): void
    {
        $this->expectOutputRegex("@<body>.*<p>This is to be found somewhere inside the body tags.</p>.*</body>@sm");
        ($this->view)();
    }
}
