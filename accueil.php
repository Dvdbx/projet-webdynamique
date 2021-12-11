<?php
//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if($db_found)
{
    $sql = "SELECT * FROM objet";
    $result = mysqli_query($db_handle, $sql);
}
?>
          
                   
<?php

while ($temp = mysqli_fetch_assoc($result)) { 
    $temps[] = $temp; 
} 
$nombre=count($temps);

$products = [];
for ($i=0; $i<4; $i++) {
    $r=rand(0, $nombre-1);
    if(!in_array($temps[$r], $products))
    {
     $products[$i]=$temps[$r];
     
    }
    else
    {
        $i--;
    }
    
}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Accueil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="accueil.php">Alcool <span>store</span></a>
            <div class="order-lg-last btn-group">
                <a href="panier.php" class="btn-cart dropdown-toggle dropdown-toggle-split">
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
                    <li class="nav-item"><a href="accueil.php" class="nav-link">Accueil</a></li>
                    <li class="nav-item"><a href="parcourir.php" class="nav-link">Tout parcourir</a></li>
                    <li class="nav-item	"><a href="notifications.php" class="nav-link">Notifications</a></li>
                    <li class="nav-item"><a href="login.php" class="nav-link">Votre compte</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="hero-wrap" style="background-image:url(images/bg_2.webp)" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-8 d-flex align-items-end">
                    <div class="text w-100 text-center">
                        <h1 class="mb-4">La <span>Taverne</span> française en <span>ligne</span>.</h1>
                        <p><a href="parcourir.php" class="btn btn-primary py-2 px-4">Voir les produits</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-intro">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-4 d-flex">
                    <div class="intro d-lg-flex w-100">
                        <div class="icon">
                            <span class="fa fa-phone"></span>
                        </div>
                        <div class="text">
                            <h2>Support en ligne 24/7</h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-1 d-lg-flex w-100">
                        <div class="icon">
                            <span class="fa fa-credit-card"></span>
                        </div>
                        <div class="text">
                            <h2>Paiement sécurisé</h2>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex">
                    <div class="intro color-2 d-lg-flex w-100">
                        <div class="icon">
                            <span class="fa fa-truck"></span>
                        </div>
                        <div class="text">
                            <h2>Livraison gratuite</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-md-6 img img-3 d-flex justify-content-center align-items-center"
                    style="background-image:url(images/about.webp)">
                </div>
                <div class="col-md-6 wrap-about pl-md-5 py-5">
                    <div class="heading-section">
                        <span class="subheading">Since 1995</span>
                        <h2 class="mb-4">Qui sommes-nous ?</h2>
                        <p>Amateurs d'alcool depuis des générations, nous adorons nous retrouver autour d'un bon verre le dimanche après-midi, car qui y a-t-il de mieux que de partager les moments heureux de la vie ? C'est dans cet esprit que nous avons fondé ce site de vente d'alcool, et ainsi propagé cette joie de vivre qui nous anime.   
                            </p>
                        <p>Qui ne sait pas partager est infirme de ses émotions, nos vendeurs ingambes, choisis avec la plus grande attention, seront donc ravis de vous présenter leurs meilleurs crus.</p>
                        <p>On ne jouit que des biens partagés. ~ Félicité Robert de Lamennais</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section ftco-no-pb">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-1.webp)">
                        </div>
                        <h3>Brandy</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-2.webp)">
                        </div>
                        <h3>Gin</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-3.webp)">
                        </div>
                        <h3>Rum</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-4.webp)">
                        </div>
                        <h3>Tequila</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-5.webp)">
                        </div>
                        <h3>Vodka</h3>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 ">
                    <div class="sort w-100 text-center">
                        <div class="img" style="background-image:url(images/kind-6.webp)">
                        </div>
                        <h3>Whiskey</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5">
                <div class="col-md-7 heading-section text-center">
                    <span class="subheading">Offres du moment</span>
                    <h2>Notre sélection</h2>
                </div>
            </div>
            <div class="row">

            <?php foreach($products as $product) : ?>

                <div class="col-md-3 d-flex">
                    <div class="product">
                        <div class="img d-flex align-items-center justify-content-center"
                            style="background-image:url(images/<?php echo $product['photo1']; ?>)">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    <a href="panier.php" class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-shopping-bag"></span></a>

                                    <a href="product.php"
                                        class="d-flex align-items-center justify-content-center"><span
                                            class="fa fa-eye"></span></a>
                                </p>
                            </div>
                        </div>
                        <div class="text text-center">
                            <span class="sale" style="background-color:<?php if($product['rarete']=="hautDeGamme"){echo "#b7472a";}if($product['rarete']=="rare"){echo "#fe9801";}if($product['rarete']=="regulier"){echo "#01d28e";} ?>"><?php if($product['rarete']=="hautDeGamme"){echo "Haut de gamme";}if($product['rarete']=="rare"){echo "Rare";}if($product['rarete']=="regulier"){echo "Régulier";}; ?></span>
                                    <span class="category"><?php echo $product['categorie']; ?></span>
                                    <h2><?php echo $product['nomObjet']; ?></h2>
                                    <p class="mb-0"> <span
                                            class="price"><?php echo $product['prixObjet']; ?>€</span></p>
                        </div>
                    </div>
                </div>

                <?php endforeach ?>
               
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <a href="product.php" class="btn btn-primary d-block">Voir tous les produits<span
                            class="fa fa-long-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </section>

    <footer class="ftco-footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2 logo"><a href="accueil.php">Alcool <span>Store</span></a></h2>
                        <p>La philosophie d'Alcool Store est de promouvoir nos clients, pas nous-mêmes. Nous saurons
                            vous aider à trouver la bouteille qui répond à vos désirs.</p>

                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe width="450" height="260" id="gmap_canvas"
                                src="https://maps.google.com/maps?q=67%20avenue%20Marceau,%2075016%20Paris&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                href="https://2piratebay.org">pirate bay</a><br>
                            <style>
                                .mapouter {
                                    position: relative;
                                    text-align: right;
                                    height: 260px;
                                    width: 450px;
                                }
                            </style><a href="https://www.embedgooglemap.net">how to embed google map in html</a>
                            <style>
                                .gmap_canvas {
                                    overflow: hidden;
                                    background: none !important;
                                    height: 260px;
                                    width: 450px;
                                }
                            </style>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Nous contacter ?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li><span class="icon fa fa-map marker pr-4"></span><span class="text">Alcool Store, 67
                                        avenue Marceau, 75016 Paris</span></li>
                                <li><a href="tel:+33102030405"><span class="icon fa fa-phone pr-4"></span><span
                                            class="text">(+33) 01 02 03 04 05</span></a></li>
                                <li><a href="mailto:alcool.store@gmail.com"><span
                                            class="icon fa fa-paper-plane pr-4"></span>alcool.store@gmail.com</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid px-0 py-5 bg-black">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-0 text-center" style="color: rgba(255,255,255,.5);">
                            Copyright &copy;
                            <script data-cfasync="false"
                                src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
                            <script>document.write(new Date().getFullYear());</script> All rights reserved | Made with
                            <i class="fa fa-heart color-danger" aria-hidden="true"></i> by Adrien Oleksiak, David Su,
                            Yohann Roedianto, Benjamin To</a>
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

    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer
        src="https://static.cloudflareinsights.com/beacon.min.js/v64f9daad31f64f81be21cbef6184a5e31634941392597"
        integrity="sha512-gV/bogrUTVP2N3IzTDKzgP0Js1gg4fbwtYB6ftgLbKQu/V8yH2+lrKCfKHelh4SO3DPzKj4/glTO+tNJGDnb0A=="
        data-cf-beacon='{"rayId":"6b9001c46a653ae3","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>