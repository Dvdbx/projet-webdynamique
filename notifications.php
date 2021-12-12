<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Notifications</title>
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
                    <li class="nav-item	"><a href="notifications.php" class="nav-link">Notifications</a></li>
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
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="accueil.php">Accueil <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Notifications <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Notifications</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">

                <form action="" class="billing-form" method="POST">
                        <h3 class="mb-4 billing-heading">Votre alerte</h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Etat</label>
                                    <div class="form-group mt-2">
                                        <div class="etat">
                                            <label class="mr-3"><input type="radio" name="state" value="1">Active
                                            </label>
                                            <label class="mr-3"><input type="radio" name="state" value="0">Inactive</label>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p><button type="submit" class="btn btn-primary py-3 px-4 mt-3 mb-4" name ="soumissionner1" value="soumissionner1">Enregistrer</button></p>

                                  <?php 

                                

                                $database = "paris shopping";
                                //identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
                                $db_handle = mysqli_connect('localhost', 'root', '');
                                $db_found = mysqli_select_db($db_handle, $database);

                                $etat=isset($_POST["state"])? $_POST["state"] : "0";

                                if(isset($_POST['soumissionner1']))
                                {
                                    if($etat == "1")
                                        {
                                            $sql="UPDATE acheteur SET etat ='1' WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                        }
                                    if($etat == "0")
                                    {
                                            $sql="UPDATE acheteur SET etat ='0' WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                    }                                  
                                }


                            ?>

                            </div>
                          
                        </div>

                        </form>
                    
                    <form action="" class="billing-form" method="POST">
                        <h3 class="mt-4 mb-4 billing-heading">Vos critères</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Prix minimum (en €)</label>
                                    <input type="number" class="form-control" placeholder="" name="pmin" value="pmin">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix">Prix maximum (en €)</label>
                                    <input type="number" class="form-control" placeholder="" name="pmax" value="pmax">
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Rareté : </label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="optradio" value="hautDeGamme">Haut de gamme
                                            </label>
                                            <label class="mr-3"><input type="radio" name="optradio" value="rare">Rare</label>
                                            <label class="mr-3"><input type="radio" name="optradio" value="regulier">Régulier</label>


                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                              <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Type d'achat : </label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="optradio2" value="immediat">Immédiat
                                            </label>
                                            <label class="mr-3"><input type="radio" name="optradio2" value="transaction">Transaction</label>
                                            <label class="mr-3"><input type="radio" name="optradio2" value="meilleurOffre">Meilleur Offre</label>


                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="prix">Type d'alcool : </label>
                                    <select name="categorie">
                                        <option  value="tout"  >Tout les types</option>
                                        <option  value="brandy"  >Brandy</option>
                                        <option  value="gin"  >Gin</option>
                                        <option  value="rhum"  >Rhum</option>
                                        <option  value="tequila"  >Tequila</option>
                                        <option  value="vodka"  >Vodka</option>
                                        <option  value="whiskey"  >Whiskey</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p><button type="submit" class="btn btn-primary py-3 px-4 mt-3 mb-4" name="soumissionner" value="soumissionner">Enregistrer</button></p>
                                    <?php
                                $database = "paris shopping";
                                //identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
                                $db_handle = mysqli_connect('localhost', 'root', '');
                                $db_found = mysqli_select_db($db_handle, $database);

                                if(isset($_POST['soumissionner']))
                                {
                                    $var=$_POST["optradio"];
                                    $tach=$_POST["optradio2"];
                                    $critPrixMin=$_POST["pmin"];
                                    $critPrixMax=$_POST["pmax"];
                                    $type=$_POST["categorie"];
                                   
                                   if($critPrixMin!="" && $critPrixMax!="")
                                       {
                                        if($critPrixMin < $critPrixMax)
                                            {
                                                $sql="UPDATE acheteur SET CritPrixInferieur ='$critPrixMin' WHERE connexion ='1'";
                                                $result = mysqli_query($db_handle, $sql);
                                                $sql="UPDATE acheteur SET CritPrixSuperieur ='$critPrixMax' WHERE connexion ='1'";
                                                $result = mysqli_query($db_handle, $sql);
                                            }

                                       }
                                    else if($critPrixMin != "" && $critPrixMax == "")
                                       {
                                            $sql="UPDATE acheteur SET CritPrixInferieur ='$critPrixMin' WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                            $sql="UPDATE acheteur SET CritPrixSuperieur = NULL WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                       }
                                    else if($critPrixMin == "" && $critPrixMax != "")
                                       {
                                            $sql="UPDATE acheteur SET CritPrixInferieur = NULL WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                            $sql="UPDATE acheteur SET CritPrixSuperieur ='$critPrixMax' WHERE connexion ='1'";
                                            $result = mysqli_query($db_handle, $sql);
                                       }


                                    if ($type!='tout')
                                    {
                                        $sql="UPDATE acheteur SET categorie ='$type' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }

                                    if($var == 'hautDeGamme')
                                    {
                                        
                                        echo "0";
                                        $sql="UPDATE acheteur SET rarete ='hautDeGamme' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }
                                    
                                    if($var == 'rare')
                                    {
                                        echo "1";
                                        $sql="UPDATE acheteur SET rarete ='rare' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }
                                    
                                    if($var == 'regulier')
                                    {
                                        echo "2";
                                        $sql="UPDATE acheteur SET rarete ='regulier' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }

                                     if($tach == 'immediat')
                                    {
                                        echo "2";
                                        $sql="UPDATE acheteur SET typeAchat ='immediat' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }
                                    
                                    if($tach == 'transaction')
                                    {
                                        echo "2";
                                        $sql="UPDATE acheteur SET typeAchat ='transaction' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }
                                    
                                    if($tach == 'meilleurOffre')
                                    {
                                        echo "2";
                                        $sql="UPDATE acheteur SET typeAchat ='meilleurOffre' WHERE connexion ='1'";
                                        $result = mysqli_query($db_handle, $sql);
                                    }


                                }

                            ?>
                            </div>
                            
                            
                            
                        </div>

                        </form>
                        
                        <h3 class="mb-4 mt-4 billing-heading">Recherche spontanée</h3>

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