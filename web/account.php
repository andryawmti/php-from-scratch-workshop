<?php
$account = $_GET["username"];
$data = (require "../data/tweets.php")[$account];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tweets from <?= htmlentities($data["name"])?> - @<?= htmlentities($account) ?></title>
</head>

<body>
<h1>Tweets from <?= htmlentities($data["name"])?> - @<?= htmlentities($account) ?></h1>
<ul>
    <?php foreach ($data["tweets"] as $tweet) : ?>
    <li><?= htmlentities($tweet["tweet"]) ?> <span class="date">(<?= $tweet["ts"] ?>)</span></li>
    <?php endforeach ?>
</ul>
</body>
</html>
