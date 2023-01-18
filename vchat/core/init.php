<?php

    session_start();

    require 'classes/DB.php';
    require 'classes/User.php';

    $userObj = new \MyApp\User;

    $protocol = "http://";
    $host = "localhost/";
    $dir_name = str_replace('\\', '/', substr((string) dirname(__FILE__), 16, 26));
    $url = "{$protocol}{$host}{$dir_name}";

    define('BASE_URL', $url);

?>