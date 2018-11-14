<nav>
  <ul>
    <li>
      <?php echo '<a href="'. URL_BASE .'index.php">Accueil</a>'; ?>
    </li>
    <li>
      <?php
        if (isset($_SESSION['user'])) {
          echo '<a href="'. URL_BASE .'logout.php">'. $_SESSION['user'] .' (Déconnexion)</a>';
        } else {
          echo '<a href="'. URL_BASE .'login.php">Connexion</a>';
        }
      ?>
    </li>
  </ul>
</nav>
