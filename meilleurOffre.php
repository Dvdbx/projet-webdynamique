<?php

session_start();

//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);
$today = date("Y-m-d");

/*
$expire = $row->expireDate; //from database
$today_time = strtotime($today);
$expire_time = strtotime($expire);
*/

$prixmax = isset($_POST["Prix-max"])? $_POST["Prix-max"] : "";

$idObjet="";
$idAcheteur="";
$dateExpEnchere="";
$prixObjet="";

$prix1="";
$prix2="";
$idMeilleurOffre="";

$user="";
$informations="";
$gagne=false;

//On cherche l'id de l'acheteur connecté
 $sql = "SELECT * FROM acheteur WHERE connexion = '1'";
 $result = mysqli_query($db_handle, $sql);

 if(mysqli_num_rows($result) != 0)
 {
     $user = mysqli_fetch_assoc($result);
 }
 $idAcheteur = $user['idAcheteur'];


if($db_found)
{   
    //on sauvegarde l'id de l'objet
    if (isset($_POST["button"]))
    {
       
        $idObjet = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['id'])); 
        $sql = "SELECT * FROM meilleuroffre WHERE idObjet = '$idObjet'";
        $result = mysqli_query($db_handle, $sql);

        if(mysqli_num_rows($result) == 0)
        {   // si cet objet n'a pas d'enchere, on commence par la moitié du prix initial
            $sql = "SELECT * FROM objet WHERE idObjet = '$idObjet'";
            $result = mysqli_query($db_handle, $sql);
            $user = mysqli_fetch_assoc($result);
            $prixObjet = $user['prixObjet']/2;
            $dateExpEnchere = $user['finEnchere'];
        }
        else{
            //sinon on affiche le prix d'enchere actuel
            $user = mysqli_fetch_assoc($result);
            $prixObjet = $user['prix1'];
            $dateExpEnchere = $user['dateExpEnchere'];
        }

        $_SESSION['idObjet'] = $idObjet;

    }

    if (isset($_POST["button1"]))
    {
       $idObjet = $_SESSION['idObjet']; 
        
       $sql = "SELECT * FROM meilleuroffre WHERE idObjet = '$idObjet' AND idAcheteur LIKE $idAcheteur";
       $result = mysqli_query($db_handle, $sql);

       //on regarde si l'acheteur a deja encheri sur l'objet
       if(mysqli_num_rows($result) != 0)
       {   
            $informations="Vous avez actuellement l'enchère la plus élevée";  
       }
            else{  //on regarde si l'enchere existe ou pas 
                    $sql = "SELECT *FROM meilleuroffre WHERE idObjet = '$idObjet'";
                    $result = mysqli_query($db_handle, $sql);

                    //si l'enchere existe
                    if(mysqli_num_rows($result) != 0)
                    {   
                        $user = mysqli_fetch_assoc($result);
                        $prix1= $user['prix1'];
                        $prix2= $user['prix2'];
                        $idMeilleurOffre=$user['idMeilleurOffre'];
                        $dateExpEnchere = $user['dateExpEnchere'];

                        //on compare les prix
                        if($prix1 > $prixmax)
                        {
                             $informations="Votre prix n'est pas assez élevé";
                        }
                        else{
                                $informations="Votre prix d'enchère a été sauvegardée 1";
                                $sql = "UPDATE meilleuroffre SET prix2 ='$prix1', prix1 = '$prixmax', idAcheteur = '$idAcheteur' WHERE idMeilleurOffre='$idMeilleurOffre'";
                                $result = mysqli_query($db_handle, $sql);
                                //echo $sql;
                            }
                    }
                    else{   //si l'enchere n'existe pas
                            if($prixObjet > $prixmax)
                            {
                                $informations="Votre prix n'est pas assez élevé";
                            }
                            else{

                                 $informations="Votre prix d'enchère a été sauvegardée";
                                 $sql = "SELECT * FROM objet WHERE idObjet = '$idObjet'";
                                 $result = mysqli_query($db_handle, $sql);
                                 $user = mysqli_fetch_assoc($result);
                                 $dateExpEnchere=$user['finEnchere'];
                                 $prixObjet = $user['prixObjet']/2;

                                 $sql = "INSERT INTO meilleurOffre(dateExpEnchere, prix1, prix2, idObjet, idAcheteur) VALUES('$dateExpEnchere','$prixmax','$prixObjet', '$idObjet', '$idAcheteur')";
                                 $result = mysqli_query($db_handle, $sql);
                                 echo $sql;
                                 //echo $prixmax;
                                 //echo $prixObjet;
                                }
                     }

                
            }
            //on regarde si l'objet possède une enchere
        $sql = "SELECT * FROM meilleuroffre WHERE idObjet = '$idObjet'";
        $result = mysqli_query($db_handle, $sql);
        
        // si cet objet n'a pas d'enchere, on commence par la moitié du prix initial
        if(mysqli_num_rows($result) == 0)
        {      
            $sql = "SELECT * FROM objet WHERE idObjet = '$idObjet'";
            $result = mysqli_query($db_handle, $sql);
            $user = mysqli_fetch_assoc($result);
            $prixObjet = $user['prixObjet']/2;
            $dateExpEnchere=$user['finEnchere'];
        }
        else{
            //sinon on affiche le prix d'enchere actuel
            $user = mysqli_fetch_assoc($result);
            $prixObjet = $user['prix1'];
            $dateExpEnchere = $user['dateExpEnchere'];
        }

    }

}
?>

<!--
<?php

while ($product = mysqli_fetch_assoc($result)) { 
    $products[] = $product; 
} 

?> -->

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Meilleur Offre</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="style.css" />

 
</head>

<body>
  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">Alcool <span>store</span></a>
            <div class="order-lg-last btn-group">
                <a href="panier.php" class="btn-cart dropdown-toggle dropdown-toggle-split">
                    <span class="fa fa-shopping-bag"></span>
                </a>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="accueil.php" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="parcourir.php" class="nav-link">Tout parcourir</a></li>
                    <li class="nav-item "><a href="notifications.php" class="nav-link">Notifications</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Votre compte</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-wrap hero-wrap-2" style="background-image:url(images/bg_2.webp)"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    
                    <h2 class="mb-0 bread">Meilleur Offre</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="meilleurOffre.php" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Proposez votre prix maximum pour obtenir cet objet :</h3>
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Prix d'enchère minimum : <span><?=$prixObjet?> euros</span></label>                          
                                </div>
                            </div>
                         <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price"> Date d'aujourd'hui : <span><?=$today?></span></label>                          
                                </div>
                            </div>
                          <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price"> Date de fin d'enchère : <span><?=$dateExpEnchere?></span></label> </label>                          
                                </div>
                            </div>

                      <?php if(($dateExpEnchere > $today)||($dateExpEnchere == $today)):?>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Prix</label>
                                    <input type="number" name="Prix-max" class="form-control" placeholder="">
                                </div>
                            </div>
                          </div>
                        
                             <div class="col-md-12">
                                <p><button type="submit" name="button1" class="btn btn-primary py-3 px-4">Envoyez votre offre</button></p>
                                <span><?=$informations?></span>
                            </div>
                       <?php endif ?>

                       <?php if($dateExpEnchere < $today):?>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">L'enchère est terminée</label>
                                    <?php
                                         $sql = "SELECT * FROM meilleuroffre WHERE idObjet = '$idObjet' AND idAcheteur LIKE $idAcheteur";
                                         $result = mysqli_query($db_handle, $sql);

                                          //on regarde si l'acheteur a acquis l'objet
                                         if(mysqli_num_rows($result) != 0)
                                         {   
                                         ?>
                                          <label for="price">Félicitations vous avez acquis ce produit</label>
                                         
                                          <?php 
                                         }
                                         ?>
                                </div>
                            </div>
                          </div>
                           <div class="col-md-12">
                            </div>
                       <?php endif ?>

                            </div>
                        </div>
                    </form>
                    <?php if($dateExpEnchere < $today):?>
                    <form method="get" action="compte.php">
                                <p><button type="submit"class="btn btn-primary py-3 px-4">Retour à mon compte</button></p>
                    </form>
                     <?php endif ?>
                </div>
            </div>
        </div>
    </section>
    <footer class="ftco-footer">    
        <div class="container-fluid px-0 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0 text-center" style="color: rgba(255,255,255,.5);">
                            Copyright &copy;
                            <script data-cfasync="false"
                                src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | Made with <i class="fa fa-heart color-danger" aria-hidden="true"></i> by Adrien Oleksiak, David Su, Yohann Roedianto, Benjamin To</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-migrate-3.0.1.min.js+popper.min.js+bootstrap.min.js.pagespeed.jc.j8jkLwyN3s.js"></script>
    <script>eval(mod_pagespeed_EkNsNuAH7z);</script>
    <script>eval(mod_pagespeed_MUKbCx0zLD);</script>
    <script>eval(mod_pagespeed_FeCx2cZWCK);</script>
    <script
        src="js/jquery.easing.1.3.js+jquery.waypoints.min.js+jquery.stellar.min.js+owl.carousel.min.js.pagespeed.jc.qRFk3bnuu9.js"></script>
    <script>eval(mod_pagespeed_28_LPaQVu7);</script>
    <script>eval(mod_pagespeed_sKOpq3Xdu4);</script>
    <script>eval(mod_pagespeed_8wXJW4KpLl);</script>
    <script>eval(mod_pagespeed_uzXeqpYx2h);</script>
    <script
        src="js/jquery.magnific-popup.min.js+jquery.animateNumber.min.js+scrollax.min.js+google-map.js+main.js.pagespeed.jc.si7t_nTE-j.js"></script>
    <script>eval(mod_pagespeed_Ma0$sNGcVa);</script>
    <script>eval(mod_pagespeed_4xnO8OMtgk);</script>
    <script>eval(mod_pagespeed_138dmePAkq);</script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>eval(mod_pagespeed_aVJ4gRg5hC);</script>
    
</body>

</html>