<?php
/**** Supprimer une randonnée ****/
$id=$_GET['index'];
$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');


$delete = $bdd->prepare("DELETE FROM hiking WHERE id=:id");

 if($delete->execute(array(':id' => $id))){
     echo 'réussis';
    
 }
 else{
     echo 'echec'.var_dump($delete->errorInfo());
 }
 header("Location: http://localhost/rando/read.php");