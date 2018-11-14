<?php
session_start();
require_once PATH_BASE . 'classes/Access.php';

$isUserAdmin = false;

// vérification des droits
if (isset($_SESSION['user'])) {
  $access = new Access();
  $role = $access->getRoleByPseudo($_SESSION['user']);

  if ($role != false && $role->role == 'admin') {
    $isUserAdmin = true;
  }
}

?>
