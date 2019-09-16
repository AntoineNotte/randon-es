<?php
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: ./index.html");
  exit();
}

$id=$_GET['index'];
$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');

$resultat = $bdd->prepare('SELECT * FROM hiking WHERE id=:id');
$resultat->execute(array(':id' => $_GET['index']));




while ($donnees = $resultat->fetch())
{     
	$name = $donnees['name'];
	$difficulty=$donnees['difficulty'];
	$distance=$donnees['distance'];
	$duration=$donnees['duration'];
	$height_difference=$donnees['height_difference'];
	$available=$donnees['available'];

}


if (isset($_POST['button'])){
	$req = $bdd ->prepare('UPDATE hiking SET name=:name, difficulty=:difficulty, 
	distance=:distance, duration=:duration, height_difference=:height_difference ,available=:available
	WHERE id=:id');
	$req->execute(array(
        ":id" => $id,
        ":name" => $_POST['name'],
        ":difficulty" => $_POST['difficulty'],
        ':distance' => $_POST['distance'],
        ':duration' => $_POST['duration'],
		':height_difference' => $_POST['height_difference'],
		':available'=>$_POST['available']
	));
	header('Location: read.php');
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
	<div class="up">
	<h1>Modifier</h1>
	<form action="" method="post">
		<div>
			<label for="name">Name</label>
			<input type="text" name="name" value="<?php echo $name?>">
		</div>
	
		<div>
			<label for="difficulty">Difficulté</label>
			<select value="" name="difficulty">
				<?php 
				$arr = array('très facile','facile','moyen','difficile','très difficile');
				foreach($arr as $value){
					$select="";
					if($value==$difficulty){
						$select="selected";
					}
					echo "<option value ='".$value."'".$select.">".$value."</option>";
				}
			?>
			</select>
		
		</div>
		
		<div>
			<label for="distance">Distance</label>
			<input type="text" name="distance" value="<?php echo $distance?>">
		</div>
		<div>
			<label for="duration">Durée</label>
			<input type="duration" name="duration" value="<?php echo $duration?>">
		</div>
		<div>
			<label for="height_difference">Dénivelé</label>
			<input type="text" name="height_difference" value="<?php echo $height_difference?>">
		</div>
		<div>
			<label for="available">Available</label>
			<select value="" name="available">
				<?php
			$arr = array('oui','non');
				foreach($arr as $value){
					$select="";
					if($value==$available){
						$select="selected";
					}
		
				echo "<option value ='".$value."'".$select.">".$value."</option>";
			}
		?>
		</select>
				</div>
		<button type="submit" name="button"value="valider" name="valider">Envoyer</button>
	</form>
	<a href="read.php">Liste des données</a>
	</div>
</body>
</html>