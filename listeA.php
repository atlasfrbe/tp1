<?php
// on inclu dans la page php le code du fichier de connexion de la base de données où on trouvera en autre le pdo reprenant les identifiants de connexion à la base de données
include("connexion.php");

// si on a récupéré quelque chose du formulaire qui est dans le code html plus bas
if(isset($_GET['famille']))
// on retiendra la requête filtrant par la sélection 'famille' du formulaire
$requete="SELECT reference,prix FROM articles WHERE famillesID=".$_GET['famille'];
else
// sinon ce sera celle ci sélectionnant la refence et le prix de la table articles
$requete="SELECT reference,prix FROM articles";

// on prérerera la méthode pdo (à gauche) que mysql (en commentaire à droite) car cette dernière est obsolète
// query interroge la base de données avec les identifiant pdo et l'enregistre dans $resultat
$resultat=$pdo->query($requete);	// $resultat=mysql_query($requete);
$requete2="SELECT ID,intitule FROM familles ";
$resultat2=$pdo->query($requete2);	// $resultat2=mysql_query($requete2);
// avec le code PHP ci dessus rien ne s'affiche, il ne s'agit que de préparation et de sélection information à afficher dans le code HTML ci dessous

// code pour page vue X fois
define('PAGE','index');
$nombre=1;
if(file_exists(PAGE.'.txt'))
{
	$nombre=file_get_contents(PAGE.'.txt');
	if(is_numeric($nombre))
	{
		$nombre++;
	}
}
file_put_contents(PAGE.'.txt',$nombre);

// fin code pour page vue X fois
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- -->
<!-- le DOCTYPE défini la version HTML et les standards respectés ci dessus-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ListeA - liste des articles</title>
</head>

<body>
<br>
<!--formulaire brouillon à ignorer
// <FORM action="listeA.php" method="get">
// Recherche article:
// <INPUT type="text" name="motclef" value="<?php // if(isset($_GET['motclef'])) echo $_GET['motclef'] ?>">
// <br>
// <INPUT type="submit" name="bEnvoyer" value="Envoyer" />
// </FORM>
// <!--fin formulaire -->

<!-- formulaire de sélection de la famille guitare ou accessoire -->
<form id="form1" name="form1" method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<label>Sélectionnez une famille :
		<select name="famille" id="famille">
	<?php while ($familles=$resultat2->fetch()) { ?>	<!-- <?php // while($familles=mysql_fetch_array($resultat2)) { ?> -->
		<option <?php if(!isset($_GET['famille'])) $_GET['famille']=1; if($familles['ID']==$_GET['famille']) echo "selected='selected'"; ?> value="<?php echo $familles['ID']; ?>"><?php echo $familles['intitule']; ?>
		</option>
		<?php } ?>
		</select>
	</label>
	<label>
		<input type="submit" name="boutonEnvoyer" id="boutonEnvoyer" value="Envoyer" />
	</label>
</form>
<!-- fin formulaire -->

<table width="600" border="1" cellspacing="0" cellpadding="5">
  <tr>
    <td>Référence</td>
    <td>Prix</td>
	<td>Voir la fiche</td>
	<td>Supprimer</td>
	<td>Modifier</td>
  </tr>
  <?php while ($articles=$resultat->fetch()) { ?>	  <!-- <?php //while($articles=mysql_fetch_array($resultat))  { ?> -->
  <tr>
    <td><?php echo $articles['reference']; ?></td>
    <td><?php echo $articles['prix']; ?></td>
	<td><a href="ficheA.php?reference=<?php echo $articles['reference'];?>" >Voir</a></td>
<!-- <td><input type="submit" name="boutonSupp" id="boutonSupprimer" value="Supprimer" /></td> -->
	<td><a href="supprimer.php?reference=<?php echo $articles['reference'];?>" >Supprimer</a></td>
	<td><a href="modifier.php?reference=<?php echo $articles['reference'];?>" >Modifier</a></td>
  </tr>
  <?php } ?>
</table>
<a href="articlesAjout.php?>" >Ajouter un article</a></br>
Page vue <?php readfile(PAGE.'.txt'); ?>
</body>
</html>