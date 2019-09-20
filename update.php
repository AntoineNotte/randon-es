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
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Shadows+Into+Light&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" media="screen" href="style.css"/>
</head>
<body>
	<div class="up">
	<h1>Modifier</h1>
	<div id="conteneur offset-3">

	<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-3 offset-3">
	  <label for="name">Nom</label>
	  
      <input name="name" class="form-control" id="inputEmail4" value="<?php echo $name?>">
    </div>
    <div class="form-group col-md-3">
      <label for="difficulty">Difficulté</label>
	  <select name="difficulty" id="inputState" class="form-control">
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
			</div>
			<div class="form-row">
    <div class="form-group col-md-2 offset-2">
      <label for="distance">Distance</label>
      <input name="distance" type="text" class="form-control" id="inputCity"value="<?php echo $distance?>">
	</div>
    <div class="form-group col-md-2">
      <label for="duration">Durée</label>
      <input name="duration" type="text" class="form-control" id="inputCity"value="<?php echo $duration?>" >
    </div>
	<div class="form-group col-md-2">
    <label  for="height_difference">Dénivelé</label>
    <input name="height_difference" type="text" class="form-control" id="inputAddress"value="<?php echo $height_difference?>">
  </div>
  <div class="form-group col-md-2">
      <label for="available">Available</label>
      <select name="available" id="inputState" class="form-control" name="available">>
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
		</div>
		<button class="offset-5" type="submit" name="button"value="valider" name="valider">Envoyer</button>
		<button><a href="read.php">Liste des données</a></button>	
		</form>
		


		</div>
	
</body>
</html>