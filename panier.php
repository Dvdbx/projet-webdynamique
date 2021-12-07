
<?php
//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$connecte=0;
$user="";

$sql = "SELECT * FROM acheteur WHERE connexion = '1'";
$result = mysqli_query($db_handle, $sql);

if(mysqli_num_rows($result) != 0)
{
 $user = mysqli_fetch_assoc($result);
}

$idPanier = $user['idPanier'];

if($db_found)
{
    if (isset($_POST["button1"])) {

        $id = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['id'])); 
        $quantity = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['quantity'])); 

        $sql2 = "INSERT INTO ajoutpanier(idObjet, idPanier, quantite, nombreEnchere, prixEnchere) VALUES('$id', '$idPanier', '$quantity', '0', '0')";
        $result2 = mysqli_query($db_handle, $sql2);

        $sql3 = "SELECT DISTINCT O.idObjet, O.nomObjet, O.prixObjet, O.photo1, O.typeAchat, O.rarete FROM objet O, ajoutpanier A WHERE A.idPanier = $idPanier AND O.idObjet = A.idObjet";
        $result3 = mysqli_query($db_handle, $sql3);

       

/*
        foreach ($temp as $key => $value) {
            $temp[$key] = $value;
         
        }

/*
        $sql4 = "SELECT * FROM objet O, ajoutpanier A, panier P WHERE 'P.idAcheteur' = $user['idAcheteur'] AND 'P.idPanier' = 'A.idPanier' AND 'A.idObjet' = 'O.idObjet'";

        $result4 = mysqli_query($db_handle, $sql4);
    
while ($product = mysqli_fetch_assoc($result4)) { 
    $products[] = $product; 
}         
*/

    }    

}

while ($product = mysqli_fetch_assoc($result3)) { 
    $products[] = $product; 
} 


   
//on detecte quel utilisateur est connecte automatiquement


/*

$sql4 = "SELECT * FROM objet";
$result4 = mysqli_query($db_handle, $sql4);

while ($product = mysqli_fetch_assoc($result4)) { 
$products[] = $product; 
} 

$sql5 = "SELECT * FROM vendeur";
$result5 = mysqli_query($db_handle, $sql5);

while ($vendeur = mysqli_fetch_assoc($result5)) { 
$vendeurs[] = $vendeur; 
} 

}*/

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Panier</title>
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
                    <li class="nav-item"><a href="parcourir.html" class="nav-link">Tout parcourir</a></li>
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
                                    class="fa fa-chevron-right"></i></a></span> <span>Panier <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Mon panier</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="table-wrap">
                    <table class="table">
                        <thead class="thead-primary">
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>Produit</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php foreach($products as $product) : ?>

                            <tr class="alert" role="alert">
                                <td>
                                    <label class="checkbox-wrap checkbox-primary">
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td>
                                    <div class="img"
                                        style="background-image:url(images/<?php echo $product['photo1']?>)">
                                    </div>
                                </td>
                                <td>
                                    <div class="email">
                                        <span><?php echo $product['nomObjet'] ?></span>
                                        <span><?php echo $product['rarete'] ?></span>
                                    </div>
                                </td>
                                <td><?php echo $product['prixObjet'] ?>€</td>
                                <td>
                                    <div class="quantity">
                                        <span><?php echo $quantity ?></span>

                                    </div>
                                </td>

                                     <td><?php echo $product['prixObjet']*$quantity . "€" ?></td>  <!-- calcul -->


                                <td>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                                    </button>
                                </td>
                            </tr>

                            <?php endforeach ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row justify-content-end">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Total du panier</h3>
                        <p class="d-flex">
                            <span>Sous-total</span>
                            <span>20.60€</span>
                        </p>
                        <p class="d-flex">
                            <span>Livraison</span>
                            <span>0.00€</span>
                        </p>
                        <p class="d-flex">
                            <span>Remise</span>
                            <span>0.00€</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span>17.60€</span>
                        </p>
                    </div>
                    <p class="text-center"><a href="checkout.html" class="btn btn-primary py-3 px-4">Procéder au paiement</a></p>
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
        data-cf-beacon='{"rayId":"6b889a67d957082c","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.11.0","si":100}'
        crossorigin="anonymous"></script>
</body>

</html>