<?php

namespace Workshop\View;

class Layout
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var callable
     */
    private $body;

    public function __construct(string $title, callable $body)
    {
        $this->title = $title;
        $this->body = $body;
    }

    public function __invoke(): void
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <title><?= $titleEscaped = \htmlentities($this->title) ?></title>
        </head>

        <body>
        <h1><?= $titleEscaped ?></h1>
        <?= ($this->body)() ?>
        </body>
        </html>
        <?php
    }
}
