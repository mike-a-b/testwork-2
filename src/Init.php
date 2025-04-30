<?php

namespace App;

use Exception;
use PDO;
use PDOException;

/**
 * Class Init
 * @package App
 *
 * Финальный класс для работы с таблицей test.
 */
final class Init
{
    /**
     * @var PDO Подключение к БД локальной, SQLite
     */
    private PDO $pdo;

    /**
     * Конструктор класса Init. Создает и заполняет таблицу тестовыми данными.
     *
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('sqlite:' . __DIR__ . '/test.sqlite');
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
        $this->create();
        $this->fill();
    }

    /**
     * Заполняет таблицу test тестовыми данными.
     *
     * @return void
     * @throws Exception
     */
    private function fill(): void
    {
        $results = ['success', 'normal', 'fail'];
        $stmt = $this->pdo->prepare("INSERT INTO test (name, type, summary, result) 
                                                VALUES (:name, :type, :summary, :result)");
        $iMax = count($results);
        for ($i = 0; $i < $iMax; $i++) {
            $stmt->bindValue(':name', 'test' . "Name". $i);
            $stmt->bindValue(':type', 'type' . $i);
            $stmt->bindValue(':summary', random_int(1, 100));
            $stmt->bindValue(':result', $results[array_rand($results)]);
            try {
                $stmt->execute();
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    /**
     * Создает таблицу test в базе данных SQLite.
     *
     * -result TEXT NOT NULL (одно из значений: "success", "normal", "fail")
     * @return void
     */
    private function create(): void
    {
        // Удаляем таблицу, если существует
        $this->pdo->exec("DROP TABLE IF EXISTS test");
        // Создаем таблицу
        $this->pdo->exec("CREATE TABLE test (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            type TEXT NOT NULL,
            summary integer NOT NULL,
            result TEXT NOT NULL
        )");
    }
    /**
     * Получает данные из таблицы test, где result = 'normal' или 'success'.
     *
     * @return array Массив данных из таблицы test.
     */
    public function get() : array
    {
        try {// Получаем данные из таблицы test, где result = 'normal' или 'success'
            $stmt = $this->pdo->query("SELECT * FROM test WHERE result IN ('normal', 'success')");
        } catch (PDOException $e) {
            echo $e->getMessage() . '<BR>';
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
