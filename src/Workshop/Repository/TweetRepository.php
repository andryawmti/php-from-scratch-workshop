<?php

namespace Workshop\Repository;

use DateTime;
use Workshop\Entity\Tweet;

class TweetRepository
{
    /**
     * @var string
     */
    private $dataFile;

    public function __construct()
    {
        $this->dataFile = __DIR__ . "/../../../data/tweets.php";
    }

    /**
     * @return Tweet[]
     */
    public function listTweets(string $username): array
    {
        $tweets = [];

        foreach ((require $this->dataFile)[$username]["tweets"] as $tweet) {
            $tweets[] = new Tweet($tweet["tweet"], new DateTime($tweet["ts"]));
        }

        return $tweets;
    }
}
