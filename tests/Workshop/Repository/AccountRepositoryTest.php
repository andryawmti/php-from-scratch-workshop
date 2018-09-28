<?php

namespace Workshop\Tests;

use PHPUnit\Framework\TestCase;
use Workshop\Entity\Account;
use Workshop\Repository\AccountRepository;

class AccountRepositoryTest extends TestCase
{
    /**
     * @var AccountRepository
     */
    private $accountRepository;

    public function setUp(): void
    {
        $this->accountRepository = new AccountRepository(require __DIR__ . "/../../../data/tweets.php");
    }

    public function testListAccounts(): void
    {
        $this->assertEquals(
            [
                new Account('Princess_Leia', 'Princess Leia'),
                new Account('Luke', 'Luke Skywalker'),
                new Account('Darth_Vader', 'Anakin Skywalker'),
                new Account('Obi-Wan', 'Obi-Wan "Ben" Kenobi'),
            ],
            $this->accountRepository->listAccounts()
        );
    }

    public function testGetNameByAccount(): void
    {
        $this->assertEquals(
            new Account('Obi-Wan', 'Obi-Wan "Ben" Kenobi'),
            $this->accountRepository->getByUsername("Obi-Wan")
        );
    }
}
