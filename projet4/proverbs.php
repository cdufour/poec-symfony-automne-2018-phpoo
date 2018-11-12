<?php
$category = '';

if (isset($_GET['category']))
  $category = $_GET['category'];

try {
  $pdo = new PDO('mysql:host=localhost;dbname=projet3', 'root', 'root');
} catch (PDOException $e) {
  var_dump($e);
}

$query = $pdo->prepare(
  'SELECT body
    FROM proverb_category
    JOIN category
    ON category.id = proverb_category.category_id
    JOIN proverb
    ON proverb.id = proverb_category.proverb_id
    WHERE category.name = :category
  ');
$query->execute([':category' => $category]);
$rows = $query->fetchAll(PDO::FETCH_OBJ);

echo json_encode($rows);

?>
