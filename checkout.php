<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Paiement</title>
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

<?php

	//declaration variables
	$card = isset($_POST["creditCard"])? $_POST["creditCard"] :"";
	$numCarte = isset($_POST["numCarte"])? $_POST["numCarte"] : "";
	$nomCarte = isset($_POST["nomCarte"])? $_POST["nomCarte"] : "";
	$dateExp = isset($_POST["dateExp"])? $_POST["dateExp"] : "";
	$codeSecurite = isset($_POST["codeSecurite"])? $_POST["codeSecurite"] : "";
	$checkbox =isset($_POST["checkbox"])? $_POST["checkbox"] : "";

	$erreurNum = "";
	$erreurNom = "";
	$erreurExp = "";
	$erreurCode = "";
	$erreurCheck = "";
	$paiement = "";
	$boolpaiement = false;
	$erreur = false;

	$prenomAcheteur = "";
	$nomAcheteur = "";
	$adresse1 = "";
    $emailAcheteur = "";
	//$telephone ="";

	//identifier BDD
    $database = "paris shopping";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);


		if ($db_found) 
     		{
     			//remplir le formulaire de livraison
            $sql = "SELECT * FROM acheteur WHERE connexion like '1'";
			$result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            $prenomAcheteur = $data['prenomAcheteur'];
            $nomAcheteur = $data['nomAcheteur'];
            $adresse1 = $data['adresseAcheteur'];
            $emailAcheteur = $data['emailAcheteur'];
            $idAcheteur = $data['idAcheteur'];
            //$telephone = $data['$telephone'];
	

			if(empty($_POST["numCarte"])){
        			$erreur=true;
        			$erreurNum="Le champ Numéro de carte est vide";
				}
			if(empty($_POST["nomCarte"])){
        			$erreur=true;
        			$erreurNom="Le champ Nom est vide";
				}
			if(empty($_POST["dateExp"])){
        			$erreur=true;
        			$erreurExp="Le champ Date d'expiration est vide";
			}

			if(empty($_POST["codeSecurite"])){
        			$erreur=true;
        			$erreurCode="Le champ Code de sécurité est vide";
			}
			
			if (empty($_POST["checkbox"])) {
				$erreur=true;
				$erreurCheck="Les conditions et les termes ne sont pas validés <br>";
			}

			if($erreur == true){
				$erreur = "Erreur dans le formulaire";
			}
			else{	
                
                //echo "tout a été rempli <br>";
                //commencer le sql
                $sql = "SELECT * FROM paiement WHERE idAcheteur LIKE '$idAcheteur'";
				$result = mysqli_query($db_handle, $sql);

                
				//regarder s'il y a des resultats
            	if (mysqli_num_rows($result) == 0) 
           		{
                    $sql = "INSERT INTO paiement(typeCarte,numPaiement,nomPaiement,dateExpiration,codeSecurite,idAcheteur) VALUES('$card','$numCarte','$nomCarte','$dateExp','$codeSecurite','$idAcheteur')";
                    //echo $sql;
                    $result = mysqli_query($db_handle, $sql);
                    $paiement= "Nouveau moyen de paiement crée et paiement validé";
     			}
                else{
				
            	$sql .= " AND nomPaiement LIKE '%$nomCarte%' AND numPaiement LIKE '$numCarte'";
				$result = mysqli_query($db_handle, $sql);

				//regarder s'il y a des resultats
            	if (mysqli_num_rows($result) == 0) 
           		{
                	$paiement = " Numéro de carte ou nom invalide <br>";
                	//echo "<p> Numéro de carte ou nom invalide </p>";

            	} 
            	else {
            		//echo "<p> Numéro de carte et nom valide </p>";
            		//$paiement .=" Numéro de carte et nom valide <br>";
            		$sql .=" AND dateExpiration LIKE '$dateExp' AND codeSecurite LIKE '$codeSecurite' AND typeCarte LIKE '$card'";
					$result = mysqli_query($db_handle, $sql);

					//regarder s'il y a des resultats
            		if (mysqli_num_rows($result) == 0) 
           			{	
           				$paiement =" Informations de la carte invalides <br>";
                		//echo "<p> Informations de la carte invalides </p>";
           		 	} 
            		else {
            			$paiement =" Paiement validé ! <br>";
            			$boolpaiement = true;
            			//echo "<p> Informations de la carte valides </p>";
       	   		 		}
       	    		}
				}
			}
        }
?>


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
                                    class="fa fa-chevron-right"></i></a></span> <span>Paiement <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Paiement</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form method="post" action="checkout.php">
                         <h3 class="mb-4 billing-heading">Vos coordonnées de livraison</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Prénom : <span><?= $prenomAcheteur ?></span></label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lastname">Nom : <span><?= $nomAcheteur ?></span></label>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="adresse">Adresse : <span><?= $adresse1 ?></span></label>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="email">Email : <span><?= $emailAcheteur ?></span></label>
                                </div>
                            </div>
                           
                            <!--<div class="col-md-12">
                                <div class="form-group">
                                    <label for="phone">Téléphone : <span><?= $telephone ?></span> </label>
                                </div>
                            </div>-->
            
                        </div>

                        <h3 class="mb-4 billing-heading">Vos informations de paiement </h3>
                        <div class="row align-items-end">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Type de carte</label>
                                        <div class="form-group mt-2">
                                            <div class="radio">
                                                <label class="mr-3"><input type ="radio" name="creditCard" value="MasterCard" checked ="">MasterCard</label>
                                                <label class="mr-3"><input type ="radio" name="creditCard" value="Visa">Visa</label>
                                                <label class="mr-3"><input type ="radio" name="creditCard" value="Paypal">Paypal</label>
                                                <label class="mr-3"><input type ="radio" name="creditCard" value="AmericanExpress">American Express</label>

                                            </div>
                                        </div>
                            
                                </div>
                            </div>
                           
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lastname">Numéro de carte </label>
                                    <input type="text" class="form-control" placeholder="" name="numCarte">
                                     <span><?= $erreurNum ?></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="lastname">Nom</label>
                                    <input type="text" class="form-control" placeholder="" name="nomCarte">
                                    <span><?=$erreurNom?></span>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Date d'expiration</label>
                                    <input type="date" class="form-control" placeholder="" name="dateExp">
                                    <span><?=$erreurExp?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="streetaddress">Code de sécurité</label>
                                    <input type="password" class="form-control" placeholder="" name="codeSecurite">
                                    <span><?=$erreurCode?></span>
                                </div>
                            </div>
                           
                    <!--</form>-->
                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Total du panier</h3>
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
                                    <span>3.00€</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>17.60€</span>
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Confirmation de paiement</h3>
                                
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=1 class="mr-2" name="checkbox">J'ai lu et accepté les termes et les conditions</label>
                                        </div>
                                    </div>
                                </div>
                                <!--<p><a href="#" class="btn btn-primary py-3 px-4">Payer</a></p>-->
                                <p><input type="submit" name="button" value="Payer" class="btn btn-primary py-3 px-4" /></p>
                                <span><?=$erreurCheck?></span>
                                <span><?=$erreur?></span>
                                <span><?=$paiement?></span>
                            </div>
                        </div>

                        <!--
                         <div class="col-md-6 d-flex">
                            <div class="cart-detail p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Etat du paiement</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <span><!<?=$paiement?></span>
                                    </div>
                                 </div>
                            </div>
                        </div>
                    -->

                    </div>

                  </form>
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