<?php
require_once __DIR__ . '/../vendor/autoload.php';

use \App\Dispatch;

$dc = new Dispatch();

echo "\n Start dispatch period \n";
$dc->startDispatchPeriod();

echo "\n End dispatch period \n";

$dc->endDispatchPeriod();