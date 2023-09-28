<?php
require($_SERVER['DOCUMENT_ROOT'] . '/layout.php');
require '../Class/user.php';
require '../Controller/userController.php';



$userData = $results[0]; // Vous pouvez choisir l'index approprié en fonction de votre application

$user = new User (
    $userData['id'],
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
  <div class="px-4 sm:px-0 justify-center">
    <h3 class="sm:text-center font-semibold leading-7 text-gray-900">Avatar*</h3>
    <p class="mt-1 sm:text-center leading-6 text-gray-500"><?php echo $user->getLastName()?>.<?php echo $user->getFirstName()?></p>
    <span class="inline-flex items-center rounded-md bg-purple-50 px-2 py-1 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10"><?php echo $user->getRank()?></span>
  </div>
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
