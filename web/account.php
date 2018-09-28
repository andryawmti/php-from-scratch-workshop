<?php

use Workshop\DI;
use Workshop\View\Account;
use Workshop\View\Layout;

$account = DI::getAccountRepository()->getByUsername($_GET["username"]);

(new Layout(
    "Tweets from $account->name - @$account->username",
    new Account(
        DI::getTweetRepository()->listTweets($account->username)
    )
))();
