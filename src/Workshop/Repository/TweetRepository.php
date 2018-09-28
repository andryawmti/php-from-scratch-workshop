<?php

namespace Workshop\Repository;

use DateTime;
use Workshop\Entity\Tweet;

class TweetRepository
{
    /**
     * @var array<string,array{name:string,tweets:array{ts:string,tweet:string}}>
     */
    private $data;

    /**
     * @param array<string,array{name:string,tweets:array{ts:string,tweet:string}}> $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Tweet[]
     */
    public function listTweets(string $username): array
    {
        $tweets = [];

        foreach ($this->data[$username]["tweets"] as $tweet) {
            $tweets[] = new Tweet($tweet["tweet"], new DateTime($tweet["ts"]));
        }

        return $tweets;
    }
}
