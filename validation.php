<?php
	//declaration variables
	$card = isset($_POST["creditCard"])? $_POST["creditCard"] :"";
	$numCarte = isset($_POST["numCarte"])? $_POST["numCarte"] : "";
	$nomCarte = isset($_POST["nomCarte"])? $_POST["nomCarte"] : "";
	$dateExp = isset($_POST["dateExp"])? $_POST["dateExp"] : "";
	$codeSecurite = isset($_POST["codeSecurite"])? $_POST["codeSecurite"] : "";

	//identifier BDD
    $database = "paris shopping";

    //connectez-vous dans BDD
    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

	//si le bouton est cliqué
if (isset($_POST["button"])) {

	 if ($db_found) 
     {
		$erreur = "";

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

		if($erreur == ""){

			//echo "tout a été rempli <br>";
			 //commencer le sql
            $sql = "SELECT * FROM paiement";

            $sql .= " WHERE nomPaiement LIKE '%$nomCarte%' AND numPaiement LIKE '$numCarte'";
			$result = mysqli_query($db_handle, $sql);

			//regarder s'il y a des resultats
            if (mysqli_num_rows($result) == 0) 
            {
                echo "<p> Numéro de carte ou nom invalide </p>";

            } 
            else {
            	echo "<p> Numéro de carte et nom valide </p>";

            	$sql .= " AND dateExpiration LIKE '$dateExp' AND codeSecurite LIKE '$codeSecurite' AND typeCarte LIKE '$card'";
				$result = mysqli_query($db_handle, $sql);

				//regarder s'il y a des resultats
            	if (mysqli_num_rows($result) == 0) 
           		 {
                	echo "<p> Informations de la carte invalides </p>";

           		 } 
            	else {
            			echo "<p> Paiement validé </p>";
       	   		 	 }
       	    	}

			}
		else {
			echo "Erreur : <br>" . $erreur;
		}
	}

}

?>
