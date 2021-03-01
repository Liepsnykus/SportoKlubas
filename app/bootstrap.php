<?php
// load config file
require_once 'config/config.php';
// load helpers file
require_once 'helpers/helpers.php';

session_start();

// load libraries automatically
spl_autoload_register(function ($className) {
    require_once "libraries/$className.php";
});
