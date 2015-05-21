<?php include ('connexion.php'); ?> <!--connexion a la base de donnees-->
<!doctype html>

<html>
<head>  
<meta charset="utf-8"/>
<title>Modifier</title>
</head>
<body style="background:#6FD22D"
span style="color:#FE2E64">


<?php
if (isset($_POST['bAnnuler']))
	{
	header('Location: listeA.php'); 
	}

if(isset($_GET['reference'])) //verification que la reference a bien été envoyée
{
$reference=$_GET['reference']; //recuperation de la référence article

// echo "L'entrée que vous voulez modifié concerne la ".$reference;//rappel de la reference de l'objet a modifié

$req = $pdo->prepare('SELECT * FROM articles INNER JOIN familles ON articles.famillesID=familles.ID WHERE reference="'.$_GET['reference'].'"') or die (print_r($pdo->errorInfo()));//requete de selection
$req->execute();
$donnees = $req->fetch();
	
$prix =($donnees['prix']);
$designation =($donnees['designation']);
$famillesID =($donnees['famillesID']);
$photo=($donnees['photo']);

?>
<!--affichage du formulaire des données a modifier -->
<form id="monform" name="form" method="POST" enctype="multipart/form-data" action="modifier.php">
<table border="1" >

<tr><td>Référence:</td><td><input type="text" name="reference" value="<?php echo $reference; ?>"size="40"  /></td></tr>
<tr><td>Prix:</td><td><input type="text" name="prix" value="<?php echo $prix; ?>" size="15" /></td></tr>
<tr><td>Désignation:</td><td><input type="text" name="designation" value="<?php echo $designation; ?>" size="40" /></td></tr>

<?php
// requete pour choix de famille par intitule
$requeteselect2="SELECT ID,intitule FROM familles";
$resultatselect2=$pdo->query($requeteselect2);	// $resultat2=mysql_query($requete2);
?>
<tr>
    <td>Famille</td>
    <td>Ancienne valeur: <b><?php echo $donnees['intitule']; ?></b> , sélectionnez la nouvelle: 
	<select name="famillesID" id="famillesID" >
			<?php while ($familles=$resultatselect2->fetch()) { ?>
		<option value="<?php echo $familles['ID']; ?>"><?php echo $familles['intitule']; ?>	</option>
			<?php } ?>
		</select></td>
</tr>

<tr><td>Photo:</td><td><input type="file" name="photo" id="photo" value="<?php echo $photo ?>"/></td></tr>
<tr><td><input type="hidden" name="reference" value="<?php echo $reference;?>"></td></tr>
</table>

<input type="submit"  name="bModifier" value="Modifier" /> 

<input type="reset"  name="bReset" value="Reinitialiser" />

<input type="submit"  name="bAnnuler" value="Annuler et retour à la liste" />

<?php
}

if(isset($_POST['bModifier'])) // si vous avez appuyé sur le bouton Modifier
{
	// verification d'enregistrement du fichier
	if($_FILES['photo']['error']==0) // si le téléchargement est correct et sans erreur
		{
		copy( $_FILES['photo']['tmp_name'], "images/".$_FILES['photo']['name']); //creation d'une copie du fichier
		//}
	// requete d'insertion de l'image dans la base de données
//	if($_FILES['photo']['error']==0)
		//{
		$pdo->exec("UPDATE articles SET reference='".$_POST['reference']."',prix='".$_POST['prix']."',
		designation='".$_POST['designation']."',famillesID='".$_POST['famillesID']."',
		Photo='".$_FILES['photo']['name']."' WHERE reference='".$_POST['reference']."'");
		}
	else //sinon requete sans l'image
		{
		$pdo->exec("UPDATE articles SET reference='".$_POST['reference']."',prix='".$_POST['prix']."',
		designation='".$_POST['designation']."',famillesID='".$_POST['famillesID']."' WHERE reference='".$_POST['reference']."'");
		}
	if(isset($pdo))
	{
		echo '<br>La modification a été effectuée.</br>';
	}			
	else
		{
		echo 'La modification a échouée' ;
		}
}


echo"<pre>";
print_r($_FILES);
echo"</pre>";
?>
<br><br>
<!-- <a href="listeA.php">Retour à la liste</a> --> 
</body>
</html>
