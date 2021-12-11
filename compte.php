

<?php
//identifier votre BDD
$database = "paris shopping";
//identifier votre serveur (localhost), utlisateur (root), mot de passe ("")
$db_handle = mysqli_connect('localhost', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$prenomac = isset($_POST["prenomac"])? $_POST["prenomac"] : "";
$nomac = isset($_POST["nomac"])? $_POST["nomac"] : "";
$adresseac = isset($_POST["adresseac"])? $_POST["adresseac"] : "";
$emailac = isset($_POST["emailac"])? $_POST["emailac"] : "";
$pseudove = isset($_POST["pseudove"])? $_POST["pseudove"] : "";
$nomve = isset($_POST["nomve"])? $_POST["nomve"] : "";
$emailve = isset($_POST["emailve"])? $_POST["emailve"] : "";
$photove = isset($_POST["photove"])? $_POST["photove"] : "";
$fondve = isset($_POST["fondve"])? $_POST["fondve"] : "";

//variables pour objet
//vendeur
$nomObjet = isset($_POST["nomObjet"])? $_POST["nomObjet"] : "";
$prixObjet = isset($_POST["prixObjet"])? $_POST["prixObjet"] : "";
$volume = isset($_POST["volume"])? $_POST["volume"] : "";
$photo1 = isset($_POST["photo1"])? $_POST["photo1"] : "";
$photo2 = isset($_POST["photo2"])? $_POST["photo2"] : "";
$photo3 = isset($_POST["photo3"])? $_POST["photo3"] : "";
$video = isset($_POST["video"])? $_POST["video"] : "";
$typeAchat = isset($_POST["typeAchat"])? $_POST["typeAchat"] : "";
$rarete = isset($_POST["rarete"])? $_POST["rarete"] : "";
$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
$erreur = "";
//admin
$nomVendeur=isset($_POST["nomVendeur"])? $_POST["nomVendeur"] : "";

//variable réduction
$reduc = isset($_POST["reduc"])? $_POST["reduc"] : "";
$infoReduc="";

//données bancaires de l'acheteur
$card ="";
$numCarte ="";
$nomCarte ="";
$dateExp ="";
$codeSecurite ="";
$infoBancaires ="";


//données acheteur inscription
$idAcheteur="";
$idPanier="";

//on detecte quel utilisateur est connecte automatiquement
$connecte=0;
$visiteur="";
$user="";

if($db_found)
{
    //si passe par formulaire d'inscription
 
if (isset($_POST["button1"])){

        $sql = "INSERT INTO acheteur(nomAcheteur, prenomAcheteur, adresseAcheteur, emailAcheteur, connexion) VALUES('$nomac', '$prenomac', '$adresseac', '$emailac','1')";
        $result = mysqli_query($db_handle, $sql);

        $sql ="SELECT*FROM acheteur WHERE connexion LIKE '1'";
        $result = mysqli_query($db_handle, $sql);
        $user = mysqli_fetch_assoc($result);
        $idAcheteur= $user['idAcheteur'];
        
        $sql = "INSERT INTO panier(idAcheteur, prixPanier) VALUES('$idAcheteur', '0')";
        $result = mysqli_query($db_handle, $sql);

        $sql ="SELECT*FROM panier where idAcheteur = '$idAcheteur'";
        $result = mysqli_query($db_handle, $sql);
        $user = mysqli_fetch_assoc($result);
        $idPanier= $user['idPanier'];

        $sql = "UPDATE acheteur SET idPanier = $idPanier WHERE idAcheteur = $idAcheteur";
        $result = mysqli_query($db_handle, $sql);


} 

if (isset($_POST["button2"])) {
	
      
        $sql = "INSERT INTO vendeur(pseudoVendeur, emailVendeur, nomVendeur, photoVendeur, fondVendeur, idAdmin, connexion) VALUES('$pseudove', '$emailve', '$nomve', '$photove', '$fondve', '1', '1')";
 $result = mysqli_query($db_handle, $sql);

}

//si passe par formulaire de connexion

if (isset($_POST["button3"])){echo"oui";

    //acheteur

if(isset($_POST['login']) && isset($_POST['password']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['login'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM acheteur where 
              emailAcheteur = '".$username."' and nomAcheteur = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['login'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE acheteur SET connexion = '1' WHERE emailAcheteur = '".$username."' and nomAcheteur = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}
   //vendeur

    
if(isset($_POST['pseudo']) && isset($_POST['email']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['pseudo'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['email']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM vendeur where 
              pseudoVendeur = '".$username."' and emailVendeur = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudo'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE vendeur SET connexion = '1' WHERE pseudoVendeur = '".$username."' and emailVendeur = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}

// admin

if(isset($_POST['pseudoAdmin']) && isset($_POST['mdpAdmin']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['pseudoAdmin'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['mdpAdmin']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM admin where 
              pseudoAdmin = '".$username."' and mdpAdmin = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudoAdmin'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE admin SET connexion = '1' WHERE pseudoAdmin = '".$username."' and mdpAdmin = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}

}

$sql1 = "SELECT * FROM admin WHERE connexion = '1'";
$sql2 = "SELECT * FROM acheteur WHERE connexion = '1'";
$sql3 = "SELECT * FROM vendeur WHERE connexion = '1'";
$result1 = mysqli_query($db_handle, $sql1);
$result2 = mysqli_query($db_handle, $sql2);
$result3 = mysqli_query($db_handle, $sql3);

if(mysqli_num_rows($result1) != 0)
{
 $visiteur="admin";
 $user = mysqli_fetch_assoc($result1);
}
if(mysqli_num_rows($result2) != 0)
{
 $visiteur="acheteur";
 $user = mysqli_fetch_assoc($result2);

}
if(mysqli_num_rows($result3) != 0)
{
 $visiteur="vendeur";
 $user = mysqli_fetch_assoc($result3);

}
else{

}

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

if($db_found)
{

    if(isset($_POST["accepter"]))
    {
        $id = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST["id"])); 
        $sql3 = "DELETE FROM objet WHERE idObjet = '$id'";
        $result3 = mysqli_query($db_handle, $sql3);
        $sql4 = "DELETE FROM transaction WHERE idObjet = '$id'";
        $result4 = mysqli_query($db_handle, $sql4);
    
    }
    
    
    if(isset($_POST["refuser"]))
    {
        $id = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST["id"])); 
    
        $sql2 = "SELECT DISTINCT nombreTransaction FROM transaction WHERE idObjet = '$id'";
        $result2 = mysqli_query($db_handle, $sql2);
        $trans = mysqli_fetch_array($result2);
        echo $trans[0];    
        $trans[0] = $trans[0] + 1 ;
    
        $sql3 = "UPDATE transaction SET nombreTransaction = '$trans[0]' WHERE idObjet = '$id'";
        $result3 = mysqli_query($db_handle, $sql3);
        $sql3 = "UPDATE transaction SET validation = '0' WHERE idObjet = '$id'";
        $result3 = mysqli_query($db_handle, $sql3);
    
    }

    if(isset($_POST["nvoffre"]))
    {
        $offre = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST["offre"])); 
        $id = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['id'])); 
    
        $sql3 = "UPDATE transaction SET validation = '1' WHERE idObjet = '$id'";
        $result3 = mysqli_query($db_handle, $sql3);
        $sql4 = "UPDATE transaction SET prixEnchere = '$offre' WHERE idObjet = '$id'";
        $result4 = mysqli_query($db_handle, $sql4);
    
    }
    

//si clic bouton supression vendeur / interface admin

if (isset($_POST["button4"])){   

    $supp = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['supp'])); 
    
    $supprimer = "DELETE FROM vendeur WHERE idVendeur = '$supp'";
    $supression = mysqli_query($db_handle, $supprimer);

} 

//si clic bouton supression produit / interface vendeur

if (isset($_POST["button5"])){   

    $objetsup = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['objetsup'])); 
    
    $supprimer = "DELETE FROM objet WHERE idObjet = '$objetsup'";
    $supression = mysqli_query($db_handle, $supprimer);

} 
/*
//si passe par formulaire d'inscription
 
if (isset($_POST["button1"])){

        $sql = "INSERT INTO acheteur(nomAcheteur, prenomAcheteur, adresseAcheteur, emailAcheteur, connexion) VALUES('$nomac', '$prenomac', '$adresseac', '$emailac','1')";
        $result = mysqli_query($db_handle, $sql);

        $sql ="SELECT*FROM acheteur WHERE connexion LIKE '1'";
        $result = mysqli_query($db_handle, $sql);
        $user = mysqli_fetch_assoc($result);
        $idAcheteur= $user['idAcheteur'];
        
        $sql = "INSERT INTO panier(idAcheteur, prixPanier) VALUES('$idAcheteur', '0')";
        $result = mysqli_query($db_handle, $sql);

        $sql ="SELECT*FROM panier where idAcheteur = '$idAcheteur'";
        $result = mysqli_query($db_handle, $sql);
        $user = mysqli_fetch_assoc($result);
        $idPanier= $user['idPanier'];

        $sql = "UPDATE acheteur SET idPanier = $idPanier WHERE idAcheteur = $idAcheteur";
        $result = mysqli_query($db_handle, $sql);


} 

if (isset($_POST["button2"])) {
	
      
        $sql = "INSERT INTO vendeur(pseudoVendeur, emailVendeur, nomVendeur, photoVendeur, fondVendeur, idAdmin, connexion) VALUES('$pseudove', '$emailve', '$nomve', '$photove', '$fondve', '1', '1')";
 $result = mysqli_query($db_handle, $sql);

}

//si passe par formulaire de connexion

if (isset($_POST["button3"])){echo"oui";

    //acheteur

if(isset($_POST['login']) && isset($_POST['password']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['login'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['password']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM acheteur where 
              emailAcheteur = '".$username."' and nomAcheteur = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['login'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE acheteur SET connexion = '1' WHERE emailAcheteur = '".$username."' and nomAcheteur = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}*/
}

//si clic bouton mettre en vente produit de la page vendeur

if (isset($_POST["button6"])){ 

    //echo "vendeurrrrr";
    if(empty($nomObjet)||empty($prixObjet)||empty($volume)||empty($typeAchat)||empty($rarete)||empty($categorie))
    {
        $erreur= "Un champ ou plusieurs champs obligatoires sont vides";
    
    }
    else{
    
        //On cherche l'id du vendeur
        $sql = "SELECT idVendeur FROM vendeur where connexion like '1' ";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $idVendeur = $data['idVendeur'];
    
         //on regarde si l'objet existe deja 
         $sql="SELECT * FROM  objet where nomObjet like '$nomObjet' AND idVendeur like '$idVendeur'";
         $result = mysqli_query($db_handle, $sql);

        if (mysqli_num_rows($result) != 0) 
         {
            $erreur= "Cet objet est déjà en vente par ce vendeur";

         }else 
             {
                $sql = "INSERT INTO objet(idVendeur,nomObjet,prixObjet,volume,photo1,photo2,photo3,video,typeAchat,rarete,categorie,debutEnchere,finEnchere) VALUES('$idVendeur','$nomObjet','$prixObjet','$volume','$photo1','$photo2','$photo3','$video','$typeAchat','$rarete','$categorie',DATE(NOW()), DATE(NOW())+ INTERVAL 20 DAY)";
                $result = mysqli_query($db_handle, $sql);
                $erreur= "nouvel objet crée";
              }
        }

}

//si clic bouton mettre en vente produit de la page admin

if(isset($_POST["button7"])){ 

    //echo "adminnnnnnn";
    if(empty($nomObjet)||empty($prixObjet)||empty($volume)||empty($typeAchat)||empty($rarete)||empty($categorie)||empty($nomVendeur))
    {
         $erreur= "Un champ ou plusieurs champs obligatoires sont vides";
    
    }
    else{
    
         //On cherche l'id du vendeur
            $sql = "SELECT idVendeur FROM vendeur where nomVendeur like '$nomVendeur' ";
            $result = mysqli_query($db_handle, $sql);
             if (mysqli_num_rows($result) == 0) 
             {
                $erreur= "Ce vendeur n'existe pas";

             }
             else {
            $data = mysqli_fetch_assoc($result);
            $idVendeur = $data['idVendeur'];
        
            //on regarde si l'objet existe deja 
            $sql="SELECT * FROM  objet where nomObjet like '$nomObjet' AND idVendeur like '$idVendeur'";
            $result = mysqli_query($db_handle, $sql);

            if (mysqli_num_rows($result) != 0) 
             {
                $erreur= "Cet objet est déjà en vente par ce vendeur";

             }else {
                    $sql = "INSERT INTO objet(idVendeur,nomObjet,prixObjet,volume,photo1,photo2,photo3,video,typeAchat,rarete,categorie,debutEnchere,finEnchere) VALUES('$idVendeur','$nomObjet','$prixObjet','$volume','$photo1','$photo2','$photo3','$video','$typeAchat','$rarete','$categorie',DATE(NOW()), DATE(NOW())+ INTERVAL 20 DAY)";
                    $result = mysqli_query($db_handle, $sql);
                    $erreur= "nouvel objet en vente";
                  }
        }
      }
}

//si clic bouton appliquer réduction page admin

if (isset($_POST["button8"])){ 

        //On cherche la reduction appliquée
        $sql = "SELECT reduc FROM admin where connexion like '1' ";
        $result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $reducInitial = $data['reduc'];

    if($reduc == $reducInitial)
    {
        $infoReduc= "Cette réduction est déjà appliquée";
    
    }
    else{
        
        //On applique la réduction
        
        $sql = "UPDATE objet SET prixObjet = (prixObjet/'$reducInitial')*$reduc";
        mysqli_query($db_handle, $sql);

        if($reduc == '0.9')
        {
            $infoReduc= "Réduction de -10% appliquée";
        }

        if($reduc == '0.8')
        {
            $infoReduc= "Réduction de -20% appliquée";
        
        }

         if($reduc == '1')
        {
            $infoReduc= "Pas de réduction appliquée";
        }
        
        $sql = "UPDATE admin SET reduc = '$reduc'";
        mysqli_query($db_handle, $sql);

        }


}


//si clic sur soumettre une transaction

if (isset($_POST["button9"])){ 

    $prix = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['prix'])); 
    $id = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['id'])); 
    $iduser = $user['idAcheteur'];
    echo $prix;
    echo $id;
    echo $iduser;

    $sql0 = "SELECT DISTINCT nombreTransaction FROM transaction WHERE idObjet = '$id' AND idAcheteur = '$iduser'";
    $result0 = mysqli_query($db_handle, $sql0);
    $res = mysqli_fetch_array($result0);                               
    $nb = $res[0]+1;

    $sql = "UPDATE transaction SET prixEnchere = '$prix' WHERE idObjet = '$id' AND idAcheteur = '$iduser'";
    $sql1 = "UPDATE transaction SET nombreTransaction = '$nb' WHERE idObjet = '$id' AND idAcheteur = '$iduser'";
    $sql2 = "UPDATE transaction SET validation = '1' WHERE idObjet = '$id' AND idAcheteur = '$iduser'";

    $result = mysqli_query($db_handle, $sql);
    $result1 = mysqli_query($db_handle, $sql1);
    $result2 = mysqli_query($db_handle, $sql2);

}


    //vendeur

/*    
if(isset($_POST['pseudo']) && isset($_POST['email']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['pseudo'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['email']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM vendeur where 
              pseudoVendeur = '".$username."' and emailVendeur = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudo'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE vendeur SET connexion = '1' WHERE pseudoVendeur = '".$username."' and emailVendeur = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}

// admin

if(isset($_POST['pseudoAdmin']) && isset($_POST['mdpAdmin']))
{
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['pseudoAdmin'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['mdpAdmin']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM admin where 
              pseudoAdmin = '".$username."' and mdpAdmin = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['pseudoAdmin'] = $username;
           echo"utilisateur et mot de passe correctes";

           //on connecte l'utilisateur
           $sql = "UPDATE admin SET connexion = '1' WHERE pseudoAdmin = '".$username."' and mdpAdmin = '".$password."'";
           $result = mysqli_query($db_handle, $sql);

        }
        else
        {
           echo"utilisateur ou mot de passe incorrect";
        }
    }
    else
    {
       echo"utilisateur ou mot de passe vide";
    }
}
else
{
   
}*/

} 


//on cherche les coordonnées bancaires de l'acheteur connecté
if($db_found)
{
    if($visiteur=="acheteur")
    {   

        $sql = "SELECT * FROM acheteur WHERE connexion like '1'";
		$result = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($result);
        $idAcheteur = $data['idAcheteur'];

        $sql = "SELECT * FROM paiement WHERE idAcheteur LIKE '$idAcheteur'";
	    $result = mysqli_query($db_handle, $sql);

		//regarder s'il y a des resultats
        if (mysqli_num_rows($result) == 0) 
        {
            $infoBancaires = "Vous n'avez pas d'informations de paiement enregistrées";
        }
        else
        {   
            $data = mysqli_fetch_assoc($result);
            $card = $data['typeCarte'];
            $numCarte = $data['numPaiement'];
            $nomCarte = $data['nomPaiement'];
            $dateExp = $data['dateExpiration'];
            $codeSecurite = $data['codeSecurite'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Alcool Store - Mon compte</title>
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
                <?php if($visiteur!=" ")?>
                  
                <li class="nav-item"><a href="compte.php" class="nav-link">Votre compte</a></li>
          
                <?php endif?>
                  
                 <?php if($visiteur==" ")?>
                  
                <li class="nav-item"><a href="login.php" class="nav-link">Votre compte</a></li>
          
                <?php endif?>
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
                class="fa fa-chevron-right"></i></a></span> <span>Votre compte <i
                    class="fa fa-chevron-right"></i></span></p>
                    <h2 class="mb-0 bread">Bonjour <?php if($visiteur=="admin"){echo $user['pseudoAdmin'];}if($visiteur=="acheteur"){echo $user['prenomAcheteur'];}if($visiteur=="vendeur"){echo $user['pseudoVendeur'];} ?></h2>
                </div>
            </div>
        </div>
    </section>

<?php if($visiteur == "vendeur") :?>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                  <h3 class="mb-4 billing-heading">Vos données personnelles :</h3>

                  <img src="images/<?php echo $user['fondVendeur'] ?>" alt="fond" width="600px" height="300">
                  <img src="images/<?php echo $user['photoVendeur'] ?>" alt="photo" width="300" height="300">

              </div>
          </div>
      </div>
  </section>

  <section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center">
                <h2>Gestion de vos produits en vente</h2>
            </div>
        </div>

        <div class="row">
         
            <?php foreach($products as $product) : ?>

                <?php if($product['idVendeur'] == $user['idVendeur']) : ?>

                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                            style="background-image:url(images/<?php echo $product['photo1']; ?>)">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    
                                    <form action="compte.php" method="post" class="text-align-center">
                                           
<input style="display:none;" type="text" value="<?php echo $product['idObjet']; ?>" name="objetsup">
<button type="submit" name="button5" class="btn btn-primary py-2 px-2"><a class="d-flex align-items-center justify-content-center"><span
        class="fa fa-trash"></span></a></button>

</form>
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
                    <?php endif ?>

                <?php endforeach ?>
                
            </div>
            
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                    <form action="compte.php" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Ajouter un produit</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" placeholder="" name="nomObjet">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix">Prix</label>
                                    <input type="number" class="form-control" placeholder="" name="prixObjet">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volume">Volume</label>
                                    <input type="number" class="form-control" placeholder="" name="volume">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 1</label>
                                    <input type="text" class="form-control" placeholder="" name="photo1">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 2</label>
                                    <input type="text" class="form-control" placeholder="" name="photo2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 3</label>
                                    <input type="text" class="form-control" placeholder="" name="photo3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Fichier vidéo</label>
                                    <input type="text" class="form-control" placeholder="" name="video">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Type d'achat</label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="immediat">Immédiat </label>
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="meilleurOffre">Meilleur Offre </label>
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="transaction">Transaction</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Rareté</label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="rarete" value="hautDeGamme">Haut de gamme</label>
                                            <label class="mr-3"><input type="radio" name="rarete" value="rare">Rare</label>
                                            <label class="mr-3"><input type="radio" name="rarete" value="regulier">Régulier</label>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categorie">Catégorie</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="categorie" id="" class="form-control">
                                            <option value="whisky">Whisky</option>
                                            <option value="brandy">Brandy</option>
                                            <option value="gin">Gin</option>
                                            <option value="rhum">Rhum</option>
                                            <option value="tequila">Tequila</option>
                                            <option value="vodka">Vodka</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p><button type="submit" name="button6" class="btn btn-primary py-3 px-4 mt-4">Mettre en vente le produit</button></p>
                                <span><?= $erreur ?></span>
                            </div>               
                            
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </section>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                        <h3 class="mb-4 billing-heading">Nouvelles offres</h3>

                        <?php
                         $vendeur = $user['idVendeur'];
                        $sql6 = "SELECT DISTINCT O.idObjet, O.nomObjet, O.prixObjet, O.photo1, O.typeAchat, O.rarete, O.categorie FROM transaction T, objet O WHERE T.validation = '1' AND O.idVendeur = '$vendeur' AND T.idObjet = O.idObjet";
                        $result6 = mysqli_query($db_handle, $sql6);?>
                        
                        <?php if(mysqli_num_rows($result6) != 0):?>

                        <?php while ($notif = mysqli_fetch_assoc($result6)) { 
                            $notifs[] = $notif; 
                        } ?>
                        <?php foreach($notifs as $notif) : ?>

                        <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-5 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                            <div class="product ftco-animate">
                                <div class="img d-flex align-items-center justify-content-center"
                                    style="background-image:url(images/<?php echo $notif['photo1']; ?>)">

                                </div>
                                <div class="text text-center" >
                                    <span class="sale" style="background-color:<?php if($notif['rarete']=="hautDeGamme"){echo "#b7472a";}if($notif['rarete']=="rare"){echo "#fe9801";}if($notif['rarete']=="regulier"){echo "#01d28e";} ?>"><?php if($notif['rarete']=="hautDeGamme"){echo "Haut de gamme";}if($notif['rarete']=="rare"){echo "Rare";}if($notif['rarete']=="regulier"){echo "Régulier";}; ?></span>
                                    <span class="category"><?php echo $notif['categorie']; ?></span>
                                    <h2><?php echo $notif['nomObjet']; ?></h2>
                                    <p class="mb-0"> <span
                                            class="price"><?php echo $notif['prixObjet']; ?>€</span></p>
                                </div>
                            </div>
                                <hr>
                                <p class="d-flex total-price">
                                    <?php
                                    $idm = $notif['idObjet'];
                                    $sql7 = "SELECT DISTINCT A.nomAcheteur FROM acheteur A, transaction T WHERE T.idObjet = '$idm' AND A.idAcheteur = T.idAcheteur";
                                    $result7 = mysqli_query($db_handle, $sql7);
                                    $ach_nom = mysqli_fetch_array($result7);
                                    $sql8 = "SELECT DISTINCT T.prixEnchere FROM transaction T, acheteur A WHERE T.idObjet = '$idm' AND A.idAcheteur = T.idAcheteur";
                                    $result8 = mysqli_query($db_handle, $sql8);
                                    $propo = mysqli_fetch_array($result8);

                                    ?>

                                    <span>Acheteur</span>
                                    <span><?php echo $ach_nom[0]; ?></span>
                                </p>
                                <p class="d-flex total-price">
                                    <span>Proposition</span>
                                    <span><?php echo $propo[0]; ?>€</span>
                                </p>
                            </div>
                        </div>
                      </div>

                      <div class="row md-4 d-flex">
                      <div class="col-md-2">

                      <form action="compte.php" method="post" class="text-align-center">

<input class="hidden" type="text" value="<?php echo $notif['idObjet']; ?>" name="id">

<p><button type="submit" name="accepter" class="btn btn-primary ml-3 py-3 px-4 mt-4">Accepter</button></p>

</form>

                            </div>  
                            <div class="col-md-2">

                            <form action="compte.php" method="post" class="text-align-center">

<input class="hidden" type="text" value="<?php echo $notif['idObjet']; ?>" name="id">

<p><button type="submit" name="refuser" class="btn btn-primary ml-3 py-3 px-4 mt-4">Refuser</button></p>

</form>
<?php endforeach ?>   
<?php endif ?> 
<?php if(mysqli_num_rows($result6) == 0):?>
    <p> Pas de nouvelles offres </p>
<?php endif ?> 
                            </div>  
                      </div>  
                </div>
            </div>
        </div>
    </section>

<?php endif ?>


<?php if($visiteur == "acheteur") :?>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 ftco-animate">
              <h3 class="mb-4 billing-heading">Vos données personnelles :</h3>

              <p><strong>Nom :&emsp;</strong><?php echo $user['nomAcheteur'] ?></p>
              <p><strong>Prénom :&emsp;</strong><?php echo $user['prenomAcheteur'] ?></p>
              <p><strong>Adresse :&emsp;</strong><?php echo $user['adresseAcheteur'] ?></p>
              <p><strong>Email :&emsp;</strong><?php echo $user['emailAcheteur'] ?></p>

              <h3 class="mb-4 mt-4 billing-heading">Vos informations bancaires :<br></h3>
              <?php echo $infoBancaires?></p>
              <p><strong>Type de carte :&emsp;</strong><?php echo$card ?></p>
              <p><strong>Numéro de la carte :&emsp;</strong>
              <?php 
                for ($i = 0; $i<= strlen($numCarte)-3 ; $i++)
                {
                    echo " * ";
                }
                echo $numCarte[strlen($numCarte)-2];
                echo " ";
                echo $numCarte[strlen($numCarte)-1];
              
              ?></p>
              <p><strong>Nom sur la carte :&emsp;</strong><?php echo$nomCarte ?></p>
              <p><strong>Date d'expiration :&emsp;</strong><?php echo$dateExp ?></p>
              <!--<p><strong>Nom :&emsp;</strong><?php echo$codeSecurite ?></p>-->

              <!--
              <h3 class="mb-4 mt-4 billing-heading">Avez-vous accepté notre clause ?</h3>

              <form action="check.php" class="billing-form">

              <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="" class="mr-2"> I have read and accept
                                                the terms and conditions</label>
                                        </div>
                                    </div>
                </div>

                <div class="col-md-12">
                                <p><button type="submit" class="btn btn-primary py-3 px-4">Enregistrer</button></p>

                            </div>
               </form>
            -->

          </div>
      </div>
  </div>
</section>

<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                        <h3 class="mb-4 billing-heading">Vos transactions</h3>

                        <?php
                        $acheteur = $user['idAcheteur'];
                        $sql6 = "SELECT DISTINCT O.idObjet, O.nomObjet, O.prixObjet, O.photo1, O.typeAchat, O.rarete, O.categorie FROM transaction T, objet O WHERE T.validation = '0' AND T.idAcheteur = '$acheteur' AND T.idObjet = O.idObjet";
                         $result6 = mysqli_query($db_handle, $sql6);?>
                        
                        <?php if(mysqli_num_rows($result) != 0):?>

                        <?php while ($notif = mysqli_fetch_assoc($result6)) { 
                            $notifs[] = $notif; 
                        }?>
                        <?php foreach($notifs as $notif) : ?>

                        <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-5 d-flex">
                            <div class="cart-detail cart-total p-3 p-md-4">
                            <div class="product ftco-animate">
                                <div class="img d-flex align-items-center justify-content-center"
                                    style="background-image:url(images/<?php echo $notif['photo1']; ?>)">

                                </div>
                                <div class="text text-center" >
                                    <span class="sale" style="background-color:<?php if($notif['rarete']=="hautDeGamme"){echo "#b7472a";}if($notif['rarete']=="rare"){echo "#fe9801";}if($notif['rarete']=="regulier"){echo "#01d28e";} ?>"><?php if($notif['rarete']=="hautDeGamme"){echo "Haut de gamme";}if($notif['rarete']=="rare"){echo "Rare";}if($notif['rarete']=="regulier"){echo "Régulier";}; ?></span>
                                    <span class="category"><?php echo $notif['categorie']; ?></span>
                                    <h2><?php echo $notif['nomObjet']; ?></h2>
                                    <p class="mb-0"> <span
                                            class="price"><?php echo $notif['prixObjet']; ?>€</span></p>
                                </div>
                            </div>
                            <form action="compte.php" method="post" class="text-align-center">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volume">Faire une nouvelle offre ?</label>
                                    <input type="text" class="form-control" placeholder="" name="offre">
                                </div>
                            </div>
                            <input class="hidden" type="text" value="<?php echo $notif['idObjet']; ?>" name="id">
<p><button type="submit" name="nvoffre" class="btn btn-primary ml-3 py-3 px-4 mt-4">Envoyer</button></p>

</form>
<?php endforeach ?>
<?php endif ?>
<?php if(mysqli_num_rows($result6) == 0):?>
    <p> Pas de nouvelles transactions </p>
<?php endif ?>
                   
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </section>

<?php endif ?>

<?php if($visiteur == "admin") :?>


    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                   <form action="compte.php" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Ajouter un produit</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" placeholder="" name="nomObjet">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="prix">Prix</label>
                                    <input type="number" class="form-control" placeholder="" name="prixObjet">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="volume">Volume</label>
                                    <input type="number" class="form-control" placeholder="" name="volume">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 1</label>
                                    <input type="text" class="form-control" placeholder="" name="photo1">
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 2</label>
                                    <input type="text" class="form-control" placeholder="" name="photo2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Fichier photo 3</label>
                                    <input type="text" class="form-control" placeholder="" name="photo3">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="video">Fichier vidéo</label>
                                    <input type="text" class="form-control" placeholder="" name="video">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Type d'achat</label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="immediat">Immédiat </label>
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="meilleurOffre">Meilleur Offre </label>
                                            <label class="mr-3"><input type="radio" name="typeAchat" value="transaction">Transaction</label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="firstname">Rareté</label>
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="rarete" value="hautDeGamme">Haut de gamme</label>
                                            <label class="mr-3"><input type="radio" name="rarete" value="rare">Rare</label>
                                            <label class="mr-3"><input type="radio" name="rarete" value="regulier">Régulier</label>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="categorie">Catégorie</label>
                                    <div class="select-wrap">
                                        <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="categorie" id="" class="form-control">
                                            <option value="whisky">Whisky</option>
                                            <option value="brandy">Brandy</option>
                                            <option value="gin">Gin</option>
                                            <option value="rhum">Rhum</option>
                                            <option value="tequila">Tequila</option>
                                            <option value="vodka">Vodka</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vendeur">Nom du Vendeur</label>
                                    <input type="text" class="form-control" placeholder="" name="nomVendeur">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <p><button type="submit" name="button7" class="btn btn-primary py-3 px-4 mt-4">Mettre en vente le produit</button></p>
                                <span><?= $erreur ?></span>
                            </div>               
                            
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
    <div class="container">

        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center">
                <h2>Gestion des vendeurs</h2>
            </div>
        </div>

        <div class="row">
         
            <?php foreach($vendeurs as $vendeur) : ?>

                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                            style="background-image:url(images/<?php echo $vendeur['photoVendeur']; ?>)">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                <form action="compte.php" method="post" class="text-align-center">
                                           
<input style="display:none;" type="text" value="<?php echo $vendeur['idVendeur']; ?>" name="supp">
<button type="submit" name="button4" class="btn btn-primary py-2 px-2"><a class="d-flex align-items-center justify-content-center"><span
        class="fa fa-trash"></span></a></button>

</form>
                                    
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center" >
                                <h2><?php echo $vendeur['nomVendeur']; ?></h2>
                                <p class="mb-0"> <span
                                    class="price"><?php echo $vendeur['emailVendeur']; ?></span></p>
                                </div>
                            </div>
                        </div>    

                <?php endforeach ?>
                
            </div>
            
        </div>

        <!--<section class="ftco-section">-->
    <div class="container">

        <div class="row justify-content-center pb-5">
            <div class="col-md-7 heading-section text-center">
                <h2>Gestion de tous les produits en vente</h2>
            </div>
        </div>

        <div class="row">
         
            <?php foreach($products as $product) : ?>


                    <div class="col-md-4 d-flex">
                        <div class="product ftco-animate">
                            <div class="img d-flex align-items-center justify-content-center"
                            style="background-image:url(images/<?php echo $product['photo1']; ?>)">
                            <div class="desc">
                                <p class="meta-prod d-flex">
                                    
                                    <form action="compte.php" method="post" class="text-align-center">
                                           
<input style="display:none;" type="text" value="<?php echo $product['idObjet']; ?>" name="objetsup">
<button type="submit" name="button5" class="btn btn-primary py-2 px-2"><a class="d-flex align-items-center justify-content-center"><span
        class="fa fa-trash"></span></a></button>

</form>
                                    </p>
                                </div>
                            </div>
                            <div class="text text-center" >
                                <span class="sale" style="background-color:<?php if($product['rarete']=="hautDeGamme"){echo "#b7472a";}if($product['rarete']=="rare"){echo "#fe9801";}if($product['rarete']=="regulier"){echo "#01d28e";} ?>"><?php if($product['rarete']=="hautDeGamme"){echo "Haut de gamme";}if($product['rarete']=="rare"){echo "Rare";}if($product['rarete']=="regulier"){echo "Régulier";}; ?></span>
                                <span class="category"><?php echo $product['categorie']; ?></span>
                                <h2><?php echo $product['nomObjet']; ?></h2>
                                <p class="mb-0"> <span class="price"><?php echo $product['prixObjet']; ?>€</span></p>
                                </div>
                            </div>
                        </div>    

                <?php endforeach ?>
                
            </div>
            
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 ftco-animate">
                   <form action="compte.php" class="billing-form" method="post">
                        <h3 class="mb-4 billing-heading">Choisir la réduction à appliquer</h3>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group mt-2">
                                        <div class="radio">
                                            <label class="mr-3"><input type="radio" name="reduc" value="1">Pas de réduction</label>
                                            <label class="mr-3"><input type="radio" name="reduc" value="0.9">10%</label>
                                            <label class="mr-3"><input type="radio" name="reduc" value="0.8">20%</label>
                                        </div>
                                    </div>

                            <div class="col-md-12">
                                <p><button type="submit" name="button8" class="btn btn-primary py-3 px-4 mt-4">Appliquer la réduction</button></p>
                                <span><?= $infoReduc ?></span>
                            </div>               
                            
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </section>
 

 <?php endif ?>

 <section class="ftco-section">
    <div class="container">
        <div class="row">
        <div class="col md-3">
            <form action="login.php" method="post" style="margin-left:80%;">
                
                <input class="hidden" type="text" value="" name="id">
                <p><button type="submit" name="button8" class="btn btn-primary py-3 px-4 mt-4">Déconnexion</button></p>

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