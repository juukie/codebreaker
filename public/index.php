<?php

require __DIR__ . './../vendor/autoload.php';

$codes = array_map(function ($val) {
    return str_pad($val, 4, '0', STR_PAD_LEFT);
}, range(0, 6666));

$guesses = [
    '5555' => '+--+',
    '1551' => '----',
    '5511' => '+-+-',
    '1155' => '---+',
    '5151' => '+---',
    '5115' => '+-++',
    '1515' => '--++',
    '1315' => '-++',
    '5314' => '++',
    '5321' => '+-',
    '5311' => '++-',
    '5310' => '++-',
    '5316' => '++',
    '5315' => '+++',
    '3113' => '-+',
    '3511' => '-+-',
    '2641' => '-',
];

foreach ($codes as $code) {
    $codebreaker = new \App\Codebreaker($code);

    $sameResults = true;

    foreach ($guesses as $guess => $shouldEqual) {
        $outcome = $codebreaker->check($guess);

        if ($outcome !== $shouldEqual) {
            $sameResults = false;
        }
    }

    if ($sameResults) {
        echo '<pre>' . print_r($codebreaker, 1) . '</pre>';
        echo '<pre>5015: ' . $codebreaker->check($code) . '</pre>';
        die();
    }
}
