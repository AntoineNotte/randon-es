<?php

     session_start();
     $bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;','root','password');
    $req = $bdd->prepare('SELECT * FROM user WHERE login = :login');
    $req->execute(array(
        'login' => $_POST['login']));
    $resultat = $req->fetch();
        $login=$_POST['login'];

    if (isset($resultat) && !empty($resultat)) {
        $isPasswordCorrect = sha1($_POST['pwd']) === $resultat['password']; 
        if ($isPasswordCorrect) {
            $_SESSION['login'] = $login;
            header('Location: read.php');
            exit();
        }
        else {
            echo 'Mauvais identifiant ou mot de passe !';
        }
    } else {
        echo 'Mauvais identifiant ou mot de passe !';
    }

?>