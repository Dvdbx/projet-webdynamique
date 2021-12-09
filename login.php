<?php
//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if($db_found)
{
    
    if (isset($_POST["button8"])){   

        $sql = "UPDATE acheteur SET connexion = '0'";
        $sql1 = "UPDATE vendeur SET connexion = '0'";
        $sql2 = "UPDATE admin SET connexion = '0'";

        $result = mysqli_query($db_handle, $sql);
        $result1 = mysqli_query($db_handle, $sql1);
        $result2 = mysqli_query($db_handle, $sql2);
    
    } 

}
?>
        

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="style.css" />

    <script>

        function affiche_bloc_acheteur(radio,id) {
        if (radio.checked)
        {
            document.getElementById(id).style.visibility="visible";
        }
        else
        {
            document.getElementById(id).style.visibility="hidden";
        }
}

function affiche_bloc_vendeur(radio,id) {
        if (radio.checked)
        {
            document.getElementById(id).style.display="block";
        }
        else
        {
            document.getElementById(id).style.display="none";
        }
}

    </script>
</head>

<body>
  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="accueil.html">Alcool <span>store</span></a>
            <div class="order-lg-last btn-group">
                <a href="panier.html" class="btn-cart dropdown-toggle dropdown-toggle-split">
                    <span class="fa fa-shopping-bag"></span>
                    <div class="d-flex justify-content-center align-items-center"><small>3</small></div>
                </a>

            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="accueil.html" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="parcourir.php" class="nav-link">Tout parcourir</a></li>
                    <li class="nav-item	"><a href="notifications.html" class="nav-link">Notifications</a></li>
                    <li class="nav-item"><a href="login.html" class="nav-link">Votre compte</a></li>
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
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="accueil.html">Accueil <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Votre compte <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Connexion</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="compte.php" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Connectez-vous :</h3>
                        <div class="row align-items-end">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="type">Qui êtes-vous ?</label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="optradio" onchange="affiche_bloc_acheteur(this, 'form_acheteur')">Acheteur
                                            </label>
                                            <label class="mr-3"><input type="radio" name="optradio" onchange="affiche_bloc_vendeur(this, 'form_vendeur')">Vendeur</label>
                                            <label class="mr-3"><input type="radio" name="optradio" onchange="affiche_bloc_acheteur(this, 'form_admin')">Admin</label>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div id="form_acheteur">

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Login (email)</label>
                                    <input type="text" name="login" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="password">Mot de passe (nom)</label>
                                    <input type="text" name="password"class="form-control" placeholder="">
                                </div>
                            </div>

                            </div>

                            <div id="form_vendeur">

<div class="col-md-12">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" class="form-control" placeholder="">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control" placeholder="">
    </div>
</div>

</div>

<div id="form_admin" class="hidden">

<div class="col-md-12">
    <div class="form-group">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudoAdmin" class="form-control" placeholder="">
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <label for="mdp">Mdp</label>
        <input type="text" name="mdpAdmin" class="form-control" placeholder="">
    </div>
</div>

</div>
                        
                            <div class="col-md-12">
                                <p><button type="submit" name="button3" class="btn btn-primary py-3 px-4">Se connecter</button></p>

                            </div>
                        </div>
                    </form>

                    <div class="mt-4">
                    <p>Pas de compte ? <a href="signin.html">Inscrivez-vous</a></p>

                            </div>

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

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597"
        integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A=="
        data-cf-beacon='{"rayId":"6b88a3864c2e3b91","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>