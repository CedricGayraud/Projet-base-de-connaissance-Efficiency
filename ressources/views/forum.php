<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        include 'sidebar.php' ;
    ?>

    <div class="flex justify-center min-h-screen">
        <div class="flex-col bg-white p-8 rounded shadow-lg w-full justify-center max-w-5xl h-full">
            <h1 class="flex text-4xl font-bold mb-4">Forum Efficiency</h1>
            <p class="flex text-gray-600 mb-4">Trouver une solution, ou alors aider quelqu'un à en trouver </p>
            <div class="mb-4 flex">
                <!-- Barre de recherche -->
                <label>
                    <input type="text" placeholder="Rechercher..." class="w-full p-4 border inline-block">
                </label>
                <!--button de recherche qui prend en vompte le label input -->
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M11.76 10.27L17.49 16L16 17.49L10.27 11.76C9.2 12.53 7.91 13 6.5 13C2.91 13 0 10.09 0 6.5C0 2.91 2.91 0 6.5 0C10.09 0 13 2.91 13 6.5C13 7.91 12.53 9.2 11.76 10.27ZM6.5 2C4.01 2 2 4.01 2 6.5C2 8.99 4.01 11 6.5 11C8.99 11 11 8.99 11 6.5C11 4.01 8.99 2 6.5 2Z" fill="white"/>
                    </svg>
                </button>

            </div>

            <h2> - À LA UNE </h2>

            <?php



            ?>

        </div>
    </div>


</body>

</html>