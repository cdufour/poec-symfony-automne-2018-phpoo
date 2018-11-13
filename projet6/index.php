<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=projet6', 'root', 'root');;
} catch (PDOException $e) {
  var_dump($e);
}


$query = $pdo->prepare('SELECT count(*) FROM student');
$query->execute();
$nb_students = $query->fetch(PDO::FETCH_NUM)[0];
$nb_students_per_page = 10;
$nb_pages = ceil($nb_students / $nb_students_per_page);
$offset = 0;
$students = [];

if (isset($_GET['page'])) {
  $offset = (intval($_GET['page']) - 1) * $nb_students_per_page;

  $query = $pdo->prepare(
    'SELECT * FROM student LIMIT 10 OFFSET 10');

  $query->execute();

  // $query->execute([
  //   ':limit' => $nb_students_per_page,
  //   ':offset' => $offset
  // ]);

  $students = $query->fetchAll(PDO::FETCH_OBJ);
  var_dump($students);

}





?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Projet 6</title>
    <style>
      nav ul {
        list-style: none
      }
      nav ul li {
        display: inline-block;
        margin-right: 10px
      }
    </style>
  </head>
  <body>
    <h1>Projet 6</h1>

    <?php foreach($students as $student): ?>
    <p><?php echo $student->lastname . ' ('. $student->id .')'; ?></p>
    <?php endforeach; ?>

    <footer>
      <nav>
        <ul>
          <?php
            for($i=1; $i < $nb_pages + 1; $i++) {
              echo '<li>';
              echo '<a href="index.php?page='.$i.'">'.$i.'</a>';
              echo '</li>';
            }
          ?>
        </ul>
      </nav>
    </footer>
  </body>
</html>
