<?php
class Database {
private static $db;

public static function connect() {
if (!self::$db) {
self::$db = new PDO('mysql:dbname=test_example;host=127.0.0.1', 'root', '');
self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

return self::$db;
}
}
