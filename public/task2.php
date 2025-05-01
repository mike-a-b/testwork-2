<?php
/**
 * Оптимизация запроса и таблиц в БД
 * /../src/query_task2.sql файл с последовательностью sql запросов для оптимизации
 */
require dirname(__DIR__). '/vendor/autoload.php';

use Exception;
use PDO;
use PDOException;

try {
    $pdo = new PDO(
        "mysql:host=localhost;port=3306;dbname=testdatabase",
        "root",
        "m1k31t"
    );
//    for ($i = 0; $i < 1000; $i++) {
//        $faker = new Faker\Factory::create();
//        $name = $faker->name;
//        $type = $faker->word;
//        $summary = $faker->sentence;
//        $result = $faker->randomElement(['success', 'normal', 'fail']);
//
//        $stmt = $pdo->prepare("INSERT INTO test (name, type, summary, result) VALUES (:name, :type, :summary, :result)");
//        $stmt->bindParam(':name', $name);
//        $stmt->bindParam(':type', $type);
//        $stmt->bindParam(':summary', $summary);
//        $stmt->bindParam(':result', $result);
//        try {
//            if (!$stmt->execute()) {
//                throw new Exception("Failed to insert data");
//            }
//        } catch (Exception $e) {
//            echo "Error: " . $e->getMessage();
//        }
//    }
} catch (\Exception $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

