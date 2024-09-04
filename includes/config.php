<?php

session_start();
$site_title = 'Moment 4';
$divider = ' | ';

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.class.php'; //sökväg till mappen för dina klasser
});



