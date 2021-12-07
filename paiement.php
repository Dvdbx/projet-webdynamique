<?php

	//declaration variables
	$card = isset($_POST["creditCard"])? $_POST["creditCard"] :"";
	$numCarte = isset($_POST["numCarte"])? $_POST["numCarte"] : "";
	$nomCarte = isset($_POST["nomCarte"])? $_POST["nomCarte"] : "";
	$dateExp = isset($_POST["dateExp"])? $_POST["dateExp"] : "";
	$codeSecurite = isset($_POST["codeSecurite"])? $_POST["codeSecurite"] : "";
	$checkbox = isset($_POST["checkbox"])? $_POST["checkbox"] : "";

	/*$prenomAcheteur = isset($_POST["prenomAcheteur"])? $_POST["prenomAcheteur"] :"";
	$nomAcheteur = isset($_POST["nomAcheteur"])? $_POST["nomAcheteur"] : "";
	$adresse1 = isset($_POST["adresse1"])? $_POST["adresse1"] : "";
	$adresse2 = isset($_POST["adresse2"])? $_POST["adresse2"] : "";
	$ville = isset($_POST["ville"])? $_POST["ville"] : "";
	$codePostal = isset($_POST["codePostal"])? $_POST["codePostal"] :"";
	$pays = isset($_POST["pays"])? $_POST["pays"] : "";
	$telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";*/

	//identifier BDD
    $database = "paris shopping";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

	//si le bouton est cliqué
if (isset($_POST["button"])) {

	//if (isset($_POST["checkbox"])) {

	 	if ($db_found) 
     	{	
     		//$recapitulatif = "";
			$erreur = "";
			$paiement = "";

			/*if($prenomAcheteur == ""){
				$erreur .= "Le champ prenom est vide <br>"; 
			}
			if($nomAcheteur == ""){
				$erreur .= "Le champ nom est vide <br>"; 
			}
			if($adresse1 == ""){
				$erreur .= "Le champ adresse 1 est vide <br>"; 
			}
			if($adresse2 == ""){
				$erreur .= "Le champ adresse 2 est vide <br>"; 
			}	
			if($ville == ""){
				$erreur .= "Le champ ville est vide <br>"; 
			}
			if($codePostal == ""){
				$erreur .= "Le champ code postal est vide <br>"; 
			}
			if($pays == ""){
				$erreur .= "Le champ pays est vide <br>"; 
			}
			if($telephone == ""){
				$erreur .= "Le champ Numéro de téléphone est vide <br>"; 
			}*/

			if($numCarte == ""){
				$erreur .= "Le champ Numéro de carte est vide <br>"; 
			}
			if($nomCarte == ""){
				$erreur .= "Le champ Nom est vide <br>"; 
			}
			if($dateExp == ""){
				$erreur .= "Le champ Date d'expiration est vide <br>"; 
			}
			if($codeSecurite == ""){
				$erreur .= "Le champ Code de sécurité est vide <br>"; 
			}
			if(empty($checkbox)){
				$erreur .= " Les conditions et les termes ne sont pas validés <br>"; 
			}

			if($erreur == ""){

				//echo "tout a été rempli <br>";
				//commencer le sql
            	$sql = "SELECT * FROM paiement";

           		$sql .= " WHERE nomPaiement LIKE '%$nomCarte%' AND numPaiement LIKE '$numCarte'";
				$result = mysqli_query($db_handle, $sql);

				//regarder s'il y a des resultats
            	if (mysqli_num_rows($result) == 0) 
           		{
                	//$paiement = " Numéro de carte ou nom invalide <br>";
                	echo "<p> Numéro de carte ou nom invalide </p>";

            	} 
            	else {
            		//echo "<p> Numéro de carte et nom valide </p>";
            		$paiement .=" Numéro de carte et nom valide <br>";

            		$sql .= " AND dateExpiration LIKE '$dateExp' AND codeSecurite LIKE '$codeSecurite' AND typeCarte LIKE '$card'";
					$result = mysqli_query($db_handle, $sql);

					//regarder s'il y a des resultats
            		if (mysqli_num_rows($result) == 0) 
           			{	
           				//$paiement .=" Informations de la carte invalides <br>";
                		echo "<p> Informations de la carte invalides </p>";
           		 	} 
            		else {
            			//$paiement .=" Informations de la carte valides <br>";
            			echo "<p> Paiement validé </p>";
       	   		 	}
       	    	}
			}
			else {
				echo "Erreur : <br>" . $erreur;
			}
		}

	/*}
	else{
		//$paiement .=" Les conditions ne sont pas validés <br>";
		echo "Les conditions ne sont pas validés";
	}*/
	//echo $paiement;
}

?>
