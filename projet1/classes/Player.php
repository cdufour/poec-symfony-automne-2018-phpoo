<?php
require_once 'Team.php';

class Player {
  private $id;
  private $name;
  private $position;
  private $team; // objet de type Team
  private $pdo;

  function __construct($name, $position, Team $team = null) {
    // on rend le 3ieme argument optionnel en lui affectant
    // une valeur par défaut
    $this->name = $name;
    $this->position = $position;
    $this->team = $team;

    try {
      $this->pdo = new PDO('mysql:host=localhost;dbname=poo', 'root', 'root');
    } catch (PDOException $e) {
      var_dump($e);
    }
  }

  public function getId() { return $this->id; }
  public function getName() { return $this->name; }
  public function getPosition() { return $this->position; }
  public function getTeam() { return $this->team; }


  public function setId($id) {
    $this->id = $id;
    return $this->id;
  }

  public function setName($name) {
    $this->name = $name;
    return $this->name;
  }

  public function setPosition($position) {
    $this->position = $position;
    return $this->position;
  }

  public function setTeam(Team $team) {
    $this->team = $team;
    return $this->team;
  }

  public function save() {
    $query = $this->pdo->prepare(
      'INSERT INTO player (name, position, team_id)
      VALUES (:name, :position, :team_id)');

    return $query->execute(array(
      ':name' => $this->name,
      ':position' => $this->position,
      ':team_id' => $this->team->getId()
    ));
  }

}


?>
