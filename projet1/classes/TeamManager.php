<?php
require_once 'Team.php';

class TeamManager {
  private $pdo = null;

  function __construct() {
    $this->connect(); // DI
  }

  private function connect() {
    try {
      $this->pdo = new PDO('mysql:host=localhost;dbname=poo', 'root', 'root');
    } catch(PDOException $e) {
      var_dump($e);
    }
  }

  public function findAll() {
    // vérification de l'état connecté (à la base)
    // l'injection de dépendance rend inutile cette vérification
    // if ($this->pdo == null) {
    //   $this->connect();
    // }

    $query = $this->pdo->prepare('SELECT * FROM team');
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    $teams = [];
    foreach($rows as $row) {
      $team = new Team(
        $row->name, $row->yearFoundation, $row->league, $row->stadium, $row->coach);

      // on ajoute l'id à l'objet de manière à cette info
      // soit disponible ailleurs dans l'application
      $team->setId($row->id);
      array_push($teams, $team);
    }

    return $teams;
  }

  public function findById($id) {
    $query = $this->pdo->prepare(
      'SELECT * FROM team WHERE id = :id');
    // $query->bindParam(':id', $id);
    $query->execute(array(':id' => $id));
    $row = $query->fetch(PDO::FETCH_OBJ);

    $team = new Team(
      $row->name, $row->yearFoundation, $row->league, $row->stadium, $row->coach);

    return $team;
  }

}

?>
