<?php
require('./layout.php');
require('ressources/Class/Thematic.php');
require('ressources/Class/Platform.php');
require('ressources/Class/CardLike.php');

$thematics = Thematic::getAllThematics($bdd);
$platforms = Platform::getAllPlatforms($bdd);
$cards = Card::getAllCards($bdd);
$mostLiked = Card::getCardByLike($bdd);
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
            right: 0px;
        }

        .swiper-button-prev {
            color: white;
            left: 0px;
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

        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            left: -5px;
            margin: auto;
            width: 105%;
            height: 264px;
            border-radius: 10px;
            background: linear-gradient(-45deg, #364BFF 0%, #2CE6C1 100%);
            z-index: -10;
            pointer-events: none;
            transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }


        .card:hover::before {
            transform: rotate(-90deg) scaleX(1.34) scaleY(0.77);
        }
    </style>
</head>


<div class="h-screen w-full bg-contain bg-top py-8" style="background-image: url(https://cdn.discordapp.com/attachments/889843132949213214/1169284109877653675/rocket-volant-dans-espace.jpg?ex=6554d7b0&is=654262b0&hm=3c8ecb2144e2e30d96ff1b92da2f6ed0582328cb35cf3bac4cef52410bbe67c3&)">
    <div class="ml-32 mr-12">
        <div class="w-7/12 flex flex-wrap my-12">
            <h1 class="text-[#2CE6C1] text-7xl font-semibold">Votre hub communautaire</h1>
            <h1 class="text-slate-50 text-7xl font-semibold">pour l'automatisation de la connaissance.</h1>
        </div>

        <p class="text-slate-50 text-2xl w-7/12 my-12">How to mate est une plateforme communautaire qui simplifie les tâches informatiques en permettant aux utilisateurs de créer et de consulter des fiches de scripts pour divers logiciels. Rejoignez notre communauté pour faciliter vos opérations informatiques.</p>

        <div class="flex my-6">
            <a href="/ressources/views/decouvrir.php" class="w-fit p-3 h-16 bg-[#2CE6C1] border-[3px] border-[#2CE6C1] text-white text-lg text-center flex justify-center items-center mr-6 rounded-full font-semibold hover:bg-white hover:text-[#2CE6C1] duration-500">
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

    <p class="w-fit mx-auto mb-6 mt-10 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">Rechercher une fiche</p>

    <div class="relative z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-center">
                <div class="w-full bg-white rounded-lg" x-data="dropdownCards()" x-init="$watch('card', () => selectedCardIndex='')">
                    <div>
                        <div class="flex items-center shadow-lg rounded-lg border border-gray-200 p-1">
                            <svg class="text-gray-400 h-7 w-7 fill-current cursor-pointer" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve" width="512px" height="512px">
                                <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                            <input type="text" class="text-gray-900 text-lg rounded-full w-full pl-2 p-2.5 focus:outline-none " placeholder="Rechercher une fiche" x-model="card" x-on:click.outside="reset()" x-on:keyup.escape="reset()" x-on:keyup.down="selectNextCard" x-on:keyup.up="selectPreviousCard" x-on:keyup.enter="goToUrl()">
                        </div>
                        <div class="shadow-lg rounded-md border mt-1 overflow-y-auto bg-white" x-show="filteredCards.length > 0" x-transition x-ref="cards">
                            <template x-for="(card, index) in filteredCards">
                                <button x-text="card.title" class="px-4 py-2 block w-full text-left hover:bg-gray-200 border-b border-[#2CE6C1]" :class="{ 'bg-gray-100 outline-none': index === selectedCardIndex }" x-on:click.prevent="goToUrl(card)"></button>
                            </template>
                        </div>
                        <div class="mt-1 px-4 py-2 block shadow-gray-50 rounded-md border bg-white" x-show="card !== '' && filteredCards.length === 0">
                            pas de résultat
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="my-20">
        <p class="w-fit mx-auto mb-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-[#2CE6C1]">À la une</p>



        <div class="flex justify-center">

            <?php foreach ($mostLiked as $card) : ?>
                <div class="card relative w-[190px] h-[254] bg-white justify-between flex flex-col p-3 cursor-pointer rounded-md mx-6">
                    <a href="/ressources/views/fiche.php?fiche=<?= $card->getId(); ?>" class="">
                        <h2 class="text-lg font-semibold text-gray-800 mb-4 h-20"><?= $card->getTitle(); ?></h2>
                    </a>
                    <a class="flex items-center border-b-2 border-[#2CE6C1] pb-2" href="ressources/views/profil.php">
                        <img class="h-10 w-10 rounded-full bg-gray-50 mr-3" src="<?= $card->getUser()->getProfilPicture(); ?>" alt="">
                        <p class="text-xl"><?= $card->getUser()->getNickname(); ?></p>
                    </a>
                    <div class="flex justify-between">
                        <div class="flex">
                            <svg class="w-6 h-6 mr-1 fill-current text-red-500" viewBox="0 0 20 20">
                                <path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" fill-rule="evenodd"></path>
                            </svg>
                            <p class="text-lg"><?php echo CardLike::getAllLikesByCardId($card->getId()); ?></p>
                        </div>
                        <p class="text-end font-semibold"><?= formatDate($card->getCreatedDate()); ?></p>
                    </div>
                </div>
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
                                    <div class="swiper-slide bg-white p-2 rounded-md relative overflow-hidden text-[<?= $thematic->getColor(); ?>] transition-all duration-500 ease-in-out shadow-md hover:scale-105 hover:shadow-lg before:absolute before:top-0 before:-left-full before:w-full before:h-full before:bg-gradient-to-r before:from-[<?= $thematic->getColor(); ?>] before:to-[<?= $thematic->getColor(); ?>] before:transition-all before:duration-500 before:ease-in-out before:z-[-1] hover:before:left-0 hover:text-white swiper-slide-active">
                                        <h2 class="text-lg font-semibold"><?= $thematic->getName(); ?></h2>
                                        <p class="text-sm"><?= $thematic->getDescription(); ?></p>
                                    </div>
                                <?php endforeach; ?>

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
                                        <div class="swiper-slide px-5 py-2.5 relative rounded group font-medium text-white inline-block swiper-slide-active" style="width: 384px;" role="group" aria-label="1 / 6">
                                            <span class="absolute top-0 left-0 w-full h-full rounded opacity-50 filter blur-sm bg-gradient-to-br from-[#31ABFF] to-[#364BFF]"></span>
                                            <span class="absolute inset-0 w-full h-full transition-all duration-200 ease-out rounded shadow-xl bg-gradient-to-br filter group-active:opacity-0 group-hover:blur-sm from-[#31ABFF] to-[#364BFF]"></span>
                                            <span class="absolute inset-0 w-full h-full transition duration-200 ease-out rounded bg-gradient-to-br from-[#31ABFF] to-[#364BFF]"></span>
                                            <div class="flex flex-col items-center">
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/af/Adobe_Photoshop_CC_icon.svg/langfr-220px-Adobe_Photoshop_CC_icon.svg.png" alt="Photoshop" class="relative w-16 h-16 mb-2">
                                                <h2 class="relative text-lg font-semibold text-gray-800">Photoshop</h2>
                                            </div>
                                        </div>

                                    <?php endforeach; ?>

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

    function dropdownCards() {
        return {
            card: "",
            selectedCardIndex: "",
            cards: <?php echo json_encode($cards); ?>,


            get filteredCards() {
                if (this.card === "") {
                    return [];
                }

                return this.cards.filter(card => card.title.toLowerCase().includes(this.card.toLowerCase()))
            },

            reset() {
                this.card = "";
            },

            selectNextCard() {
                if (this.selectedCardIndex === "") {
                    this.selectedCardIndex = 0;
                } else {
                    this.selectedCardIndex++;
                }

                if (this.selectedCardIndex === this.filteredCards.length) {
                    this.selectedCardIndex = 0;
                }

                this.focusSelectedCard();
            },

            selectPreviousCard() {
                if (this.selectedCardIndex === "") {
                    this.selectedCardIndex = this.filteredCards.length - 1;
                } else {
                    this.selectedCardIndex--;
                }

                if (this.selectedCardIndex < 0) {
                    this.selectedCardIndex = this.filteredCards.length - 1;
                }

                this.focusSelectedCard();
            },

            focusSelectedCard() {
                this.$refs.cards.children[this.selectedCardIndex + 1].scrollIntoView({
                    block: 'nearest'
                })
            },

            goToUrl(card) {
                let currentCard = card ? card : this.filteredCards[this.selectedCardIndex];

                window.location = `ressources/views/fiche.php?fiche=${currentCard.id}`;
            },
        };
    }
</script>