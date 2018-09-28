# Workshop: creating a PHP 7+ application from scratch

## Initialize the project:

~~~bash
git clone git@github.com:patrickallaert/php-from-scratch-workshop.git workshop
~~~

## Configuration

Edit your `/etc/hosts` and add:
~~~
::1    workshop.local
~~~
or, if you still live in the *IPv4* era:
~~~
127.0.0.1    workshop.local
~~~

Now let's configure *Apache* with a `VirtualHost`:

~~~apacheconfig
<VirtualHost *:80>
    ServerName workshop.local
    DocumentRoot /path/to/workshop/web

    <Directory /path/to/workshop>
        Require all granted
        AllowOverride all
    </Directory>
</VirtualHost>
~~~

After restarting *Apache*, let's try the whole configuration and edit `web/index.php` and put the above:
~~~php
<?= "Hello world" ?>
~~~
Open http://workshop.local/, it should display: *Hello world*

## Create the first web pages

In this workshop, we will create a skinny Twitter-like application made of two simple pages: a *homepage* showing a list of accounts and an *account page* showing the tweets for a specific account.
For the sake of this workshop, we will first do this the dirty way and it will look like procedural PHP 3 code like some of us did 20 years ago ;-)

Some data are available in `data/tweets.php` as a big serialized array and should be considered as the **database**.

`data/tweets.php`:
~~~php
<?php

return [
    "Princess_Leia" => [
        "name" => "Princess Leia",
        "tweets" => [],
    ],
    "Luke" => [
        "name" => "Luke Skywalker",
        "tweets" => [
            [
                "ts" => "2017-01-01T12:34:56+00:00",
                "tweet" => "@Princess_Leia => I'm @Luke Skywalker and I'm here to rescue you!",
            ],
        ],
    ],
    "Darth_Vader" => [
        "name" => "Anakin Skywalker",
        "tweets" => [
            [
                "ts" => "2017-01-13T16:00:00+00:00",
                "tweet" => "@Luke, I am your father",
            ],
            [
                "ts" => "2016-06-06T16:23:00+00:00",
                "tweet" => "Your powers are weak, old man.",
            ],
            [
                "ts" => "2016-05-10T19:00:00+00:00",
                "tweet" => "I've been waiting for you, @Obi-Wan. We meet again, at last.",
            ],
        ],
    ],
    "Obi-Wan" => [
        "name" => "Obi-Wan \"Ben\" Kenobi",
        "tweets" => [
            [
                "ts" => "2016-05-09T11:30:00+00:00",
                "tweet" => "Blast. This is why I hate flying.",
            ],
            [
                "ts" => "2016-05-08T09:00:00+00:00",
                "tweet" => "Your clones are very impressive. You must be very proud.",
            ],
            [
                "ts" => "2016-03-02T19:15:00+00:00",
                "tweet" => "Use the Force, @Luke",
            ],
            [
                "ts" => "2016-01-01T14:00:00+00:00",
                "tweet" => "@Luke, the Force will be with you",
            ],
        ],
    ],
];
~~~

Example of what `web/index.php` and `web/account.php` could look like:

`web/index.php`:
~~~php
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
~~~

`web/account.php`:
~~~php
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
    <?php foreach ($data["tweets"] as $tweet): ?>
    <li><?= htmlentities($tweet["tweet"]) ?> <span class="date">(<?= $tweet["ts"] ?>)</span></li>
    <?php endforeach ?>
</ul>
</body>
</html>
~~~

If you haven't completed the above steps, you can checkout **step-1** to not be late:

~~~bash
git checkout step-1
~~~

## Managing dependencies

We won't reinvent the wheel, let's grab [composer](https://getcomposer.org/) to manage our dependencies:
~~~bash
wget https://getcomposer.org/download/1.7.2/composer.phar
chmod a+x composer.phar
~~~
Create a `composer.json` file:
~~~json
{
    "name": "php/workshop",
    "autoload": {
        "psr-0": { "": "src/" }
    }
}
~~~
Let's add some coding standard & Phan
~~~bash
./composer.phar require --dev slevomat/coding-standard phan/phan
~~~

To run the tools
* Discovering coding standard issues: `vendor/bin/phpcs --standard=phpcs.xml .`
* Resolve (some) coding standard issues automatically: `vendor/bin/phpcbf --standard=phpcs.xml .`
* Perform Phan static analysis: `vendor/bin/phan --color`

## Configure the bootstrapping of the application

Create `bootstrap.php` at the root of your project:
~~~php
<?php

require "vendor/autoload.php";
~~~

Tell PHP to load if for every requests in Apache's `VirtualHost` config:
~~~apacheconfig
php_admin_value auto_prepend_file "/path/to/workshop/bootstrap.php"
~~~

## Separating business logic from template

### Creation of the business logic classes:

* `Workshop\Repository\AccountRepository` (`src/Workshop/Repository/AccountRepository.php`)
  * `listAccounts(): array` Gives a list of name and username of all existing accounts, to be used for *Homepage*.
  * `getNameByUsername(string $username): string` Gives the name of an account, given its `$username`, to be used for *Account page*.
* `Workshop\Repository\TweetRepository` (`src/Workshop/Repository/TweetRepository.php`)
  * `listTweets(string $username): array` Gives all the tweets of an account, given its `$username`, to be used for *Account page*.

Refactor `web/index.php` and `web/account.php` to use it.

If you haven't completed the above steps, you can checkout **step-2** to not be late:

~~~bash
git checkout step-2
~~~

## Dependency Injection


Create `Workshop\DI` class with the following static methods:
* Returns the "database" data:
  * `private static function getData(): array`
* Returns a configured `AccountRepository`:
  * `public static function getAccountRepository(): AccountRepository`
* Returns a configured `TweetRepository`:
  * `public static function getTweetRepository(): TweetRepository`

and refactor `web/index.php` and `web/account.php`.

If you haven't completed the above steps, you can checkout **step-3** to not be late:

~~~bash
git checkout step-3
~~~

## Extracting templates from controllers

Let's create views:
* `Workshop\View\Layout`: Global layout of the application
* `Workshop\View\Homepage`: Homepage view
* `Workshop\View\Account`: Account view

and refactor `web/index.php` and `web/account.php` to use them.

If you haven't completed the above steps, you can checkout **step-4** to not be late:

~~~bash
git checkout step-4
~~~

## Routing

Let's implement routing and transform URIs like http://workshop.local/account.php?account=Obi-Wan into http://workshop.local/Obi-Wan

For this, let's use Apache's `mod_rewrite` and update the Apache configuration:
~~~apacheconfig
RewriteEngine on

# http://workshop.local/username
RewriteCond %{REQUEST_METHOD} =GET
RewriteRule ^/([^/]+)$ /account.php?username=$1 [L]

# http://workshop.local/
RewriteCond %{REQUEST_METHOD} =GET
RewriteRule ^/$ /index.php [L]
~~~

The `Homepage` template needs updating after Apache has been restarted.

If you haven't completed the above steps, you can checkout **step-5** to not be late:

~~~bash
git checkout step-5
~~~
