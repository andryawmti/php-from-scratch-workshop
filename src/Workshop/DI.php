<?php

namespace Workshop;

use Workshop\Repository\AccountRepository;
use Workshop\Repository\TweetRepository;

class DI
{
    private const DATA_FILE = __DIR__ . "/../../data/tweets.php";

    /**
     * @return array<string,array{name:string,tweets:array{ts:string,tweet:string}}>
     */
    private static function getData(): array
    {
        static $data = null;

        if ($data === null) {
            $data = require self::DATA_FILE;
        }

        return $data;
    }

    public static function getAccountRepository(): AccountRepository
    {
        return new AccountRepository(self::getData());
    }

    public static function getTweetRepository(): TweetRepository
    {
        return new TweetRepository(self::getData());
    }
}
