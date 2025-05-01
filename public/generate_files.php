<?php
/**
 * Генерация файлов с расширением .ixt и случайными именами из букв и цифр
 * с использованием библиотеки Faker PHP для генерации имён.
 *
 * Скрипт создаёт указанное число файлов в папке `datafiles`.
 * Имена файлов состоят только из латинских букв (a–z, A–Z) и цифр (0–9),
 * расширение файлов — `.ixt`.
 *
 * PHP version 7.4+
 *
 * @category  FileGeneration
 * @package   App
 */

require_once dirname(__DIR__) . '/vendor/autoload.php'; // автозагрузка Composer

use Faker\Factory as FakerFactory;

/**
 * Абсолютный путь до папки, в которой будут создаваться файлы.
 *
 * @var string
 */
$directory = dirname(__DIR__) . '/datafiles';

/**
 * Количество файлов для создания.
 *
 * @var int
 */
$numFiles = 20;

/**
 * Длина случайного имени файла (без расширения).
 *
 * @var int
 */
$nameLength = 15;

/**
 * Регулярное выражение для проверки соответствия имени файла:
 *
 * @var string
 */
$pattern = '/^[A-Za-z0-9]+\.ixt$/';

/**
 * Инициализация Faker.
 *
 * @var \Faker\Generator
 */
$faker = FakerFactory::create();

// Убедимся, что папка существует. Если нет — создаём её.
if (!mkdir($directory, 0755, true) && !is_dir($directory)) {
    fwrite(STDERR, "Не удалось создать папку: $directory\n");
    die();
}

// Генерация файлов
for ($i = 0; $i < $numFiles; $i++) {
    // Используем Faker для генерации строк из букв и цифр
    $name = $faker->regexify('[A-Za-z0-9]{' . $nameLength . '}');
    $filename = $name . '.ixt';

    // Проверяем, что имя соответствует шаблону
    if (!preg_match($pattern, $filename)) {
        $i--;
        continue;
    }

    $filePath = $directory . DIRECTORY_SEPARATOR . $filename;

    // Проверяем, что файл ещё не существует
    if (file_exists($filePath)) {
        $i--;
        continue;
    }

    // Создаём пустой файл
    if (false === touch($filePath)) {
        fwrite(STDERR, "Не удалось создать файл: $filePath\n");
    } else {
        echo "Создан файл: $filename\n";
    }
}
