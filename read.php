<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" media="screen" href="style.css"/>
    <title>Document</title>
</head>
<body>
<table>
    
<?php
session_start();
session_start();
if(!isset($_SESSION['login'])) {
    header("Location: ./index.html");
  exit();
}
// On récupère nos variables de session
if (isset($_SESSION['login'])) {

	// On teste pour voir si nos variables ont bien été enregistrées
	echo '<body>';
	echo 'Bonjour '.$_SESSION['login'].'.';
	echo '<br />';

	// On affiche un lien pour fermer notre session
	echo '<a href="./logout.php">Déconnection</a>';
}
else {
	echo 'Les variables ne sont pas déclarées.';
}

echo '    <h1>Liste des rendonnées</h1>';

// On se connecte à MySQL
$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');

        $resultat = $bdd->query('SELECT * FROM hiking');

        echo "<tr>";
        echo "<th>nom</th>";
        echo "<th>difficulté</th> ";
        echo "<th>distance</th>";
        echo "<th>durée</th>";
        echo "<th>height_difference</th> ";
        echo "<th>Pratiquable</th>";

        while ($donnees = $resultat->fetch())
        {     
        echo "<tr>";
            echo   "<td>" .$donnees['name']. "</br>
            <button><a href='update.php?index="
            .$donnees['id']."'> Modifier</a></button>
            <button><a href='delete.php?index="
            .$donnees['id']."'> Supprimer</a></button></td>";
            echo   "<td>" .$donnees['difficulty']."</td>";
            echo   "<td>".$donnees['distance']." m </td>";
            echo   "<td>".$donnees['duration']."</td>";
            echo   "<td>".$donnees['height_difference']." m </td>";
            echo   "<td>".$donnees['available']."</td>";
   
        echo "</tr>";
    };


echo '</table>';
echo '<div id="add"><button ><a class="add" href="create.php">Ajouter</a></button></div>'
?>
</body>
</html>