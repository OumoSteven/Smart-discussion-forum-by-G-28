<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=smart_discussion_forum;charset=utf8mb4', 'root', '');
foreach ($pdo->query('SHOW TABLES') as $row) {
    echo $row[0] . PHP_EOL;
}
