

<?php
if(isset($_POST['identifiant']) && isset($_POST['passw']))
{
    // connexion à la base de données
    $database = "paris shopping";

    $db_handle = mysqli_connect('localhost', 'root', '')
           or die('could not connect to database');
           
    $db_found = mysqli_select_db($db_handle, $database);
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $username = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['identifiant'])); 
    $password = mysqli_real_escape_string($db_handle,htmlspecialchars($_POST['passw']));
    
    if($username !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM acheteur where 
              nomAcheteur = '".$username."' and emailAcheteur = '".$password."' ";
        $exec_requete = mysqli_query($db_handle,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['identifiant'] = $username;
           echo"utilisateur et mot de passe correctes";
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
mysqli_close($db_handle); // fermer la connexion
?>
