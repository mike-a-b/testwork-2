<?php

require dirname(__DIR__). '/vendor/autoload.php';

use App\Init;

$init = new Init();
$data = $init->get();

echo "<pre>";
print_r($data);
echo "</pre>";
