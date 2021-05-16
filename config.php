<?php

require 'vendor/autoload.php';
$LOGGER = new Katzgrau\KLogger\Logger(__DIR__.'/logs');

$CFG = [
    // Database settings
    'dbhost' => '127.0.0.1',
    'dbname' => 'otrium',
    'dbuser' => 'root',
    'dbpass' => 'dMax99@#',

    // Export settings
    'export_location' => './csv',

    // Extra data
    'VAT' => '21',
];