<?php

namespace Workshop\Tests;

use DateTime;
use PHPUnit\Framework\TestCase;
use Workshop\Entity\Tweet;
use Workshop\Repository\TweetRepository;

class TweetRepositoryTest extends TestCase
{
    /**
     * @var TweetRepository
     */
    private $tweetRepository;

    public function setUp(): void
    {
        $this->tweetRepository = new TweetRepository(require __DIR__ . "/../../../data/tweets.php");
    }

    public function testListTweetsNotTweetedYet(): void
    {
        $this->assertSame([], $this->tweetRepository->listTweets("Princess_Leia"));
    }

    public function testListTweets(): void
    {
        $this->assertEquals(
            [
                new Tweet(
                    'Blast. This is why I hate flying.',
                    new DateTime('2016-05-09T11:30:00+00:00')
                ),
                new Tweet(
                    'Your clones are very impressive. You must be very proud.',
                    new DateTime('2016-05-08T09:00:00+00:00')
                ),
                new Tweet(
                    'Use the Force, @Luke',
                    new DateTime('2016-03-02T19:15:00+00:00')
                ),
                new Tweet(
                    '@Luke, the Force will be with you',
                    new DateTime('2016-01-01T14:00:00+00:00')
                ),
            ],
            $this->tweetRepository->listTweets("Obi-Wan")
        );
    }
}
