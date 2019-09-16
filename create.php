<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: ./index.html");
  exit();
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter une randonnée</title>
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
</head>
<body>
	<a href="read.php">Liste des données</a>
	<h1>Ajouter</h1>
	<form action="#" method="post">
		<div>
			<label for="name">Nom</label>
			<input type="text" name="name" value="">
		</div>
		<div>
			<label for="difficulty">Difficulté</label>
			<select name="difficulty">
				<option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
		</div>
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="time" name="duration" value="">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="">
		</div>
		<div>
			<label for="available">Available</label>
			<select name="available">
				<option value="oui">Oui</option>
				<option value="non">Non</option>
			</select>
		</div>
		<button type="submit" name="button">Envoyer</button>
	</form>
</body>
</html>
<?php

$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');
if (isset($_SESSION['login'])) {
if (isset($_POST['button']))
{
    $result = $bdd->prepare("INSERT INTO hiking(id,name,difficulty,distance,duration,height_difference) VALUES(:id,:name,:difficulty,:distance,:duration,:height_difference)");
    $result->execute(array(
        ":id" => $_POST['id'],
        ":name" => $_POST['name'],
        ":difficulty" => $_POST['difficulty'],
        ':distance' => $_POST['distance'],
        ':duration' => $_POST['duration'],
        ':height_difference' => $_POST['height_difference']
    ));
    if($result){
        echo "La randonnée a été ajoutée avec succès.";
    }else{
        echo "Not done";
    }
    
}}
?>