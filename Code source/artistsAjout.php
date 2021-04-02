<?php
  include('DBconnect.php');
/// On va faire une première requête pour afficher les styles
$connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS); // On établit la connexion
$tableau = []; // A revoir 
$requete = "SELECT * FROM styles"; // On sélectionne la table
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout d'un artiste</title>
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
    <!-- Ajout d'un artiste -->
<form method='POST' action='artistsAjout.php'>
    <label for='artists'>Artist:</label>
    <input classr='artists_nom' type='text' id='artists_nom' name='artists_nom' required>
<select name="style_name" id="style_name">

    <?php
    foreach ($tableau as $style):?> 
    <option><?=$style["style_name"]?></option>
    <?php endforeach ?>

</select>
<input class='submit' type='submit' value='valider'>
</form>
<div class="genreAjout">
<?php

$connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
if (isset($_POST['artists_nom'])) {
  try {
      // La requête d'insertion 
      $requete = "INSERT INTO `artists` (`artists_nom`) 
                  VALUES (:artists_nom);"; // EH BAH ELLE EXISTE PLUS 
    
     // Faut la préparer la requête quand même? ON SECURISE ! Adios les injections 
      $prepare = $connexion->prepare($requete);
      $prepare->execute(array(
        ":artists_nom" => $_POST['artists_nom']
      ));
      $lastInsertedId = $connexion->lastInsertId();
    } catch (PDOException $e) {
      // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
      exit("❌🙀💀 OOPS :\n" . $e->getMessage());
    }

    try {
        // La requête d'insertion dans la table associative 
        $requete = "INSERT INTO `assoc_styles_artists` (`assoc_styles_id`, `assoc_artists_id`) 
                    VALUES (:style_id, :artists_id);"; 
      
       // Faut la préparer la requête quand même? ON SECURISE ! Adios les injections 
        $prepare = $connexion->prepare($requete);
        $prepare->execute(array(
            ":artists_id" => $lastInsertedId,
            ":style_id" => $style["style_id"]
        ));
        $resultat = $prepare->rowCount(); // rowCount() nécessite PDO::MYSQL_ATTR_FOUND_ROWS => true

        if ($resultat == 1) {
            echo "<p>L'artiste a été ajouté à la DB !</p>";
               
          }
    } catch (PDOException $e) {
        // en cas d'erreur, on récup et on affiche, grâce à notre try/catch
        exit("❌🙀💀 OOPS :\n" . $e->getMessage());
      }  //END
      
    }
    
?>
</div>
<a href='../index.php'>Retour au site </a>
</body>
</html>