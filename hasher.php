<?php
// We are outputting json always, in utf-8 character set
header('Content-type: application/json; charset=utf-8');
// If hasher.php?hash is set (and present),
// use it, else we set our var as an empty string
$hashThis = (isset($_GET['hash']) && !empty($_GET['hash']) ? $_GET['hash'] : '');

// If our $hashThis is empty, exit early
if (empty($hashThis)) {
    return true;
}

// Our supported hashing algorithms
$algorithms = hash_algos();

$hashes = array();
foreach ($algorithms as $algorithm) {
    $start = microtime(true);
    $hash = hash($algorithm, $hashThis);
    $timeElapsed = microtime(true) - $start;
    $hashes[$algorithm] = [
        'algorithm' => $algorithm,
        'hash' => $hash,
        'time' => number_format($timeElapsed * 1000, 8, '.', '') // Milliseconds, with 8 decimals
    ];
}

echo json_encode($hashes);