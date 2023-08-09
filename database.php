<?php
session_start();
$conn = new PDO('mysql:dbname=product;host=localhost', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>