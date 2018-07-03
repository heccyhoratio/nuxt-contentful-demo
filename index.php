<?php

require('./vendor/autoload.php');
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'No auth provided.';
    exit;
} else {
    $user = getenv('AUTH_USER');
    $password = getenv('AUTH_PASSWORD');
echo($user);
    if ($user == $_SERVER['PHP_AUTH_USER'] && $password == $_SERVER['PHP_AUTH_PW']) {
        $output = shell_exec('/usr/bin/sudo git pull 2>&1');
        echo("<pre>$output</pre>");

        $output = shell_exec('/usr/bin/sudo /var/www/vhosts/nuxt-contentful-demo/node_modules/.bin/nuxt generate 2>&1');
        echo("<pre>$output</pre>");
    } else {
        echo("No Auth");
    }
    exit;
}





