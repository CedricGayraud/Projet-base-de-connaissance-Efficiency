<?php
   require '../Class/user.php';
   require '../Controller/userController.php';
   require './session_config.php';
   
   
   
   
   $userData = getSessionUser();
   
   $user = new user (
       $userData['id'],
       $userData['nickname'],
       $userData['lastName'],
       $userData['firstName'],
       $userData['email'],
       $userData['role'],
       $userData['rank'],
       $userData['isBanned'],
       $userData['profilPicture'],
       $userData['createdDate']
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
        <!-- Avatar et modification d'avatar -->
         <div class="flex justify-center mt-12 px-4 sm:px-0 relative" x-data="{ showModal: false }">
            <div class="bg-gray-400 w-24 h-24 rounded-full flex items-center justify-center">
               <!-- Avatar actuel -->
               <img src=<?= $affichage['profilPicture']?> alt="Avatar" class="flex w-24 h-24 rounded-full flex items-center justify-center cursor-pointer" x-on:click="showModal = true">
               <!-- Bouton pour téléverser l'image -->
               <label class="flex justify-center mt-12 px-4 sm:px-0 relative cursor-pointer"></label>
               <!-- L'élément d'entrée de fichier caché -->
               <input type="file" accept="image/*" class="hidden" @change="updateAvatar($event)">
            </div>
            <!-- Fenêtre modale pour téléverser l'image -->
            <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
               <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
                  <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
                  <!-- Formulaire pour téléverser l'image ou mettre à jour l'URL de l'image de profil -->
                  <form action="../Controller/userController.php" method="post" enctype="multipart/form-data">
                     <div class="mb-4">
                        <label class="text-sm font-medium text-gray-900">Image de profil (URL)</label>
                        <input type="hidden" name="user_id" value="<?php echo $user->getId()?>">
                        <input type="text" id="profile_picture" name="profile_picture" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" required>
                     </div>
                     <button name="update_profile_picture" type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Mettre à jour l'image de profil</button>
                     <button class="mx-auto text-white bg-red-500 hover:bg-red-600 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4" @click="showModal = false">Fermer</button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Affichage donnée d'utilisateur -->
      <p class="mt-1 sm:text-center leading-8 text-gray-500"><?php echo $user->getNickName()?></p>
      <div class= "mt-2 flex justify-center">
         <span class="flex justify-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10"><?php echo $user->getRank()?></span>
      </div>
      <div class="flex justify-center mt-20 border-t border-gray-100  ">
      <dl class="divide-y divide-gray-100">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
         <dt class="font-medium leading-6 text-gray-900">Nom</dt>
         <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getLastName()?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
         <dt class=" font-medium leading-6 text-gray-900">Prénom</dt>
         <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getFirstName()?></dd>
      </div>
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-2 sm:px-0">
         <dt class=" font-medium leading-6 text-gray-900">Email</dt>
         <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"><?php echo $user->getEmail()?></dd>
      </div>

      <!-- Bouton Modifier les informations -->
      <div class="flex justify-center mt-6">
      <div x-data="{ showModal: false }">
      <div class="flex justify-center mt-6">
         <button name="edit" @click="showModal = true" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Modifier les informations</button>
         <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
               <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
               <form action="../Controller/userController.php" method="post" enctype="multipart/form-data">
                  <label for="nickname" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Pseudo</label>
                  <input type="text" name="nickname" value=" <?php echo $user->getNickName()?>"class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre pseudo" required>
                  <label for="lastName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Nom</label>
                  <input type="text" name="lastName" value=" <?php echo $user->getLastName()?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre nom" required>
                  <label for="firstName" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Prenom</label>
                  <input type="text" name="firstName" value=" <?php echo $user->getFirstName()?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre prénom" required>
                  <label for="email" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white ">Email</label>
                  <input type="email" name="email" value=" <?php echo $user->getEmail()?>" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Votre E-mail" required>
                  <label for="new_password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nouveau mot de passe</label>
                  <input type="password" name="new_password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Nouveau mot de passe" >
                  <label for="confirm_password" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirmer le mot de passe</label>
                  <input type="password" name="confirm_password" class="mt-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:outline-none focus:ring focus:ring-[#BAE1FE]" placeholder="Confirmer le mot de passe">
                  <input type="hidden" name="user_id" value="<?php echo $user->getId()?>">
                  <button name="save" type="submit" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 mt-6 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Enregistrer</button>
               </form>
            </div>
         </div>
      </div>

       <!-- Bouton Bannissement -->
      <div x-data="{ showModal: false }">
    <div class="flex justify-center mt-6">
        <!-- Bouton en bas à droite -->
        <div class="fixed bottom-12 right-12">
            <button name="ban" @click="showModal = true" class="text-white bg-[#2CE6C1] hover:bg-[#BAE1FE] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Bannir</button>
        </div>
        
        <div x-show="showModal" class="fixed inset-0 flex items-center justify-center z-50" style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white p-8 rounded-lg shadow-lg" @click.away="showModal = false">
                <!-- Votre contenu de la fenêtre modale -->
                <span class="absolute top-0 right-0 p-4 cursor-pointer" @click="showModal = false">&times;</span>
               <form action="../Controller/userController.php" method="post" enctype="multipart/form-data">
                  <label for="msg" class="text-sm mt-2 block mb-2 font-medium text-gray-900">Bannissement</label>
                  <textarea type="text" name="msg" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:outline-none focus:ring focus:ring-[#BAE1FE] block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Quels sont les raisons du bannissement?" required>
        </textarea>
                  <button name="banned" type="submit" class="mx-auto mt-4 mb-4 text-white bg-red-500 hover:bg-red-600 text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center mr-4">Bannir définitevement</button>
            </div>
        </div>
    </div>
</div>

   </body>
</html>