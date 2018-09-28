<?php

namespace Workshop\View;

use Workshop\Entity\Account;

class Homepage
{
    /**
     * @var Account[]
     */
    private $accounts;

    /**
     * @param Account[] $accounts
     */
    public function __construct(array $accounts)
    {
        $this->accounts = $accounts;
    }

    public function __invoke(): void
    {
        ?>
        <ul>
            <?php foreach ($this->accounts as $account) : ?>
                <li>
                    <a href="account.php?username=<?= \htmlentities($account->username)?>">
                        <?= \htmlentities($account->name) ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
        <?php
    }
}
