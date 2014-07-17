<?php

/**
 * Router file for use with the in-built PHP web server. Emulates the behaviour of a .htaccess file
 */

$uri = strtolower($_SERVER['REQUEST_URI']);
if (substr($uri, 0, 4) === "/api") {
    $_SERVER["REQUEST_URI"] = substr($uri, 4);
    include_once __DIR__ . DIRECTORY_SEPARATOR. implode(DIRECTORY_SEPARATOR, array("api", "index.php"));
} else {
    return false;
}