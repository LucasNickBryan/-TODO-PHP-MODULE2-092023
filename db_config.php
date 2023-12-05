<?php

define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'todolist');
define('DB_USER', 'root');
define('DB_PASS', '');


function connect() {
    try {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        die("Erreur de connexion : " . $e->getMessage());
    }
}
?>
