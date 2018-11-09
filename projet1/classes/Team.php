<?php

// require_once 'Player';

class Team {
  private $id;
  private $name;
  private $yearFoundation;
  private $league;
  private $stadium;
  private $coach;
  private $logo;

  private $players = []; // tableau vide

  private $pdo; // utile pour la communication avec DB

  function __construct(
    $name, $yearFoundation, $league, $stadium, $coach, $logo = null) {
      $this->name = $name;
      $this->yearFoundation = $yearFoundation;
      $this->league = $league;
      $this->stadium = $stadium;
      $this->coach = $coach;
      $this->logo = $logo;

      // injection de dépendance (DI)
      // instatiation d'une classe A dans le constructeur
      // d'une classe B
      try {
        $this->pdo = new PDO('mysql:host=localhost;dbname=poo', 'root', 'root');
      } catch (PDOException $e) {
        var_dump($e);
      }
    }

  // getters (accesseurs) LECTURE
  public function getId() { return $this->id; }

  public function getName() {
    return $this->name;
  }

  public function getYearFoundation() {
    return $this->yearFoundation;
  }

  public function getLeague() {
    return $this->league;
  }

  public function getStadium() {
    return $this->stadium;
  }

  public function getCoach() {
    return $this->coach;
  }

  public function getLogo() {
    return $this->logo;
  }

  public function getPlayers() {
    return $this->players;
  }

  // setters (mutateurs) ECRITURE

  public function setId($id) {
    $this->id = $id;
    return $this->id;
  }

  public function setName($name) {
    $this->name = $name; // met à jour la propriété
    return $this->name; // retour facultatif
  }
  public function setYearFoundation($yearFoundation) {
    $this->yearFoundation = $yearFoundation;
    return $this->yearFoundation;
  }
  public function setLeague($league) {
    $this->league = $league;
    return $this->league;
  }
  public function setStadium($stadium) {
    $this->stadium = $stadium;
    return $this->stadium;
  }
  public function setCoach($coach) {
    $this->coach = $coach;
    return $this->coach;
  }
  public function setLogo($logo) {
    $this->logo = $logo;
    return $this->logo;
  }

  public function addPlayer(Player $player) {
    // push de l'objet Player dans le tableau
    $this->players[] = $player;
  }

  public function save() {
    // enregistrement en base de données
    $query = $this->pdo->prepare(
      'INSERT INTO team(name, yearFoundation, league, stadium, coach, logo)
      VALUES (:name, :yearFoundation, :league, :stadium, :coach, :logo)');

    $query->bindParam(':name', $this->name);
    $query->bindParam(':yearFoundation', $this->yearFoundation);
    $query->bindParam(':league', $this->league);
    $query->bindParam(':stadium', $this->stadium);
    $query->bindParam(':coach', $this->coach);
    $query->bindParam(':logo', $this->logo);

    // éxecute la requête sql et renvoie true si réussie
    return $query->execute();

  }

  public function update() {
    $query = $this->pdo->prepare(
      'UPDATE team
        SET
          name = :name,
          yearFoundation = :yearFoundation,
          league = :league,
          stadium = :stadium,
          coach = :coach
        WHERE id = :id
    ');

    return $query->execute([
      ':name' => $this->name,
      ':yearFoundation' => $this->yearFoundation,
      ':league' => $this->league,
      ':stadium' => $this->stadium,
      ':coach' => $this->coach,
      ':id' => $this->id
    ]);
  }

  public function delete() {
    $query = $this->pdo->prepare(
      'DELETE FROM team WHERE id = :id');
    return $query->execute([':id' => $this->id]);
  }


}



?>
