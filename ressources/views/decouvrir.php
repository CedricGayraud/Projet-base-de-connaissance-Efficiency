<?php
require './session_config.php';
require('../Class/Thematic.php');
require('../Class/Platform.php');
require('../Class/Card.php');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Efficiency - Découvrir</title>
</head>

<?php include 'sidebar.php' ?>

<body>

    <?php $thematics = Thematic::getAllThematics($bdd);
    $platforms = Platform::getAllPlatforms($bdd);
    $cards = Card::getAllCardsVerify($bdd);
    ?>

    <div x-data="{ selectedThematic: null, selectedPlatform: null }" class="md:ml-28 md:mr-8">
        <!-- Thématiques -->
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold">Thématiques</h1>
            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <?php foreach ($thematics as $thematic) : ?>
                    <div x-on:click="selectedThematic === <?= $thematic->getId(); ?> ? selectedThematic = null : selectedThematic = <?= $thematic->getId(); ?>" :class="{ 'border-4 border-[#2CE6C1]': selectedThematic === <?= $thematic->getId(); ?> }" class="rounded-lg overflow-hidden shadow-md p-4 bg-[<?= $thematic->getColor(); ?>] transition-transform transform hover:translate-y-1 cursor-pointer">
                        <h2 class="text-lg font-semibold text-white"><?= $thematic->getName(); ?></h2>
                        <p class="text-white text-sm"><?= $thematic->getDescription(); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Plateformes -->
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold">Plateformes</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mt-4">
                <?php foreach ($platforms as $platform) : ?>
                    <div x-on:click="selectedPlatform === <?= $platform->getId(); ?> ? selectedPlatform = null : selectedPlatform = <?= $platform->getId(); ?>" :class="{ 'border-4 border-[#2CE6C1]': selectedPlatform === <?= $platform->getId(); ?> }" class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                        <div class="flex flex-col items-center">
                            <img src="<?= $platform->getImg(); ?>" alt="<?= $platform->getName(); ?>" class="w-16 h-16 mb-2">
                            <h2 class="text-lg font-semibold text-gray-800"><?= $platform->getName(); ?></h2>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Fiches filtrées -->
        <div class="container mx-auto mt-8">
            <h1 class="text-2xl font-bold">Fiches</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <?php foreach ($cards as $card) : ?>
                    <a href="fiche.php?fiche=<?= $card->getID(); ?>" x-show="(selectedThematic === null || selectedThematic === <?= $card->getThematic(); ?>) && (selectedPlatform === null || selectedPlatform === <?= $card->getPlatform(); ?>)" class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                        <div class="flex flex-col items-center">
                            <h2 class="text-lg font-semibold text-gray-800"><?= $card->getTitle(); ?></h2>
                            <p class="text-gray-500">Le <?= CARD::formatDate($card->getCreatedDate()); ?> par <?= $card->getUser()->getNickname(); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</body>

</html>