<?php
  include('DBconnect.php');
/// On va faire une première requête pour afficher les artistes
$connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS); // On établit la connexion
$tableau = []; // A revoir 
$requete = "SELECT * FROM artists"; // On sélectionne la table
//On prépare la requête dans un petit try / catch pour la gestion d'erreur
try {
$prepare = $connexion->prepare($requete);
$prepare->execute();
$affichageGenre = $prepare->rowCount();
if ($affichageGenre) $tableau = $prepare->fetchAll();
else echo "<pre>:heavy_multiplication_x: La requête SQL ne retourne aucun résultat</pre>";
} catch (PDOException $e) {
echo "<pre>:heavy_multiplication_x: Erreur liée à la requête SQL :\n" . $e->getMessage() . "</pre>";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    body{
    background-color: #edd6fc;
}
* {
    text-align: center;
}

.genre {

  position: relative;
  z-index: 1;
  background: #FFFFFF;
  max-width: 360px;
  margin: 0 auto 100px;
  padding: 45px;
  text-align: center;
  box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
}
.genre input {
  font-family: "Roboto", sans-serif;
  outline: 0;
  background: #f2f2f2;
  width: 100%;
  border: 0;
  margin: 0 0 15px;
  padding: 15px;
  box-sizing: border-box;
  font-size: 14px;
}

</style>

<div class="genre">
<form action="?artists" method="POST">
<h1>Artistes</h1>
<label for="artists_id">Artiste à virer ?</label>
<select name="artists_id" id="artists_id">
  <?php
    foreach($tableau as $key => $value){
      echo "<option value=".$value['artists_id'].">".$value['artists_nom']."</option>";
    }
  ?>
</select>
<input type="submit" value="delete" name="delete">
</form>
   
   
     <a href='../index.php'>Retour au site </a>
     <?php

//DELETE
if (isset($_POST['delete'])) {
    $artists_id = $_POST['artists_id'];
  

try {
$pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
$requete = "DELETE FROM `assoc_styles_artists`
            WHERE assoc_artists_id = :artists_id";
$prepare = $pdo->prepare($requete);
$prepare->execute(array(
  ':artists_id' => $artists_id
));      
} catch (PDOException $e) {
exit("❌🙀❌ OOPS :\n" . $e->getMessage());
}

try {
    $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
    $requete = "DELETE FROM `artists` WHERE `artists_id` = :artists_id;";
    $prepare = $pdo->prepare($requete);
    $prepare->execute(array(
        ':artists_id' => $artists_id
    ));
    echo "<p>L'artiste a bien été supprimé</p>";
} catch (PDOException $e) {
    exit("❌🙀❌ OOPS :\n" . $e->getMessage());
}
}




?>
</div>
</body>
</html>
