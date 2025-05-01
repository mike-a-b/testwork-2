<?php

/**
 * Поиск файлов с определённым шаблоном имени в папке /datafiles
 *
 * Этот скрипт находит все файлы в каталоге `/datafiles`,
 * имена которых состоят только из латинских букв и цифр,
 * и имеют расширение `.ixt`. Файлы выводятся в алфавитном порядке.
 *
 * PHP version 7.4+
 *
 * @category IXTFileScanner
 * @package  App
 */

$directory = dirname(__DIR__) . '/datafiles'; // Абсолютный путь до папки
$matchedFiles = [];

// Проверяем, существует ли папка
if (!is_dir($directory)) {
    echo "Папка не найдена: $directory\n";
    exit(1);
}

// Получаем список всех файлов в папке
$files = scandir($directory);

// Регулярное выражение для соответствия имени файла
$pattern = '/^[a-zA-Z0-9]+\.ixt$/';

foreach ($files as $file) {
    $filePath = $directory . DIRECTORY_SEPARATOR . $file;

    // Проверяем, что это файл и имя соответствует шаблону
    if (is_file($filePath) && preg_match($pattern, $file)) {
        $matchedFiles[] = $file;
    }
}

// Сортируем по имени
sort($matchedFiles, SORT_NATURAL | SORT_FLAG_CASE);

// Выводим результат
foreach ($matchedFiles as $file) {
    echo $file . PHP_EOL;
}
