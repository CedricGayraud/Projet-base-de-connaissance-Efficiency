<?php
require('./layout.php');
require('ressources/Class/Thematic.php');
require('ressources/Class/Platform.php');
require('ressources/Class/Card.php');

$thematics = Thematic::getAllThematics($bdd);
$platforms = Platform::getAllPlatforms($bdd);
$cards = Card::getAllCards($bdd);
?>

<head>

    <style>
        .swiper {
            width: 100%;
            height: fit-content;
            background-color: #2CE6C1;
        }

        .swiper-slide {
            width: 40% !important;
            text-align: center;
            font-size: 18px;
            align-items: center;
            margin: 0px 35px 0px 35px;
            cursor: pointer;
        }

        .swiper-button-next {
            color: white;
            right: 10px;
        }

        .swiper-button-prev {
            color: white;
            left: -2px;
        }

        @media (max-width: 760px) {
            .swiper-button-next {
                right: 20px;
                transform: rotate(90deg);
            }

            .swiper-button-prev {
                left: 20px;
                transform: rotate(90deg);
            }
        }

        .custom-button {
            background-color: white;
            color: #2CE6C1;
            border: 2px solid transparent;
            border-image: linear-gradient(to right, #31ABFF, #2ce6c1);
            border-image-slice: 1;
            padding: 0.6rem 1rem;
            margin-top: 20px;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
        }

        .custom-button:hover {
            background-color: linear-gradient(to right, #3b82f6, #10b981);
            color: black;
            border: 2px solid black;
        }
    </style>
</head>


<div class="h-screen w-full bg-cover bg-top py-8" style="background-image: url(https://img.freepik.com/photos-gratuite/conception-cerveau-cyborg-complexe-carte-circuit-imprime-rougeoyante-generee-par-ia_188544-36674.jpg?w=1380&t=st=1695627849~exp=1695628449~hmac=26ff3873ed29d02e4ba0525da3b591c98887a56f444c9cc325004c886b32ab4b)">
    <div class="ml-32 mr-12">
        <div class="w-7/12 flex flex-wrap my-12">
            <h1 class="text-[#2CE6C1] text-7xl font-semibold">Votre hub communautaire</h1>
            <h1 class="text-slate-50 text-7xl font-semibold">pour l'automatisation de la connaissance.</h1>
        </div>

        <p class="text-slate-50 text-2xl w-7/12 my-12">Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte</p>

        <div class="flex my-6">
            <a href="" class="w-fit p-3 h-16 bg-[#2CE6C1] border-[3px] border-[#2CE6C1] text-white text-lg text-center flex justify-center items-center mr-6 rounded-full font-semibold hover:bg-white hover:text-[#2CE6C1] duration-500">
                <button class=""> Découvrir les thématiques</button>
            </a>
            <a href="" class="w-fit p-3 h-16 text-[#2CE6C1] border-[3px] border-white bg-white text-lg text-center flex justify-center items-center mx-6 rounded-full font-semibold hover:bg-[#2CE6C1] hover:text-white duration-500">
                Découvrir les plateformes
            </a>
            <div class="flex ml-auto mr-12">
                <a href="/ressources/views/creation_fiche.php">
                    <button class="fixed rounded-full border-2 border-white w-20 h-20 bg-[#2CE6C1] text-white hover:text-[#2CE6C1] border-[3px] border-[#2CE6C1] hover:bg-white duration-500">
                        <span class="material-symbols-outlined" style="font-size: 48px;">add</span>
                    </button>
                </a>
            </div>

        </div>


    </div>
</div>

<div class="mx-40">

    <form action="" method="post" class="flex items-center m-auto w-3/4 h-[52px] w-[90%] sm:w-[500px] bg-white rounded-full border-[#31ABFF] border-2 my-16">
        <input type="text" class="text-gray-900 text-lg rounded-full w-full pl-2 p-2.5 focus:outline-none" placeholder="Rechercher une fiche">
        <button type="submit" class="p-2.5 text-lg font-medium text-white bg-[#31ABFF] border-2 border-[#31ABFF] rounded-full border hover:border-2 hover:border-[#31ABFF] hover:bg-[#BAE1FE]">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </button>
    </form>

    <div class="my-20">

        <p class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">À la une</p>



        <div class="flex justify-center">

            <?php foreach ($cards as $card) : ?>
                <a href="fiche.php?fiche=<?= $card->getID(); ?>" x-show="(selectedThematic === null || selectedThematic === <?= $card->getThematic(); ?>) && (selectedPlatform === null || selectedPlatform === <?= $card->getPlatform(); ?>)" class="bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                    <div class="rounded-md mx-2 text-center border-2 cursor-pointer transform transition-transform duration-300 hover:scale-110">
                        <h2 class="text-lg font-semibold text-gray-800"><?= $card->getTitle(); ?></h2>
                        <p class="text-gray-500">Le <?= formatDate($card->getCreatedDate()); ?> par <?= $card->getUser()->getNickname(); ?></p>
                    </div>
                </a>
            <?php endforeach; ?>


        </div>

    </div>
</div>



<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#2ce6c1" fill-opacity="1" d="M0,32L48,42.7C96,53,192,75,288,112C384,149,480,203,576,197.3C672,192,768,128,864,138.7C960,149,1056,235,1152,229.3C1248,224,1344,128,1392,80L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</svg>

<div class="bg-[#2CE6C1]">
    <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="w-fit m-auto text-3xl  font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-white">Thématiques</h2>
            <p class="mt-4 text-gray-900 text-lg">As a digital creative, your laptop or tablet is at the center of your work. Keep your device safe with a fabric sleeve that matches in quality and looks.</p>
        </div>

        <div class="mt-16 space-y-16">

            <div class="flex justify-center">
                <div class="flex lg:row-start-1 lg:col-span-7 xl:col-span-8 lg:col-start-6 xl:col-start-5">
                    <div class="aspect-w-5 aspect-h-2 overflow-hidden rounded-lg bg-gray-100 max-w-3xl">

                        <div class="swiper">
                            <div class="swiper-wrapper rounded-md">

                                <?php foreach ($thematics as $thematic) : ?>
                                    <div class="swiper-slide rounded-md rounded-lg overflow-hidden shadow-md p-4 bg-[<?= $thematic->getColor(); ?>] transition-transform transform hover:translate-y-1 cursor-pointer">
                                        <h2 class="text-lg font-semibold text-white"><?= $thematic->getName(); ?></h2>
                                        <p class="text-white text-sm"><?= $thematic->getDescription(); ?></p>
                                    </div>
                                <?php endforeach; ?>

                                <!-- <div class="swiper-wrapper rounded-md">
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" class="" alt="">
                                </div>
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                </div>
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                </div>
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                </div>
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                </div>
                                <div class="swiper-slide rounded-md">
                                    <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                </div> -->

                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>


                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#2ce6c1" fill-opacity="1" d="M0,32L48,42.7C96,53,192,75,288,112C384,149,480,203,576,197.3C672,192,768,128,864,138.7C960,149,1056,235,1152,229.3C1248,224,1344,128,1392,80L1440,32L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>

        <div class="mx-auto max-w-3xl text-center">
            <h2 class="w-fit m-auto text-3xl  font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">Partagez Vos Idées d'Automatisation </h2>
            <p class="mt-4 text-gray-900 text-lg">Découvrez, partagez et innovez sur notre forum. Vos idées peuvent façonner le futur de l'automatisation informatique.</p>
            <button class="custom-button">
                Accéder au Forum
            </button>

        </div>
    </div>

    <div class="bg-white">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#2CE6C1" fill-opacity="1" d="M0,192L60,208C120,224,240,256,360,234.7C480,213,600,139,720,138.7C840,139,960,213,1080,218.7C1200,224,1320,160,1380,128L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
        <div class="bg-[#2CE6C1]">

            <div class="mx-auto max-w-2xl py-24 px-4 sm:px-6 sm:py-12 lg:max-w-7xl lg:px-8">

                <div class="mx-auto max-w-3xl text-center">
                    <h2 class="w-fit m-auto text-3xl  font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-white">Plateformes</h2>
                    <p class="mt-4 text-gray-900 text-lg">As a digital creative, your laptop or tablet is at the center of your work. Keep your device safe with a fabric sleeve that matches in quality and looks.</p>
                </div>

                <div class="flex justify-center mt-16">

                    <div class="flex lg:row-start-1 lg:col-span-7 xl:col-span-8 lg:col-start-6 xl:col-start-5">
                        <div class="aspect-w-5 aspect-h-2 overflow-hidden rounded-lg bg-gray-100 max-w-3xl">

                            <div class="swiper">
                                <div class="swiper-wrapper rounded-md">

                                    <?php foreach ($platforms as $platform) : ?>
                                        <div class="swiper-slide rounded-md bg-white rounded-lg overflow-hidden shadow-md p-4 transition-transform transform hover:translate-y-1 cursor-pointer">
                                            <div class="flex flex-col items-center">
                                                <img src="<?= $platform->getImg(); ?>" alt="<?= $platform->getName(); ?>" class="w-16 h-16 mb-2">
                                                <h2 class="text-lg font-semibold text-gray-800"><?= $platform->getName(); ?></h2>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <!--  <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" class="" alt="">
                                    </div>
                                    <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                    </div>
                                    
                                    <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                    </div>
                                    <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                    </div>
                                    <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                    </div>
                                    <div class="swiper-slide rounded-md">
                                        <img src="https://img.freepik.com/photos-gratuite/jeune-adulte-posant-lunettes-futuristes-generees-par-ia_188544-19658.jpg?w=1380&t=st=1695388214~exp=1695388814~hmac=365a3864aa600d92051b8422a858023f1763639ce83c7a5345e20f0187328929" alt="">
                                    </div> -->

                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#2ce6c1" fill-opacity="1" d="M0,192L48,202.7C96,213,192,235,288,245.3C384,256,480,256,576,240C672,224,768,192,864,170.7C960,149,1056,139,1152,160C1248,181,1344,235,1392,261.3L1440,288L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
        </svg>

    </div>
</div>

</div>
</div>
>


<script>
    var swiper = new Swiper('.swiper', {
        slidesPerView: 2,
        direction: getDirection(),
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        on: {
            resize: function() {
                swiper.changeDirection(getDirection());
            },
        },
    });

    function getDirection() {
        var windowWidth = window.innerWidth;
        var direction = window.innerWidth <= 760 ? 'vertical' : 'horizontal';

        return direction;
    }
</script>