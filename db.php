<?php
$dsn = 'mysql:host=mysql3112.db.sakura.ne.jp;dbname=renren_mama_meshi;charset=utf8';
$user = 'renren_mama_meshi';
$pass = 'Tarako007';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    exit('接続失敗: ' . $e->getMessage());
}