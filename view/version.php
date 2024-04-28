<?php
include '../config.php';
include '../controller/VersionC.php';
$id_contrat = null;
// Initialisation de la variable pour stocker les dates de modification
$dates_modification = array();
$versionController = new VersionC();
// Vérification si un ID de contrat est soumis
if(isset($_POST['id_contrat'])) {
    // Récupération de l'ID du contrat soumis
    $id_contrat = $_POST['id_contrat'];

    // Instanciation de la classe VersionC
    

    // Vérification si l'ID du contrat existe
    if($versionController->contratExists($id_contrat)) {
        // Appel de la fonction afficherDatesModificationContrat avec l'ID du contrat spécifié
        $dates_modification = $versionController->afficherDatesModificationContrat($id_contrat);
    } else {
        $message = "L'ID du contrat $id_contrat n'existe pas.";
    }
}

// Traitement de la suppression d'une version
if(isset($_POST['delete_version'])) {
    $id_version = $_POST['delete_version'];
    // Appel de la méthode de suppression dans le contrôleur
    $versionController->supprimerVersion($id_version);
    // Actualisation de la page pour refléter les modifications
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
    </style>
</head>
<body>
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
        <h2>Dates de Modification du Contrat</h2>
        <table>
            <thead>
                <tr>
                    <th>Date de Modification</th>
                    <th>idantifiant de l'employe</th>
                    <th>idantifiant deemployeur</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dates_modification as $data): ?>
                    <tr>
                        <td><?php echo $data['date_de_modification']; ?></td>
                        <td><?php echo $data['ID_employe']; ?></td>
                        <td><?php echo $data['ID_employeur']; ?></td>
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
