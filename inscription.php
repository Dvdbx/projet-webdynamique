<?php
//declaration des variables
$database = "Paris Shopping";
//connectez-vous dans votre BDD
//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
$db_handle = mysqli_connect('localhost', 'root', '' );
$db_found = mysqli_select_db($db_handle, $database);
$name = isset($_POST["nom"])? $_POST["nom"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
$motdepasse = isset($_POST["mdp"])? $_POST["mdp"] : "";
$erreur = "";
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
