<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require './session_config.php';
require('../Class/Card.php');

if (isset($_POST['create_card'])) {
    echo "<script>alert(\"début post\")</script>";
    $title = $_POST['cardTitle'];
    $contentText = $_POST['cardContent'];
    $gitHub = $_POST['cardGitHub'];
    $summary = $_POST['cardSummary'];
    $user = $_POST['user'];
    $platform = $_POST['cardPlateforme'];
    $thematic = $_POST['cardTheme'];
    $img = $_POST['cardImg'];
    Card::createCard($title, $contentText, $gitHub, $summary, $user, $thematic, $platform, $img);

    header("Location: decouvrir.php");
    exit;
}
