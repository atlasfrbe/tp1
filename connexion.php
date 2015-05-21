<?php
//$connexion=mysql_connect("localhost", "root" , "");
//mysql_select_db("catalogue");
try
{
$pdo = new PDO('mysql:host=localhost;dbname=catalogue', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}
?>