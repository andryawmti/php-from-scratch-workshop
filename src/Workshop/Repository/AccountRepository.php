<?php

namespace Workshop\Repository;

use Workshop\Entity\Account;

class AccountRepository
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
     * @return Account[]
     */
    public function listAccounts(): array
    {
        $accounts = [];
        foreach ($this->data as $account => $data) {
            $accounts[] = new Account($account, $data["name"]);
        }

        return $accounts;
    }

    public function getByUsername(string $username): Account
    {
        return new Account($username, $this->data[$username]["name"]);
    }
}
