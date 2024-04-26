<?php
$title = 'Workshop';

require_once 'workshop_search.php';
require_once 'workshop_create.php';

// Logs pages visitée
require_once '../script.php';
logPage($title);

// Connexion à la BDD
$bdd = PDOConnect();

include('../includes/head.php');

// Récupérer les tags
$q = 'SELECT nom,description FROM TAG;';
$req = $bdd->prepare($q);
$req->execute([]);
$tags = $req->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
    <?php include('../includes/header.php'); ?>
    <main class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col justify-content-between" style="text-align: start;">
                    <a name="back" id="back" class="btn btn-primary bi bi-arrow-left" href="#" role="button"> Retour</a>
                </div>
                <div class="col" style=" text-align: end;">
                    <a name="create" id="buttonCreate" class="btn btn-primary bi bi-plus-circle" href="#" role="button"> Créer</a>

                </div>
            </div>
            <div class="row mt-3">
                <!-- Sidebar -->
                <div class="d-flex flex-column col-3 bg-body-tertiary p-3 rounded-3">
                        <label for="search">Rechercher</label>
                        <input type="text" name="search" id="search" class="form-control" placeholder="Rechercher une campagne" oninput="searchCampaigns()">
                        <select name="order" id="order" class="form-select mt-2" oninput="searchCampaigns()">
                            <option value="asc">Croissant</option>
                            <option value="desc">Décroissant</option>
                        </select>
                        <select name="sort" id="sort" class="form-select mt-2" oninput="searchCampaigns()">
                            <option value="nom" selected>Nom</option>
                        </select>
                    <hr>
                    <!-- Tags -->
                    <div class="d-flex flex-column tags">
                        <?php
                        foreach ($tags as $tag) {
                            echo  '<a name="tag" id="tag" class="btn btn-primary mt-3 ';

                            if (isset($_GET[strtolower($tag['nom'])]) && !empty($_GET[strtolower($tag['nom'])]) && $_GET[strtolower($tag['nom'])] == 1)
                                echo 'disabled';
                            else
                                echo 'enabled';

                            echo '" href="' . '?' . strtolower($tag['nom']) . '=1' . '" role="button" title="' . $tag['description'] . '"';

                            echo '>' . $tag['nom'] . '</a>';
                        }

                        ?>
                    </div>
                </div>

                <!-- Campagne -->
                <div class="d-flex col-9 bg-body-tertiary rounded-3 p-3" id="result">

                </div>
            </div>
        </div>
        <script>
            searchCampaigns();
        </script>
    </main>
</body>