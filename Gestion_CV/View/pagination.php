<?php
include '../Controller/cvC.php';
include_once '../config.php';
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
    $currentPage = (int) strip_tags($_GET['page']);
}else{
    $currentPage = 1;
}
// On se connecte à là base de données


// On détermine le nombre total d'articles
$sql = 'SELECT COUNT(*) AS nb_cv FROM `cv`;';

// On prépare la requête
$db = config::getConnexion();
$query = $db->prepare($sql);

// On exécute
$query->execute();

// On récupère le nombre d'articles
$result = $query->fetch();

$nbcv = (int) $result['nb_cv'];

// On détermine le nombre d'articles par page
$parPage = 3;

// On calcule le nombre de pages total
$pages = ceil($nbcv / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM `cv` LIMIT :premier, :parpage;';

// On prépare la requête
$db = config::getConnexion();
$query = $db->prepare($sql);

$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);

// On exécute
$query->execute();

// On récupère les valeurs dans un tableau associatif
$articles = $query->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Liste des cv</h1>
                <table class="table">
                    <thead>
                        <th>ID cv</th>
                        <th>id user</th>
                        <th>id exp</th>
                        <th>diplom</th>
                        <th>formation</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach($articles as $article){
                        ?>
                            <tr>
                                <td><?= $article['id_cv'] ?></td>
                                <td><?= $article['id_utl'] ?></td>
                                <td><?= $article['id_exp'] ?></td>
                                <td><?= $article['diplome'] ?></td>
                                <td><?= $article['formation'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination">
                        <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++):  ?>
                        <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
                        <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./?page=<?= $page  ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php  endfor ?>
                        <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>
</body>
</html>
