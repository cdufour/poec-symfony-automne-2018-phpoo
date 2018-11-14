<nav>
  <ul>
    <li>
      <a href="index.php">Accueil</a>
    </li>
    <li>
      <?php
        if (isset($_SESSION['user'])) {
          echo '<a href="logout.php">Déconnexion</a>';
        } else {
          echo '<a href="login.php">Connexion</a>';
        }
      ?>
    </li>
  </ul>
</nav>
