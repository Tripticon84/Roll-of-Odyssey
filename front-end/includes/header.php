<?php session_start(); 
require_once $_SERVER['DOCUMENT_ROOT'] . '/front-end/script.php';

$bdd = PDOConnect();
if (isset($_SESSION['email'])) {
  $q = 'SELECT id_uti,pseudo,avatar FROM UTILISATEUR WHERE email = :email';
  $req = $bdd->prepare($q);
  $req->execute([
    'email' => $_SESSION['email']
  ]);
  $user = $req->fetch(PDO::FETCH_ASSOC);
}
?>
<header class="bg-body-tertiary">
  <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top border-bottom border-1 border-black">
    <div class="container-fluid flex-sm-wrap">
      <a href="#" class="navbar-brand">
        <img src="/front-end/img/logo256px.png" alt="logo" height="150px">
        <span class="text-decoration-none m-1 fw-bold d-none d-sm-inline">Roll of Odyssey</span>
      </a>
      <!-- Bouton extend -->
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- NavBar / OffCanvas -->
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">

        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Roll of Odyssey</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Fermer"></button>
        </div>

        <div class="offcanvas-body justify-content-between text-nowrap flex-sm-wrap">
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a class="nav-link" aria-current="page" href="/front-end/index.php">Accueil</a>
            </li>
            <?php
            if (isset($_SESSION['email'])) { ?>
              <li class="nav-item">
                <a href="workshop/index.php" class="nav-link">Workshop</a>
              </li>
            <?php } ?>
            <li class="nav-item">
              <a href="#" class="nav-link">Règles</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">Support</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">À propos</a>
            </li>
          </ul>

          <!-- Boutons login -->
          <?php
          if (isset($_SESSION['email'])) { ?>

            <div class="dropdown text-start">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle me-5" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/image/users/<?= $user['avatar'] == NULL ? 'default' : $user['avatar'] ?>-64px.png" alt="mdo" width="32" height="32" class="rounded-circle">
              </a>
              <ul class="dropdown-menu text-small" style="" data-popper-placement="bottom-start">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
              </ul>
            </div>

          <?  } else { ?>
            <ul class="navbar-nav">
              <li class="nav-item mx-2">
                <a id="sign-up" class="btn btn-primary fw-bold" href="/front-end/login/sign-up.php" role="button">S'inscrire</a>
              </li>
              <li class="nav-item mx-2">
                <a id="log-in" class="btn btn-outline-primary fw-bold" href="/front-end/login/sign-in.php" role="button">Se connecter</a>
              </li>
            </ul>
          <?php } ?>
        </div>
      </div>
    </div>
  </nav>
</header>