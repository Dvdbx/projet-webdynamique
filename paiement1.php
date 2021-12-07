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

	$prenomAcheteur = "moi";
	$nomAcheteur = "azer";
	$adresse1 = "36 quai de grenelle ";
	$adresse2 = "";
	$ville = "paris";
	$codePostal ="78015";
	$pays = "France";
	$telephone ="010203040506";

	//identifier BDD
    $database = "paris shopping";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);


		if ($db_found) 
     		{
     			//remplir le formulaire de livraison
            	//$sql = "SELECT * FROM acheteur WHERE nomPaiement LIKE '%$nomCarte%' AND numPaiement LIKE '$numCarte'";
				//$result = mysqli_query($db_handle, $sql);


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
            	$sql = "SELECT * FROM paiement WHERE nomPaiement LIKE '%$nomCarte%' AND numPaiement LIKE '$numCarte'";
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

?>
