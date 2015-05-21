<?php
require_once("connexion.php"); // accés au fichier de connexion de la base de données
// on défini la requête SQL ci dessous
$requete='SELECT * FROM articles INNER JOIN familles ON articles.famillesID=familles.ID WHERE reference="'.$_GET['reference'].'"';
// on prérerera la méthode pdo que mysql car cette dernière est obsolète
$resultat=$pdo->query($requete); // $resultat=mysql_query($requete);
$articles=$resultat->fetch(); // $articles=mysql_fetch_array($resultat);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FicheA</title>
</head>

<body>

<table width="600" border="1" cellspacing="0" cellpadding="5">
  
 <tr>
    <td>Référence</td>
    <td><?php echo $articles['reference']; ?></td>
  </tr>
  <tr>
    <td>Prix</td>
    <td><?php echo $articles['prix']; ?></td>
  </tr>
  <tr>
    <td>Description</td>
    <td><?php echo $articles['designation']; ?></td>
  </tr>
  <tr>
    <td>Famille</td>
    <td><?php echo $articles['famillesID']; ?></td>
  </tr>
   <tr>
    <td>Photo</td>
    <td><img src="images/<?php echo $articles['photo']; ?>" ></td>
  </tr> 
  
  
</table>


</body>
</html>