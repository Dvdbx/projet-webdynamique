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

while ($product = mysqli_fetch_assoc($result)) { 
    $products[] = $product; 
} 

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Parcourir les produits</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link
        href="https://fonts.googleapis.com/css2?family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,700;0,800;1,200;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet"
        href="style.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
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

    <section class="hero-wrap hero-wrap-2" style="background-image:url(images/bg_2.webp)"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-end justify-content-center">
                <div class="col-md-9 ftco-animate mb-5 text-center">
                    <p class="breadcrumbs mb-0"><span class="mr-2"><a href="accueil.php">Accueil <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Parcourir <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Produits</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
               
                    <div class="row">

                    <?php foreach($products as $product) : ?>

                        <div class="col-md-4 d-flex">
                            <div class="product ftco-animate">
                                <div class="img d-flex align-items-center justify-content-center"
                                    style="background-image:url(images/<?php echo $product['photo1']; ?>)">

                                    <div class="desc">
                                        <p class="meta-prod d-flex align-items-center justify-content-center">

                                        <form action="product.php" method="post" class="text-align-center">

                                            
                                            <input class="hidden" type="text" value="<?php echo $product['idObjet']; ?>" name="id">
                                            <button type="submit" name="button1" class="btn btn-primary py-3 px-3" style="margin-left:40%;"><a class="d-flex align-items-center justify-content-center"><span
                                                    class="fa fa-eye"></span></a></button>

                                        </form>

                                        <form action="panier.php" method="post" class="text-align-center">

                                        <input class="hidden" type="text" value="<?php echo $product['idObjet']; ?>" name="id">

                                            <button type="submit" name="button2" class="btn btn-primary py-3 px-3" style="margin-left:40%;"><a class="d-flex align-items-center justify-content-center"><span
                                                    class="fa fa-shopping-bag"></span></a></button>
                    
                                        </form>

                                           
                                        </p>

                                    </div>

                                </div>
                                <div class="text text-center" >
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
                   
                </div>
               <div class="col-md-3">
                    <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Types de produits</h3>
                            <ul class="p-0">
                                <li><a href="parcourir-filtre.php?filtre=6">Brandy <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=7">Gin <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=8">Rhum <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=9">Tequila <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=10">Vodka <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=11">Whiskey <span class="fa fa-chevron-right"></span></a></li>
        
        
                            </ul>
                        </div>
                    </div>
 <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Type d'achat</h3>
                            <ul class="p-0">
                                <li><a href="parcourir-filtre.php?filtre=0">Achat immédiat <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=1">Transaction vendeur-client <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=2">Meilleur offre <span class="fa fa-chevron-right"></span></a></li>
        
                            </ul>
                        </div>
                    </div>
                     <div class="sidebar-box ftco-animate">
                        <div class="categories">
                            <h3>Rareté</h3>
                            <ul class="p-0">
                                <li><a href="parcourir-filtre.php?filtre=3">Articles réguliers <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=4">Articles hauts de gamme <span class="fa fa-chevron-right"></span></a></li>
                                <li><a href="parcourir-filtre.php?filtre=5">Articles rares <span class="fa fa-chevron-right"></span></a></li>
        
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
                   

                </div>
            </div>
        </div>
        <div class="col-md-3">
                   

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