<?php

namespace App;

use PDO;
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
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->pdo = new PDO('sqlite:' . __DIR__ . '/database.sqlite');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->create();
        $this->fill();
    }

    private function fill(): void
    {
        //
    }

    private function create(): void
    {
        //
    }

    public function get() : array
    {
        return $this->pdo->query('SELECT * FROM test')->fetchAll();
    }
}
