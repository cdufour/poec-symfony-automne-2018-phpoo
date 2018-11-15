<?php
//file: category/index.php
include_once '../includes/settings.inc.php';
include_once PATH_BASE . 'includes/checkaccess.inc.php';
include_once PATH_BASE . 'includes/db.inc.php';

$pdo = connectToDb();
$query = $pdo->prepare(
  'SELECT * FROM category ORDER BY name ASC');
$query->execute();
$categories = $query->fetchAll(PDO::FETCH_OBJ);
?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Projet 2: Catégories</title>
     <?php include PATH_BASE . 'includes/css.inc.php'; ?>
   </head>
   <body>
     <header>
       <?php include PATH_BASE . 'includes/menu.inc.php'; ?>
       <h1>Catégories</h1>
     </header>

     <div>
       <a class="btn btn-primary btn-sm"
         href="<?php echo URL_BASE . 'category/add.php'; ?>">
         Ajouter une catégorie</a>
     </div>

    <table class="table table-striped table-bordered">
     <?php foreach($categories as $category): ?>
       <tr>
         <td><?php echo $category->id; ?></td>
         <td><?php echo $category->name; ?></td>
       </tr>
     <?php endforeach; ?>
   </table>

   </body>
 </html>
