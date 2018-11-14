<?php
require_once PATH_BASE . 'includes/db.inc.php';

class Access {
  private $pdo = null;

  function __construct() {
    // ** injection de dépendance **
    // on utilise le retour de la function connectToDB provenant
    // du fichier db.inc.php pour hydrater le propriété
    // pdo de la classe Access
    $this->pdo = connectToDb();
  }

  public function getRoleByPseudo($pseudo) {
    $query = $this->pdo->prepare(
      'SELECT role FROM user WHERE pseudo = :pseudo');

    $query->execute([':pseudo' => $pseudo]);
    $role = $query->fetch(PDO::FETCH_OBJ);
    return $role;
  }

}

?>
