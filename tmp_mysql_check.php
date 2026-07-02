<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;charset=utf8mb4', 'root', '');
    echo "mysql ok";
} catch (Throwable $e) {
    echo $e->getMessage();
}
