<?php
require './session_config.php';
require('../Class/Thematic.php');
require('../Class/Platform.php');


//Creation d'une platforme
if (isset($_POST['create_platform'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = $_POST['img'];

    Platform::createPlatform($name, $description, $link, $img);

    header("Location: dashboard.php");
    exit;
}

//Supression d'une platforme
if (isset($_POST['delete_platform'])) {
    $platformId = $_POST['platform_id'];

    Platform::deletePlatform($platformId);

    header("Location: dashboard.php");
    exit;
}

//Mise à jour d'une platforme
if (isset($_POST['update_platform'])) {
    $platformId = $_POST['platform_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $link = $_POST['link'];
    $img = $_POST['img'];

    Platform::editPlatform($platformId, $name, $description, $link, $img);

    header("Location: dashboard.php");
    exit;
}

//Création d'une thématique
if (isset($_POST['create_thematic'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $color = $_POST['color'];

    Thematic::createThematic($name, $description, $color);

    header("Location: dashboard.php");
    exit;
}

//Supression d'une thématique
if (isset($_POST['delete_thematic'])) {
    $thematicId = $_POST['thematic_id'];

    Thematic::deleteThematic($thematicId);

    header("Location: dashboard.php");
    exit;
}

//Mise à jour d'une thématique
if (isset($_POST['update_thematic'])) {
    $thematicId = $_POST['thematic_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $color = $_POST['color'];

    Thematic::editThematic($thematicId, $name, $description, $color);

    header("Location: dashboard.php");
    exit;
}
