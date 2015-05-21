<?php
// session start();
// {
// header("Location:../login.php");	
// }
require_once("connexion.php");
// $connexion=mysql_connect("localhost", "root" , "");
// mysql_select_db("catalogue");

if(isset($_POST['boutonAjouter']))
{
// début vérification que le fichier a bien été enregistré
if($_FILES['photo']['error']==0)
	{
	copy($_FILES['photo']['tmp_name'], "images/".$_FILES['photo']['name']);
	}
// fin vérification que le fichier a bien été enregistré
if($_FILES['photo']['error']==0)
	$requete="INSERT INTO articles SET reference='".$_POST['reference']."',prix='".$_POST['prix']."',designation='".$_POST['designation']."',photo='".$_FILES['photo']['name']."',famillesID='".$_POST['famillesID']."' ";
else
	$requete="INSERT INTO articles SET reference='".$_POST['reference']."',prix='".$_POST['prix']."',designation='".$_POST['designation']."',famillesID='".$_POST['famillesID']."' ";
	
	$resultat=$pdo->query($requete);	// $resultat=mysql_query($requete);

// header("Location:articlesGestion.php");
}
//---------------requête du menu
$requete2="SELECT ID,intitule FROM familles ";
$resultat2=$pdo->query($requete2); // $resultat2=mysql_query($requete2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Ajout dans la base de donnée</title>
</head>

<body>
<!-- <a href="articlesGestion.php?logout=ok"  >Deconnexion</a> -->
<br/>
<form id="monform" name="form1" method="POST" enctype="multipart/form-data" action="articlesAjout.php">
	<p>
		<label>Référence :
		<input type="text" name="reference" />
		</label>
	</p>
	<p>
		<label>Prix :
		<input type="text" name="prix" />
		</label>
	</p>
	<p>
		<label>Désignation :
		<input type="text" name="designation" />
		</label>
	</p>
	<p>
		<label>famillesID :
		<select name="famillesID" id="famillesID" >
			<?php while ($familles=$resultat2->fetch()) { ?>	<!-- <?php // while($familles=mysql_fetch_array($resultat2)) { ?> -->
		<option value="<?php echo $familles['ID']; ?>"><?php echo $familles['intitule']; ?>
		</option>
			<?php } ?>
		</select>
		</label>
	</p>
		<label>Photo :
		<input type="file" name="photo" id="photo" />
		</label>	
	<p>
		<label>
		<input type="submit" name="boutonAjouter" value="Envoyer" />
		</label>
	</p>
</form>
<a href="listeA.php?>" >Retour à la liste</a>
<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>
</body>
</html>