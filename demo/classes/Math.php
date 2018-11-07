<?php

class Math {
  private $val;

  function __construct($val) {
    $this->val = $val;
  }

  public function square() {
    return $this->val * $this->val;
  }

  public function cube() {
    return $this->val * $this->val * $this->val;
  }

  public function power($x) {
    $total = 1;

    for($i=0; $i<$x; $i++) {
      $total *= $this->val;
    }

    return $total;
  }

}

?>
