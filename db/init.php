<?php 

require_once __DIR__ . '/../vendor/autoload.php';

$app = new app\BandManager;

// Basic DB tables
$app->basicDatabase();

// Run existing migrations after basic DB creation
$app->migrate();