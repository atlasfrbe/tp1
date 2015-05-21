<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Document sans nom</title>
</head>

<body>
<form id="form1" name="form1" enctype="multipart/form-data" method="post" action="telechargementPhoto.php">
	<label>
		<input type="file" name="photo" id="photo" />
	</label>
<p>
	<label>
		<input type="submit" name="bouton" id="Envoyer" />
	</label>	
</p>

<?php
echo "<pre>";
print_r($_FILES);
echo "</pre>";
?>

</body>
</html>