<?php

require dirname(__DIR__). '/vendor/autoload.php';

use App\Init;

//создаем объект Init и получаем данные из БД для вывода
$init = new Init();
$data = $init->get();

echo "<pre>";
print_r($data);
echo "</pre>";
