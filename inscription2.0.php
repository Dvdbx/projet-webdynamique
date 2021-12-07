<?php
//declaration des variables
$database = "paris shopping";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', 'root' );
$db_found = mysqli_select_db($db_handle, $database);
$name = isset($_POST["nom"])? $_POST["nom"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$motdepasse = isset($_POST["mdp"])? $_POST["mdp"] : "";



$erreur = "";
$check1 = isset($_POST['inscriptionAcheteur']) ? "checked" : "unchecked";
if($check1=="checked")
{
echo $check1;
}
$check2 = isset($_POST['inscriptionVendeur']) ? "checked" : "unchecked";
if($check2=="checked")
{
echo $check2;
}
if(($check1=="unchecked")&&($check2=="unchecked"))
    {
$erreur .= "Vous n'avez pas sélectionné votre statut <br>";
}
if(($check1=="checked")&&($check2=="checked"))
    {
$erreur .= "Vous ne pouvez pas être un vendeur et un acheteur à la fois <br>";
}
if ($name == "") {
$erreur .= "Le champ Nom est vide. <br>";
}
if ($email == "") {
$erreur .= "Le champ email est vide. <br>";
}
if ($prenom == "") {
$erreur .= "Le champ Prenom est vide. <br>";
}
if ($motdepasse == "") {
$erreur .= "Le champ motdepasse est vide. <br>";
}

if ($erreur == "") {
echo "Formulaire valide.";
 //si le BDD existe, faire le traitement
if ($db_found) {
   
$sql = "INSERT INTO acheteur(nomAcheteur, prenomAcheteur, adresseAcheteur, emailAcheteur) VALUES('$name', '$prenom', '$motdepasse', '$email')";
 $result = mysqli_query($db_handle, $sql);

}
else {
 echo "Database not found";
}//end else
//fermer la connection
mysqli_close($db_handle);
} 
else {
echo "Erreur: <br>" . $erreur;
}
?>
