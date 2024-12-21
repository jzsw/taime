<?php

include "taime.php";
$taime=new Taime();

$response = [
    'status' => 'success',
    'message' => 'This is a taime backend program,no access!',
    'group' => "875080566"
];

$taime -> output($taime -> $response);