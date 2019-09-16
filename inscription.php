<?php
$bdd = new PDO('mysql:host=localhost;dbname=reunion_island;charset=utf8;', 'root', 'password');

if (isset($_POST['boutton'])){
    if($_POST['pwd'] == $_POST['confpwd']){
$result = $bdd->prepare("INSERT INTO user(id,login,password) VALUES(:id,:login,:password)");
$result->execute(array(
    ":id" => $_POST['id'],
    ":login" => $_POST['login'],
    ":password" => sha1($_POST['pwd']),
));
    }
    else{
      echo 'echec';
    }
// if($result){
//     echo "La randonnée a été ajoutée avec succès.";
// }else{
//     echo "Not done";
// }
// }
}
?>