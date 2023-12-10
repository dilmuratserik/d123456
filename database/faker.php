<?php

use Faker\Factory;

require 'vendor/autoload.php';
require 'Database.php';

$faker = Factory::create();
$db = Database::connect();
for ($i = 0; $i < 10; $i++) {
    $title = $faker->sentence;
    $text = $faker->text;

    try {
        $sth = $db->prepare("INSERT INTO vb_post (title, text) VALUES (:title, :text)");
        $sth->execute([':title' => $title, ':text' => $text]);
    } catch (PDOException $e) {
        echo "Ошибка при вставке данных: " . $e->getMessage();
    }
}

echo "Тестовые данные добавлены.";
