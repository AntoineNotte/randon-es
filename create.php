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
	<link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Shadows+Into+Light&display=swap" rel="stylesheet"> 
	<link rel="stylesheet" href="css/basics.css" media="screen" title="no title" charset="utf-8">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" media="screen" href="style.css"/>
	</head>
<body>
	<div class="up">
	<h1>Ajouter</h1>
	<div id="conteneur offset-3">
	<form action="#" method="post">
	<div class="form-row">
    <div class="form-group col-md-3 offset-3">
	  <label for="name">Nom</label>
	  
      <input name="name" class="form-control"  value="">
    </div>
    <div class="form-group col-md-3">
      <label for="difficulty">Difficulté</label>
	  <select name="difficulty"  class="form-control">
	  <option value="très facile">Très facile</option>
				<option value="facile">Facile</option>
				<option value="moyen">Moyen</option>
				<option value="difficile">Difficile</option>
				<option value="très difficile">Très difficile</option>
			</select>
	</div>
			</div>
			<div class="form-row">
    <div class="form-group col-md-2 offset-2">
      <label for="distance">Distance</label>
      <input name="distance" type="text" class="form-control" value="">
	</div>
    <div class="form-group col-md-2">
      <label for="duration">Durée</label>
      <input name="duration" type="time" class="form-control" value="" >
    </div>
	<div class="form-group col-md-2">
    <label  for="height_difference">Dénivelé</label>
    <input name="height_difference" type="text" class="form-control" value="">
  </div>
  <div class="form-group col-md-2">
      <label for="available">Available</label>
      <select name="available" id="inputState" class="form-control" name="available">
				<option value="oui">Oui</option>
				<option value="non">Non</option>
		</select>
		</div>
		</div>
		<button class="offset-5" type="submit" name="button"value="valider" name="valider">Envoyer</button>
		<button><a href="read.php">Liste des données</a></button>	
		</form>
</div>
</body>
</html>
<?php

$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');
if (isset($_SESSION['login'])) {
if (isset($_POST['button']))
{
    $result = $bdd->prepare("INSERT INTO hiking(id,name,difficulty,distance,duration,height_difference,available) VALUES(:id,:name,:difficulty,:distance,:duration,:height_difference,:available)");
    $result->execute(array(
        ":id" => $_POST['id'],
        ":name" => $_POST['name'],
        ":difficulty" => $_POST['difficulty'],
        ':distance' => $_POST['distance'],
        ':duration' => $_POST['duration'],
		':height_difference' => $_POST['height_difference'],
		':available'=>$_POST['available']
    ));
    if($result){
        echo "La randonnée a été ajoutée avec succès.";
    }else{
        echo "Not done";
    }
    
}}
?>