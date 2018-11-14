<nav>
  <ul>
    <li>
      <?php echo '<a href="'. URL_BASE .'index.php">Accueil</a>'; ?>
    </li>
    <?php
      if (isset($_SESSION['user'])) {

        if (isset($isUserAdmin) && $isUserAdmin) {
          // l'utilisateur loggué est administrateur
          echo '<li><a href="'. URL_BASE .'advert/index.php">Déposer une annonce</a></li>';
        }

        echo '<li>'.$_SESSION['user'].' <a href="'. URL_BASE .'logout.php">(Déconnexion)</a></li>';
      } else {
        echo '<li><a href="'. URL_BASE .'login.php">Connexion</a></li>';
      }
    ?>
  </ul>
</nav>
