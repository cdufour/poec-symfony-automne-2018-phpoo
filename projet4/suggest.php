<?php
$search = '';
if (isset($_GET['search'])) $search = $_GET['search'];

try {
  $pdo = new PDO('mysql:host=localhost;dbname=projet3', 'root', 'root');
} catch (PDOException $e) {
  var_dump($e);
}

$query = $pdo->prepare(
  'SELECT name FROM category WHERE name LIKE :search');
$query->execute([':search' => '%' . $search . '%']);
$rows = $query->fetchAll(PDO::FETCH_OBJ);

// Version retour texte personnalisé avec séparateur
// $str = '';
// foreach($rows as $i => $row) {
//   $str .= $row->name;
//   // si ce n'est pas le dernier élément de mon tableau
//   // j'ajoute une virgule (élément séparateur) à la concaténation
//   if ($i < sizeof($rows) - 1) $str .= ',';
// }
// echo $str;

// Version retour standardisé en JSON
echo json_encode($rows);

?>
