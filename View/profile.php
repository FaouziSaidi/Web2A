<?php
 session_start();


 include '../Controller/userC.php';
 include '../Controller/employeC.php';
 include '../Controller/employeurC.php';

 $userC = new UserC();
 $user =  $userC->showUser($_SESSION["id"]);

 $role = get_role_by_id($_SESSION["id"]);

 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-S9ZkL6qTzvw1F+liZlM/8C4srwP+dFOnO6m4u8Cx1K3Zs2OetQcqnJUddI+tbVyo" crossorigin="anonymous">

    <link rel="stylesheet" href="../assets/css/register.css">
    <style>
        .profile_center {
      text-align: center;
        }
        
        .profile_photo img {
            width: 100px; /* Ajustez la largeur de la photo du profil selon vos besoins */
            height: 100px; /* Ajustez la hauteur de la photo du profil selon vos besoins */
            border-radius: 50%; /* Pour rendre l'image du profil circulaire */
        }
        .heading-inf {
        font-weight: 900;
        font-size: 14px;
        color: #00BFA6;
        display: inline-block; /* Pour que les éléments <p> s'affichent sur la même ligne */
        margin-right: 10px; /* Ajoute une marge à droite pour séparer les étiquettes des valeurs */
    }
    

    button {
 display: flex;
 height: 3em;
 width: 100px;
 align-items: center;
 justify-content: center;
 background-color: #00BFA6;
 border-radius: 20px;
 letter-spacing: 1px;
 transition: all 0.2s linear;
 cursor: pointer;
 border: 1px solid #00BFA6;
 background: #fff;
 
}

button > svg {
 margin-right: 5px;
 margin-left: 5px;
 font-size: 20px;
 transition: all 0.4s ease-in;
 fill: #00BFA6; 
}

button:hover > svg {
 font-size: 1.2em;
 transform: translateX(-5px);
}

button:hover {
 box-shadow: 9px 9px 33px #00BFA6, -9px -9px 33px #ffffff;
 transform: translateY(-2px);
}
button a, button span {
    text-decoration: none; /* Empêche le soulignement du texte à l'intérieur de la balise <a> et <span> */
}
.profile_buttons {
    text-align: right; /* Aligner le contenu à droite */
}
.login-button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #FF0000; /* Couleur de fond */
    color: #fff; /* Couleur du texte */
    text-decoration: none; /* Supprimer le soulignement du lien */
    border-radius: 20px; /* Ajouter des coins arrondis */
    transition: background-color 0.3s; /* Transition de couleur de fond */
}

.login-button:hover {
    background-color: #8B0000; /* Hover background color (orange) */
    
}
    </style>
</head>
<body>

<div class="container">
        <img src="../img/masar.png" width="60">
        <div class="heading" >Profile </div>
        <link rel="stylesheet" href="../assets/css/login.css">
        <div class="profile_center">
        <div class="profile_photo">
            <img src="../img/profile.jpg" alt="Profile Photo">
        </div>
        <h2 class="profile_name"><?php echo $_SESSION["fullname"]; ?></h2>
        <p><?php echo $role; ?></p>
    </div>
    <div>
    <p class="heading-inf">Date of Birth:</p>
    <span><?php echo $user['dob']; ?></span>
</div>
<div>
    <p class="heading-inf">Email:</p>
    <span><?php echo $user['email']; ?></span>
</div>
<div>
    <p class="heading-inf">Telephone:</p>
    <span><?php echo $user['telephone']; ?></span>
</div>


   
    <p class="profile_bio">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur ab tenetur cumque, modi
        minima necessitatibus consectetur enim culpa optio alias perspiciatis voluptates eaque praesentium commodi
        blanditiis ipsum laudantium expedita molestias!</p>
        <div class="profile_buttons">
    <div style="display: flex; justify-content: space-between;">
        <a href="index.php" style="margin-right: auto;">
            <button>
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 1024 1024">
                    <path d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"></path>
                </svg>
                <span>Back</span>
            </button>
        </a>
        <a href="delete.php?id=<?= $_SESSION["id"] ?>" class="login-button" style="margin-left: auto;">Delete Account</a>
    </div>
</div>

</div>
<script src="../assets/js/profile.js"></script>

</body>
</html>