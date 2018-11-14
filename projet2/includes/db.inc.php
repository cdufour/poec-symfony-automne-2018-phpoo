<?php

function connectToDb() {
  try {
    $pdo = new PDO('mysql:host=localhost;dbname=projet2', 'root', 'root');
    return $pdo;
  } catch (PDOException $e) {
    return null;
  }
}

?>
