<?php

namespace Workshop\Repository;

use Workshop\Entity\Account;

class AccountRepository
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
     * @return Account[]
     */
    public function listAccounts(): array
    {
        $accounts = [];
        foreach (require $this->dataFile as $account => $data) {
            $accounts[] = new Account($account, $data["name"]);
        }

        return $accounts;
    }

    public function getByUsername(string $username): Account
    {
        return new Account($username, (require $this->dataFile)[$username]["name"]);
    }
}
