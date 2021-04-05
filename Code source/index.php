<?php
include('DBconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cameron</title>
    <h1>Bienvenue chez Cameron</h1>
</head>
<body>
<div class=Ajouter>
<a href='genreAjout.php/'style="color:pink"> Ajouter un genre </a> </br>
<a href='stylesAjout.php/'style="color:green"> Ajouter un style </a> </br>
<a href='artistsAjout.php/'style="color:yellow"> Ajouter un artiste </a> </br>
</div>


<h2> Les genres </h2>
<div class='genre'>
<?php


// On va faire une première requête pour afficher les genres
  $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS); // On établit la connexion
  $tableau = []; // A revoir 
  $requete = "SELECT * FROM genres"; // On sélectionne la table
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
// Petit foreach pour tout afficher 
  foreach ($tableau as $genre) {
    echo "<section>";
    echo "<p>" . htmlentities($genre["genre_name"], ENT_QUOTES) . "</p>"; // Ajout du HTML entities pour éviter les failles XSS GET REKT 
    echo ("<a id='mod1' href='genres.php/?id=".htmlentities($genre["genre_id"], ENT_QUOTES)."'> Modifier ce genre </a> <br>");
    echo ("<a id='mod1' href='suppr.php/?id=".htmlentities($genre["genre_id"], ENT_QUOTES)."'> Supprimer ce genre </a> <br>");
    echo "</section>";
  }
  ?>
</div>

<h3> Les styles </h3>
<div class='style'>
<?php
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
// Petit foreach pour tout afficher 
  foreach ($tableau as $styles) {
    echo "<section>";
    echo "<p>" . htmlentities($styles["style_name"], ENT_QUOTES) . "</p>"; // Ajout du HTML entities pour éviter les failles XSS GET REKT 
    echo ("<a id='mod1' href='styles.php/?id=".htmlentities($styles["style_id"], ENT_QUOTES)."'> Modifier ce style </a> <br>");
    echo ("<a id='mod1' href='supprStyle.php/?id=".htmlentities($styles["style_id"], ENT_QUOTES)."'> Supprimer ce style </a> <br>");
    echo "</section>";
  }
?>
  </div>

  <h4> Les artistes </h4>
<div class='artists'>
<?php
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
// Petit foreach pour tout afficher 
  foreach ($tableau as $artists) {
    echo "<section>";
    echo "<p>" . htmlentities($artists["artists_nom"], ENT_QUOTES) . "</p>"; // Ajout du HTML entities pour éviter les failles XSS GET REKT 
    echo ("<a id='mod1' href='artists.php/?id=".htmlentities($artists["artists_id"], ENT_QUOTES)."'> Modifier cet artiste </a> <br>");
    echo ("<a id='mod1' href='supprArtists.php/?id=".htmlentities($artists["artists_id"], ENT_QUOTES)."'> Supprimer cet artiste </a> <br>");
    echo "</section>";
  }
?>


  </div>
</body>
</html>
