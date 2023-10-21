<?php
require './session_config.php';
require('../Class/Thematic.php');
require('../Class/Platform.php');
require('../Class/Card.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/x-icon" href="https://image.noelshack.com/fichiers/2023/39/3/1695821591-logo-efficiency.png" />
    <title>Efficiency - Dashboard</title>
</head>

<body>
    <?php
    $sessionUser = User::getSessionUser($bdd);
    $thematics = Thematic::getAllThematics($bdd);
    $platforms = Platform::getAllPlatforms($bdd);
    $cards = Card::getAllCards($bdd); ?>
    <?php include 'sidebar.php' ?>
    <div class="bg-cover bg-center bg-opacity-50 bg-[#2CE6C1] h-auto text-black py-8 px-10 object-fill mr-8 ml-28 mt-5 mb-5 rounded-lg flex">
        <div class="md:w-1/2 pr-4 flex items-center ml-16">
            <div>
                <p class="font-bold text-sm uppercase">Dashboard Admin</p>
                <p class="text-3xl font-bold">Bonjour <?php echo $sessionUser->getNickName() ?></p>
                <p class="text-2xl mb-10 leading-none">Bienvenue dans votre espace de gestion.</p>
            </div>
        </div>
        <div class="w-96">
            <img src="https://image.noelshack.com/fichiers/2023/42/6/1697877626-undraw-software-engineer-re-tnjc.png" class="w-full">
        </div>
    </div>


    <div x-data="{ activeTab: 1 }" class="md:ml-28 md:mr-8">
        <ul class="flex justify-center space-x-4">
            <li x-on:click="activeTab = 1" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 1, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 1 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Fiches
            </li>
            <li x-on:click="activeTab = 2" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 2, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 2 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Thématiques
            </li>
            <li x-on:click="activeTab = 3" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 3, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 3 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Platformes
            </li>
            <li x-on:click="activeTab = 4" :class="{ 'bg-[#2CE6C1] text-white shadow-md cursor-pointer': activeTab === 4, 'bg-white text-black shadow-md cursor-pointer': activeTab !== 4 }" class="hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-lg w-full sm:w-auto px-5 py-2.5 text-center">
                Bannis
            </li>
        </ul>
        <div x-show="activeTab === 1">
            <!-- Fiches -->
            <div class="container mx-auto mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    <?php foreach ($cards as $card) : ?>
                        <a href="fiche.php?fiche=<?= $card->getID(); ?>" class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                            <div class="flex flex-col items-center">
                                <h2 class="text-lg font-semibold text-gray-800"><?= $card->getTitle(); ?></h2>
                                <p class="text-gray-500">Le <?= formatDate($card->getCreatedDate()); ?> par <?= $card->getUser()->getNickname(); ?></p>
                            </div>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div x-show="activeTab === 2">
            <!-- Thématiques -->
            <div class="container mx-auto mt-8">
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    <?php foreach ($thematics as $thematic) : ?>
                        <div class="rounded-lg overflow-hidden shadow-md p-4 bg-[<?= $thematic->getColor(); ?>] transition-transform transform hover:translate-y-1">
                            <h2 class="text-lg font-semibold text-white"><?= $thematic->getName(); ?></h2>
                            <p class="text-white text-sm"><?= $thematic->getDescription(); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="flex ml-auto mr-12">
                <a href="/ressources/views/creation_fiche.php">
                    <button class="fixed rounded-full border-2 border-white w-20 h-20 bg-[#2CE6C1] text-white hover:text-[#2CE6C1] border-[3px] border-[#2CE6C1] hover:bg-white duration-500">
                        <span class="material-symbols-outlined" style="font-size: 48px;">add</span>
                    </button>
                </a>
            </div>
        </div>
        <div x-show="activeTab === 3">
            <!-- Plateformes -->
            <div class="container mx-auto mt-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                    <?php foreach ($platforms as $platform) : ?>
                        <div class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1">
                            <div class="flex flex-col items-center">
                                <img src="<?= $platform->getImg(); ?>" alt="<?= $platform->getName(); ?>" class="w-16 h-16 mb-2">
                                <h2 class="text-lg font-semibold text-gray-800"><?= $platform->getName(); ?></h2>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="flex ml-auto mr-12">
                <a href="/ressources/views/creation_fiche.php">
                    <button class="fixed rounded-full border-2 border-white w-20 h-20 bg-[#2CE6C1] text-white hover:text-[#2CE6C1] border-[3px] border-[#2CE6C1] hover:bg-white duration-500">
                        <span class="material-symbols-outlined" style="font-size: 48px;">add</span>
                    </button>
                </a>
            </div>
        </div>
        <div x-show="activeTab === 4">
            Contenu de l'onglet 4
        </div>
    </div>

</body>

</html>