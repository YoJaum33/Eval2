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
<?php
include('DBconnect.php');
 $connexion = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
 $requete = "SELECT * FROM `styles` WHERE `style_id`=:style_id";
 $prepare = $connexion->prepare($requete);
 $style_id = htmlspecialchars($_GET['id']);

 $prepare->execute(array(
    "style_id"=> $style_id
    
));
$prepare = $prepare->fetch();

echo("
     <h1>Modifier les infos et cliquer sur Valider</h1>
     <div class='style'>
     <form method='POST' action='styles.php?id=".$prepare['style_id']."'>
     <label for='info_intro'>genre à changer:</label>
     <input type='textarea' id='style' name='style' value='".$prepare['style_name']."'>

     <input type='submit'  name='valider' value='Valider'> <br>
   
     <a href='../index.php'>Retour au site </a>
     </div>
 ");
 if (isset($_POST['valider'])) {
    $style = htmlspecialchars($_POST['style']);
  
   

    
    
try {
$pdo = new PDO(DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET, DB_LOGIN, DB_PASS, DB_OPTIONS);
$requete = "UPDATE `styles` 
                SET `style_name`=:style_name
                    
                    
                WHERE `style_id`=:style_id";
$prepare = $pdo->prepare($requete);
$prepare->execute(array(
     ":style_name"=> $style,
     ":style_id"=> $style_id
  
    

));
$res = $prepare->rowCount();

if ($res == 1) {
echo "<p>Modifications enregistrées!</p>";
}
} catch (PDOException $e) {
exit("❌🙀❌ OOPS :\n" . $e->getMessage());
}
}

?>
</div>
</body>
</html>