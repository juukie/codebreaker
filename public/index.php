<?php

require __DIR__ . './../vendor/autoload.php';

$codebreaker = new \App\Codebreaker('1426');

try {
    $result = $codebreaker->check('0237');
} catch (\App\InvalidArgumentException $e) {
    $result = $e->getMessage();
}

echo $result . '<br>';

echo '<pre>' . print_r($codebreaker->guesses(), 1) . '</pre>';
