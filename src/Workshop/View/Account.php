<?php

namespace Workshop\View;

use Workshop\Entity\Tweet;

class Account
{
    /**
     * @var Tweet[]
     */
    private $tweets;

    /**
     * @param Tweet[] $tweets
     */
    public function __construct(array $tweets)
    {
        $this->tweets = $tweets;
    }

    public function __invoke(): void
    {
        ?>
        <ul>
            <?php foreach ($this->tweets as $tweet) : ?>
                <li>
                    <?= \htmlentities($tweet->text) ?>
                    <span class="date">(<?= $tweet->ts->format("Y-m-d H:i:s") ?>)</span>
                </li>
            <?php endforeach ?>
        </ul>
        <?php
    }
}
