<?php
require("vendor/autoload.php");

$f3 = \Base::instance();
$f3->set('UI', './app/views/');
$f3->set('DEBUG', 3);
$f3->set('AUTOLOAD', 'app/');


$f3->route('GET /sample','controllers\SampleController->display');
$f3->route('GET /taskOne','controllers\TaskOneController->display');
$f3->route('GET /taskTwo','controllers\TaskTwoController->display');
$f3->route(
    'GET /',
    function($f3) {
        $f3->set('title', 'Welcome');
        echo \Template::instance()->render("index.html");
        return;
    }
);
$f3->run();
