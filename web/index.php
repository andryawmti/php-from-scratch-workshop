<?php
$accounts = Workshop\DI::getAccountRepository()->listAccounts();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Twitter homepage</title>
</head>

<body>
<h1>Twitter homepage</h1>
<ul>
    <?php foreach ($accounts as $account) : ?>
    <li>
        <a href="account.php?username=<?= htmlentities($account->username)?>">
            <?= htmlentities($account->name) ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
</body>
</html>
