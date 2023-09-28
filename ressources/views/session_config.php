<?php
session_start();
//connection à la bdd
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');

$affich_users = $bdd->prepare('SELECT * FROM users');
$affich_users->execute(array());
$affichage = $affich_users->fetch();
