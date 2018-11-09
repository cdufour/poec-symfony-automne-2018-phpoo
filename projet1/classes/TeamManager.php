<?php
require_once 'Team.php';
require_once 'Player.php';

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
        $row->name, $row->yearFoundation, $row->league, $row->stadium, $row->coach, $row->logo);

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

    $query->execute(array(':id' => $id));
    $row = $query->fetch(PDO::FETCH_OBJ);
    // fetch renvoie false quand aucun résultat n'est trouvé

    // dans le cas où l'id recherché n'existe pas en
    // DB,  findById renvoie null
    if (!$row) {
      return null;
    }

    $team = new Team(
      $row->name, intval($row->yearFoundation), $row->league, $row->stadium, $row->coach, $row->logo);

    $team->setId(intval($row->id));
    return $team;
  }

  public function findByIdJoin($id) {
    $query = $this->pdo->prepare(
    'SELECT
      team.id AS teamId,
      team.name AS teamName,
      yearFoundation,
      league,
      stadium,
      coach,
      logo,
      player.id AS playerId,
      player.name AS playerName,
      position,
      team_id
    FROM team
    LEFT JOIN player ON player.team_id = team.id
    WHERE team.id = :id
    ');

    $query->execute([':id' => intval($id)]);
    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    // on récupère les données de l'équipe
    // afin de créer un objet Team et de lui
    // fournir une partie des données

    $team = new Team(
      $rows[0]->teamName,
      $rows[0]->yearFoundation,
      $rows[0]->league,
      $rows[0]->stadium,
      $rows[0]->coach,
      $rows[0]->logo
    );
    $team->setId($rows[0]->teamId);

    // ajout des joueurs à l'objet Team
    foreach($rows as $row) {
      // on ajoute le joueur dans le tableau que si
      // la propriété playerName n'est pas null
      if ($row->playerName != null) {
        $player = new Player($row->playerName,$row->position);
        $player->setId(intval($row->playerId));
        $team->addPlayer($player);
      }
    }

    return $team;
  }

  public function findByLeague($league) {
    $query = $this->pdo->prepare(
      'SELECT * FROM team WHERE league = :league');
    $query->execute([':league' => $league]);
    $rows = $query->fetchAll(PDO::FETCH_OBJ);

    $teams = [];
    foreach($rows as $row) {
      $team = new Team(
        $row->name,
        intval($row->yearFoundation),
        $row->league,
        $row->stadium,
        $row->coach,
        $row->logo);

      $team->setId($row->id);
      $teams[] = $team; // push
    }
    return $teams;

  }

} // fin classe
?>
