<?php

require_once 'classes/Math.php';

$students = [
  'Carl', 'Séverine', 'Hicham'
];

for ($i = 0; $i < sizeof($students); $i++) {
  if ($students[$i] === 'Séverine') {
    // echo '<p style="color:pink;font-weight:bold">' . $students[$i] . '</p>';
  } else {
    // echo '<p>' . $students[$i] . '</p>';
  }

}

class Student {
  // propriétés
  public $firstname;
  public $lastname;

  // méthodes
  public function getIdentity() {
    return $this->firstname . ' ' . $this->lastname;
  }
}

// instantiation
$student = new Student();
$student->firstname = 'Naïm'; // accès en écriture (public)
$student->lastname = 'Bernardeschi';

// echo $student->getIdentity(); // appelle la méthode

$student2 = new Student();
// echo $student2->getIdentity();

class Teacher {
  public $firstname;
  public $lastname;

  function __construct($first, $last) {
    // hydratation
    $this->firstname = $first;
    $this->lastname = $last;
  }

  // méthodes
  public function getIdentity() {
    return $this->firstname . ' ' . $this->lastname;
  }
}


$greg = new Teacher('Greg', 'Le Millionnaire');
// echo $greg->getIdentity();
$greg->lastname = 'Le Milliardaire';
// echo $greg->getIdentity();


$num = 5;

function square($x) {
  return $x*$x;
}

function cube($x) {
  return $x*$x*$x;
}
// echo square($num);
// echo cube($num);

$nb = new Math(6);

// echo $nb->square();
// echo $nb->cube();
echo $nb->power(4);




?>
