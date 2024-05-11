<?php
error_reporting(E_ALL);
include '../config.php';
include '../controller/versionC.php';

$id_contrat = null;
$versionController = new VersionC();

// Vérifier si l'ID du contrat est passé en paramètre GET


function affiche($id_contrat)
{
    $sql = "SELECT v.id_version, v.date_de_modification, v.pdf, c.ID_employe, c.ID_employeur
            FROM version v
            INNER JOIN contrat c ON v.id_contrat = c.id
            WHERE v.id_contrat = :id_contrat";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->bindParam(':id_contrat', $id_contrat, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


if(isset($_POST['id_contrat'])) {
    $id_contrat = $_POST['id_contrat'];

    if($versionController->contratExists($id_contrat)) {
        $dates_modification = affiche($id_contrat);
        //var_dump($dates_modification);
    } else {
        $message = "L'ID du contrat $id_contrat n'existe pas.";
    }
}

if(isset($_POST['delete_version'])) {
    $id_version = $_POST['delete_version'];
    $versionController->supprimerVersion($id_version);
    header("Location: version.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>  Dates de Modification</title>
    
    <link rel="stylesheet" href="../assets/css/style_version.css">
    <style>
        .delete-link {
            color: red;
            cursor: pointer;
        }
        .icon-button {
    background-color: transparent; /* Fond transparent */
    border: none; /* Pas de bord */
    cursor: pointer; /* Curseur pointeur */
    padding: 8px 16px; /* Espacement intérieur */
    font-size: 16px; /* Taille du texte */
    color: #00BFA6; /* Couleur du texte */
    transition: color 0.3s ease; /* Transition de couleur douce */
    outline: none; /* Pas de contour */
}

.icon-button:hover {
    color: #0056b3; /* Couleur du texte au survol */
}

.icon {
    margin-right: 8px; /* Marge à droite de l'icône */
    font-size: 20px; /* Taille de l'icône */
}

    </style>
</head>
<body>
<button class="icon-button" onclick=window.location.href='recherche.php'><i>Back to contrat</i></button>
    <center>

    <h1>Dates de Modification d'un Contrat</h1>
    
    <form method="post" action="">
        <label for="id_contrat">ID du Contrat </label>
        <input type="text" id="id_contrat" name="id_contrat">
        <button type="submit"id=boutton>Valider</button>
    </form>

    <?php if(isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php elseif(isset($dates_modification) && !empty($dates_modification)): ?>
        <h2>Les versions du Contrat</h2>
        <table>
            <thead>
                <tr>
                    <th>id version</th>
                    <th>Date de Modification</th>
                    <th>idantifiant de l'employe</th>
                    <th>idantifiant de l'employeur</th>
                    <th>pdf</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates_modification as $data): ?>
                    <tr>
                        <td><?php echo $data['id_version']; ?></td>
                        <td><?php echo $data['date_de_modification']; ?></td>
                        <td><?php echo $data['ID_employe']; ?></td>
                        <td><?php echo $data['ID_employeur']; ?></td>
                        <?php $filename = $data['pdf'];
                              $path = 'http://localhost/met/view/pdf/' . $filename;  ?>
                        <td>
                            
                            <a href="<?= $path; ?>" target="_blank">
                            <svg viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg" class="icon">
                                <path d="M0 0h24v24H0z" fill="none"/>
                                <path d="M18 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-5 15h-4v-2h4v2zm4-4H7v-2h10v2zm0-3H7V8h10v2z" fill="red"/> <!-- Ajout de la propriété fill="red" -->
                            </svg>

                        </td>

                        <td>
                            <!-- Ajout d'un formulaire pour supprimer la version -->
                            <form method="post" action="">
                                <input type="hidden" name="delete_version" value="<?php echo $data['id_version']; ?>">
                                <button type="submit" class="btn">
                                <svg viewBox="0 0 15 17.5" height="17.5" width="15" xmlns="http://www.w3.org/2000/svg" class="icon">
                                    <path transform="translate(-2.5 -1.25)" d="M15,18.75H5A1.251,1.251,0,0,1,3.75,17.5V5H2.5V3.75h15V5H16.25V17.5A1.251,1.251,0,0,1,15,18.75ZM5,5V17.5H15V5Zm7.5,10H11.25V7.5H12.5V15ZM8.75,15H7.5V7.5H8.75V15ZM12.5,2.5h-5V1.25h5V2.5Z" id="Fill"></path>
                                </svg>
                                <span class="btn-text">Supprimer</span>
                                </button>

                            </form>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    </center>
</body>
</html>
