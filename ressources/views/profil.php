<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require '../Class/user.php';
require '../Controller/userController.php';



$userData = $results[0]; // Vous pouvez choisir l'index approprié en fonction de votre application

$user = new User (
    $userData['id'],
    $userData['nickname'],
    $userData['lastName'],
    $userData['firstName'],
    $userData['email'],
    $userData['role'],
    $userData['rank'],
    $userData['isBanned']
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
</head>

<body>
    <?php include 'sidebar.php' ?>
    <div>
    
  <div class=" flex justify-center px-4 sm:px-0">
    <div class="bg-gray-400 w-24 h-24 rounded-full flex items-center justify-center">
        <!-- Vous pouvez ajouter une icône, une image ou du texte comme contenu de l'avatar -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
    </div>
        
  </div>
        <p class="mt-1 sm:text-center leading-8 text-gray-500"><?php echo $user->getNickName()?></p>
        <p class="mt-1 sm:text-center leading-8 text-gray-500"><?php echo $user->getRank()?></p>
  <div class="mt-6 border-t border-gray-100">
    <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="sm:text-center font-medium leading-6 text-gray-900">Nom</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getLastName()?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="sm:text-center font-medium leading-6 text-gray-900">Prénom</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getFirstName()?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="sm:text-center font-medium leading-6 text-gray-900">Email</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getEmail()?></dd>
      </div>
    
      <div class="flex justify-center">
            <button class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Modifier les informations</button>
            <button type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
        </div>

</body>

</html>
