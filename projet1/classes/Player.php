<?php

class Player {
  private $id;
  private $name;
  private $position;

  function __construct($name, $position) {
    $this->name = $name;
    $this->position = $position;
  }

  public function getName() { return $this->name; }
  public function getPosition() { return $this->position; }


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

}


?>
