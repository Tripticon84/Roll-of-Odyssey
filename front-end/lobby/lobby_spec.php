<?php
session_start(); 
include('../script.php'); 

$db = PDOConnect(); // 



$req = $db->prepare('UPDATE PERSONNAGE SET role = 2 WHERE id_uti = :id_uti AND id_partie = :id_partie'); // Update role to spec
$req->execute([
    "id_uti" => $_SESSION["id_uti"],
    "id_partie" => $_SESSION["id_partie"]
]);


?>