<?php
require 'vendor/autoload.php';
require 'src/Database.php';
use PDO;

$db = Database::connect();

$query = "
CREATE TABLE IF NOT EXISTS vb_post (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    text TEXT NOT NULL,
    forumid INT NOT NULL DEFAULT 1
);
";

try {
    $db->exec($query);
    echo "Миграция выполнена успешно.\n";
} catch (PDOException $e) {
    echo "Ошибка миграции: " . $e->getMessage() . "\n";
}
