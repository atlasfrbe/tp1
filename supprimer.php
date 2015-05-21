<?php
$requete='DELETE FROM articles WHERE reference="'.$_GET['reference'].'"';
require_once("connexion.php");
// $resultat=mysql_query($requete);
$resultat=$pdo->query($requete);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Supprimer un article</title>
</head>

<body>

L'article ayant la référence <?php echo $_GET['reference']; ?> a été supprimé
</br>
<a href="listeA.php">Retour à la liste</a>
</body>
</html>