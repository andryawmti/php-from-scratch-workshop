<!DOCTYPE html>
<html>
<head>
    <title>Twitter homepage</title>
</head>

<body>
<h1>Twitter homepage</h1>
<ul>
    <?php foreach (require "../data/tweets.php" as $account => $data): ?>
    <li>
        <a href="account.php?username=<?= htmlentities($account)?>">
            <?= htmlentities($data["name"]) ?>
        </a>
    </li>
    <?php endforeach ?>
</ul>
</body>
</html>
