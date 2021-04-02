<!DOCTYPE html>
<html lang="en">
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
    <!-- Ajout d'un genre -->
<form action="genreAjout.php" method="post">
      <h1>Ajout d'un genre</h1>
      <input type="text" name="genre_name" required placeholder="Genre">
      <input type="submit" name="create" value="Go!">
    </form>

<?php

if (isset($_POST['create'])) {
    $genre_name = $_POST['genre_name'];
    try {
        include('DBconnect.php');
      $pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
      $requete = "INSERT INTO `genres` (`genre_name`)
                  VALUES (:genre_name);";
      $prepare = $pdo->prepare($requete);
      $prepare->execute(array(
        ':genre_name' => $genre_name
      ));
      $res = $prepare->rowCount();
  
      if ($res == 1) {
        echo "<p>Le genre a été ajouté à la DB !</p>";
           
      }
    } catch (PDOException $e) {
      exit("❌🙀❌ OOPS :\n" . $e->getMessage());
      
    }
  }
?>

</div>
<a href='../index.php'>Retour au site </a>
</body>
</html>
