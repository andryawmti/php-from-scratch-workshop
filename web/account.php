<?php
$username = $_GET["username"];
$name = Workshop\DI::getAccountRepository()->getByUsername($username)->name;
$tweets = Workshop\DI::getTweetRepository()->listTweets($username);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tweets from <?= htmlentities($name)?> - @<?= htmlentities($username) ?></title>
</head>

<body>
<h1>Tweets from <?= htmlentities($name)?> - @<?= htmlentities($username) ?></h1>
<ul>
    <?php foreach ($tweets as $tweet) : ?>
    <li><?= htmlentities($tweet->text) ?> <span class="date">(<?= $tweet->ts->format("Y-m-d H:i:s") ?>)</span></li>
    <?php endforeach ?>
</ul>
</body>
</html>
