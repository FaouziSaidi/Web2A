<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../assets/css/stylejob.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../assets/css/style.css" rel="stylesheet">
    <style>
        .task {
  position: relative;
  color: #2e2e2f;
  cursor: move;
  background-color: #fff;
  padding: 1rem;
  border-radius: 8px;
  box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
  margin-bottom: 1rem;
  border: 3px dashed transparent;
  max-width: 350px;
}

.task:hover {
  box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;
  border-color: rgba(162, 179, 207, 0.2) !important;
}

.task p {
  font-size: 15px;
  margin: 1.2rem 0;
}

.tag {
  border-radius: 100px;
  padding: 4px 13px;
  font-size: 12px;
  color: #ffffff;
  background-color: #1389eb;
}

.tags {
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.options {
  background: transparent;
  border: 0;
  color: #c4cad3;
  font-size: 17px;
}

.options svg {
  fill: #9fa4aa;
  width: 20px;
}

.stats {
  position: relative;
  width: 100%;
  color: #9fa4aa;
  font-size: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.stats div {
  margin-right: 1rem;
  height: 20px;
  display: flex;
  align-items: center;
  cursor: pointer;
}

.stats svg {
  margin-right: 5px;
  height: 100%;
  stroke: #9fa4aa;
}

.viewer span {
  height: 30px;
  width: 30px;
  background-color: rgb(28, 117, 219);
  margin-right: -10px;
  border-radius: 50%;
  border: 1px solid #fff;
  display: grid;
  align-items: center;
  text-align: center;
  font-weight: bold;
  color: #fff;
  padding: 2px;
}

.viewer span svg {
  stroke: #fff;
}

.CardWithForm {
    width: 350px;
    font-family: Arial, sans-serif;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 16px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .CardHeader {
    margin-bottom: 12px;
  }

  .CardTitle {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 4px;
  }

  .CardDescription {
    font-size: 0.9rem;
    color: #666;
  }

  .CardContent {
    margin-bottom: 12px;
  }

  .grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .flex {
    display: flex;
    flex-direction: column;
  }

  .space-y-1\\.5 > * {
    margin-top: 6px;
  }

  label {
    font-size: 1rem;
    font-weight: bold;
  }

  input, button {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
  }

  button {
    cursor: pointer;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 1rem;
  }

  button.outline {
    background-color: transparent;
    border: 1px solid #007bff;
    color: #007bff;
  }

  button:hover {
    background-color: #0056b3;
  }

  .Select {
    position: relative;
    display: inline-block;
  }

  .SelectTrigger {
    cursor: pointer;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
  }

  .SelectValue {
    color: #666;
  }

  .SelectContent {
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    z-index: 1;
  }

  .SelectItem {
    padding: 8px;
    cursor: pointer;
  }

  .CardFooter {
    display: flex;
    justify-content: flex-end;
    width: calc(100% - 32px); /* Adjust this value as needed */
  }

  .CardFooter .Button {
    margin-left: 8px;
  }

  .CardFooter .Button:first-child {
    margin-left: 0;
  }

    </style>
</head>
<body>

<header class="header">
            <nav class="navbar navbar-expand-lg fixed-top">
                <div class="container"> 
                  <img src="../img/masar.png" alt="Logo Masar" width="100">
                  
                  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                      <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                      <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item">
                          <a class="nav-link mx_lg_2 main-nav-link"  href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active main-nav-link" aria-current="page" href="frontjob.php">jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx_lg_2 main-nav-link" href="ajouterreclamation.php">reclamation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link mx_lg_2 main-nav-link" href="listCV.php">CV</a>
                        </li>
                        <?php
                if (isset($_SESSION["fullname"])) {
                echo'<li class="nav-item">
                    <a class="nav-link mx_lg_2 main-nav-link" href="ajoutercontrat.php">contrat</a>
                </li>';
                }
                ?>
                        <li class="nav-item">
                            <a class="nav-link mx_lg_2 main-nav-link" href="blogs_frontpage.php">Blog</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <?php
          if (!isset($_SESSION["fullname"])) {
            
            echo '<button class="login-button" onclick="window.location.href=\'login.php\'">Log in</button>';
            echo '<button class="login-button" style="margin-left: 10px;" onclick="window.location.href=\'register.php\'">Sign-Up</button>';
            
            
          } else {
              echo '<div class="dropdown">';
              echo '<span class="username">'.$_SESSION["fullname"].'</span>';
              echo '<a href="profile.php"><img src="../img/profil.png" class="profile-image"></a>';
              echo '<a href="logout.php"><img src="../img/logout.png" class="logout-image"></a>';
              echo '</div>';
          }
          ?>
                    <span class="navbar-toggler-icon"></span>
                  </button>
                </div>
            </nav>
            <script>
        window.onscroll = function() {scrollFunction()};
      
        function scrollFunction() {
          if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.querySelector('.navbar').classList.add('scroll');
          } else {
            document.querySelector('.navbar').classList.remove('scroll');
          }
        }
      </script>
            <script src="../assets/js/script1.js"></script>
           
        
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
              <style>
  .navbar {
            box-shadow: 0 4px 8px rgba(0, 191, 166, 0.7); /* Custom color shadow */
            
        }

        .navbar.scroll {
            box-shadow: 0 4px 12px rgba(0, 191, 166, 0.9); /* Darker custom color shadow when scrolling */
        }

                </style>
        </header>
<br><br><br><br><br><br>

<div >

  <?php
// Include the jobC.php file to access job data
include("../controller/jobC.php");

// Create an instance of the jobC class
$jobClass = new jobC;

// Fetch the list of jobs from the database
$jobList = $jobClass->listejob();

// Loop through each job and generate HTML dynamically
foreach ($jobList as $job) {
  ?>
    <div class="container shadow-lg border" style="padding-left: 17%; padding-right: 17%; margin-top: 30px; ">
      
<div class="row">
  <div class="col-md-6">
    <div class="p-2">
      <div class="CardHeader">
        <h2 class="CardTitle"><?php echo $job["title"]; ?></h2>
        <p class="CardDescription"><?php echo $job["others"]; ?></p>
      </div>
    </div>
  </div>
  <div class="col-md-6 d-flex align-items-center justify-between">
    <div class="p-2" style="width: 200px;">
      <div class="d-flex align-items-center">
        <h7 class="mr-2" style="padding-right:1%;"><?php echo $job["date_of_creation"]; ?></h7>
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
      </div>
    </div>
    <div class="p-2" style="margin-left:40%">
      <div class="CardFooter">
        <button class="Button outline" onclick="window.location.href='http://localhost/integration_finale/View/SaveApplyJob.php?job=<?php echo $job["id"]; ?>&type=0';">Apply</button>
        <button class="Button" onclick="window.location.href='http://localhost/integration_finale/View/SaveApplyJob.php?job=<?php echo $job["id"]; ?>&type=1';">Save</button>
        <button class="Button" onclick="window.location.href='AiServerCall.php'" style="float: right;">AI</button>

      </div>
    </div>
  </div>
</div>
</div>
<?php
}
?>
</div>





<footer class="footer">
  <div class="container">
    <div class="row">
      <div class="footer-col">
        <h4>Explorer</h4>
        <ul>
            <li><a href="#">Offres d'emploi</a></li>
            <li><a href="#">Entreprises</a></li>
            <li><a href="#">Salons de l'emploi</a></li>
            <li><a href="#">Conseils carrière</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Assistance</h4>
        <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Contactez-nous</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
        </ul>
    </div>
    <div class="footer-col">
        <h4>Ressources</h4>
        <ul>
            <li><a href="#">CV et lettres de motivation</a></li>
            <li><a href="#">Modèles d'entretiens</a></li>
            <li><a href="#">Formations en ligne</a></li>
            <li><a href="#">Guides de recherche d'emploi</a></li>
        </ul>
    </div>
    
      <div class="footer-col">
        <h4>follow us</h4>
        <div class="social-buttons">
          <a href="#" class="social-button github">
            <svg class="cf-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="-2.5 0 19 19"><path d="M9.464 17.178a4.506 4.506 0 0 1-2.013.317 4.29 4.29 0 0 1-2.007-.317.746.746 0 0 1-.277-.587c0-.22-.008-.798-.012-1.567-2.564.557-3.105-1.236-3.105-1.236a2.44 2.44 0 0 0-1.024-1.348c-.836-.572.063-.56.063-.56a1.937 1.937 0 0 1 1.412.95 1.962 1.962 0 0 0 2.682.765 1.971 1.971 0 0 1 .586-1.233c-2.046-.232-4.198-1.023-4.198-4.554a3.566 3.566 0 0 1 .948-2.474 3.313 3.313 0 0 1 .091-2.438s.773-.248 2.534.945a8.727 8.727 0 0 1 4.615 0c1.76-1.193 2.532-.945 2.532-.945a3.31 3.31 0 0 1 .092 2.438 3.562 3.562 0 0 1 .947 2.474c0 3.54-2.155 4.32-4.208 4.548a2.195 2.195 0 0 1 .625 1.706c0 1.232-.011 2.227-.011 2.529a.694.694 0 0 1-.272.587z"></path></svg>
              
                    </g>
                </g>
            </svg>
          </a>
          <a href="#" class="social-button facebook">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 310 310" xml:space="preserve">
        <g id="XMLID_834_">
          <path id="XMLID_835_" d="M81.703,165.106h33.981V305c0,2.762,2.238,5,5,5h57.616c2.762,0,5-2.238,5-5V165.765h39.064
            c2.54,0,4.677-1.906,4.967-4.429l5.933-51.502c0.163-1.417-0.286-2.836-1.234-3.899c-0.949-1.064-2.307-1.673-3.732-1.673h-44.996
            V71.978c0-9.732,5.24-14.667,15.576-14.667c1.473,0,29.42,0,29.42,0c2.762,0,5-2.239,5-5V5.037c0-2.762-2.238-5-5-5h-40.545
            C187.467,0.023,186.832,0,185.896,0c-7.035,0-31.488,1.381-50.804,19.151c-21.402,19.692-18.427,43.27-17.716,47.358v37.752H81.703
            c-2.762,0-5,2.238-5,5v50.844C76.703,162.867,78.941,165.106,81.703,165.106z"></path>
        </g>
        </svg>
          </a>
          <a href="#" class="social-button instagram">
            <svg width="800px" height="800px" viewBox="0 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            <g id="Page-1" stroke="none" stroke-width="1">
                <g id="Dribbble-Light-Preview" transform="translate(-340.000000, -7439.000000)">
                    <g id="icons" transform="translate(56.000000, 160.000000)">
                        <path d="M289.869652,7279.12273 C288.241769,7279.19618 286.830805,7279.5942 285.691486,7280.72871 C284.548187,7281.86918 284.155147,7283.28558 284.081514,7284.89653 C284.035742,7285.90201 283.768077,7293.49818 284.544207,7295.49028 C285.067597,7296.83422 286.098457,7297.86749 287.454694,7298.39256 C288.087538,7298.63872 288.809936,7298.80547 289.869652,7298.85411 C298.730467,7299.25511 302.015089,7299.03674 303.400182,7295.49028 C303.645956,7294.859 303.815113,7294.1374 303.86188,7293.08031 C304.26686,7284.19677 303.796207,7282.27117 302.251908,7280.72871 C301.027016,7279.50685 299.5862,7278.67508 289.869652,7279.12273 M289.951245,7297.06748 C288.981083,7297.0238 288.454707,7296.86201 288.103459,7296.72603 C287.219865,7296.3826 286.556174,7295.72155 286.214876,7294.84312 C285.623823,7293.32944 285.819846,7286.14023 285.872583,7284.97693 C285.924325,7283.83745 286.155174,7282.79624 286.959165,7281.99226 C287.954203,7280.99968 289.239792,7280.51332 297.993144,7280.90837 C299.135448,7280.95998 300.179243,7281.19026 300.985224,7281.99226 C301.980262,7282.98483 302.473801,7284.28014 302.071806,7292.99991 C302.028024,7293.96767 301.865833,7294.49274 301.729513,7294.84312 C300.829003,7297.15085 298.757333,7297.47145 289.951245,7297.06748 M298.089663,7283.68956 C298.089663,7284.34665 298.623998,7284.88065 299.283709,7284.88065 C299.943419,7284.88065 300.47875,7284.34665 300.47875,7283.68956 C300.47875,7283.03248 299.943419,7282.49847 299.283709,7282.49847 C298.623998,7282.49847 298.089663,7283.03248 298.089663,7283.68956 M288.862673,7288.98792 C288.862673,7291.80286 291.150266,7294.08479 293.972194,7294.08479 C296.794123,7294.08479 299.081716,7291.80286 299.081716,7288.98792 C299.081716,7286.17298 296.794123,7283.89205 293.972194,7283.89205 C291.150266,7283.89205 288.862673,7286.17298 288.862673,7288.98792 M290.655732,7288.98792 C290.655732,7287.16159 292.140329,7285.67967 293.972194,7285.67967 C295.80406,7285.67967 297.288657,7287.16159 297.288657,7288.98792 C297.288657,7290.81525 295.80406,7292.29716 293.972194,7292.29716 C292.140329,7292.29716 290.655732,7290.81525 290.655732,7288.98792" id="instagram-[#167]">
        
        </path>
                    </g>
                </g>
            </g>
        </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>




</body>
</html>
