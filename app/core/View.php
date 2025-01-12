<?php

trait View
{
use Controller;
public function header($sessionData, $notifications)
{
?>
    <div class="sticky top-0 left-0 w-full z-40 bg-bg flex justify-between items-center px-4">
        <!-- Logo -->
        <div>
            <a href="/ElMountada/">
                <img src="<?= ROOTIMG ?>ElMountada2.svg" alt="logo" class="w-44">
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="flex items-center my-6 gap-2">
                
                <div class="flex justify-center items-center flex-grow">
                    <ul class="flex justify-center items-center bg-primary/75 px-[45px] py-[20px] rounded-[20px] gap-6">

        <?php if ($sessionData['user_type'] !== 'admin'): ?>
                    <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/">Accueil</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/content/showContent') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/content/showContent">News</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/partners/showCatalogue') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/partners/showCatalogue">Catalogue</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/offers/showOffers') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/offers/showOffers">Offres</a>
        </li>
        <?php endif; ?>
       
        <?php if ($sessionData['user_type'] == 'admin'): ?>
            <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/partners/showPartners') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/partners/showPartners">Partenaires</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/membership/showMembers') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/membership/showMembers">Membres</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/users/ShowUsers') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/users/ShowUsers">Utilisateurs</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/content/showContent') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/content/showContent">Contenu</a>
        </li>

            <?php endif; ?>

            <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/benevolat/showBenevolat/') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/benevolat/showBenevolat/">Bénévolat</a>
        </li>

        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/dons/showDonsPage/') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/dons/showDonsPage/">Dons</a>
        </li>

        <?php if (!isset($sessionData['user_id'])): ?>
            <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/auth/showLoginPage/') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
                <a href="/ElMountada/auth/showLoginPage/">S'authentifier</a>
            </li>
        <?php endif; ?>
                    </ul>
                </div>

            <!-- User Dropdown -->
            <?php if (isset($sessionData['user_id'])): ?>
                <div class="relative">
                    <div class="flex items-center bg-primary/75 p-4 rounded-[15px]">
                        <button class="user-btn flex items-center">
                            <img src="<?= ROOTIMG ?>user.svg" alt="User" class="w-6">
                        </button>
                    </div>
                    <div class="dropdown-content absolute bg-white shadow-lg rounded-lg p-4 w-48 mt-2 right-0 hidden z-10">
        <?php if (isset($sessionData['user_type']) && $sessionData['user_type'] == 'admin'): ?>
            <!-- Admin -->
            <a href="/ElMountada/notifications/showAddNotification" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ajouter une notification</a>
            <a href="/ElMountada/contact/showMessagesPage" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Messages</a>
            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'member'): ?>
            <!-- Member  -->
            <a href="/ElMountada/history/showHistoryPage/?id=<?= htmlspecialchars($sessionData['user_id'])?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Historique</a>
            <a href="/ElMountada/membership/showMembershipCard/?id=<?= htmlspecialchars($sessionData['user_id'])?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ma carte d'abonnement</a>
             <!-- simple -->
            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'simple'): ?>
            <a href="/ElMountada/membership/showSubscribePage" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">S'abonner</a>
             <!-- Partner -->
            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'partner'): ?>
                <a href="/ElMountada/partners/showCheckMembers" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors"> Vérifier un membre</a>
                <a href="/ElMountada/partners/showPartnerCard/?id=<?= htmlspecialchars($sessionData['user_id'])?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ma Carte</a>
  <!-- Everyone -->
        <?php endif; ?>
        <a href="/ElMountada/profile/showProfilePage/?id=<?= htmlspecialchars($sessionData['user_id'])?> " class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Mon profil</a>
        <a href="/ElMountada/auth/handleLogout" class="block py-2 px-4 text-primary hover:bg-primary/10 rounded-lg transition-colors">Logout</a>
    </div>
                </div>



                <!-- Notification Button -->
                <div class="relative ">
            <button id="notification-btn" class="flex items-center bg-primary/75 p-4 rounded-[15px]">
                <img src="<?= ROOTIMG ?>bell.svg" alt="Notifications" class="w-6">
              
            </button>
            <div id="notification-dropdown" class="hidden absolute bg-white h-[300px] overflow-y-auto shadow-lg rounded-lg p-4 w-48 mt-2 right-0 z-10">
                <h4 class="font-semibold text-text mb-2">Notifications</h4>
                <ul>
                    <?php if (!empty($notifications)): ?>
                        <?php foreach ($notifications as $notification): ?>
                            <li class="py-2 px-4 hover:bg-gray-200  rounded-lg transition-colors mb-1">
                            <h2 class="text-md font-poppins font-semibold  text-text text-opacity-80"><?= htmlspecialchars($notification->title) ?></h2>
                                <p class="text-sm text-gray-800"><?= htmlspecialchars($notification->message) ?></p>
                                <small class="text-gray-500"><?= $notification->created_at ?></small>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="text-gray-500 text-sm">No new notifications.</li>
                    <?php endif; ?>
                </ul>
                    </div>

        </div>
            <?php endif; ?>
        </div>

        <!-- Social Media -->
        <div class="social-media flex items-center space-x-4">
            <a href="https://facebook.com" target="_blank">
                <img src="<?= ROOTIMG ?>facebook.svg" alt="Facebook" class="w-8 h-8">
            </a>
            <a href="https://instagram.com" target="_blank">
                <img src="<?= ROOTIMG ?>instagram.svg" alt="Instagram" class="w-8 h-8">
            </a>
            <a href="https://linkedin.com" target="_blank">
                <img src="<?= ROOTIMG ?>linkedin.svg" alt="LinkedIn" class="w-8 h-8">
            </a>
            <a href="https://x.com" target="_blank">
                <img src="<?= ROOTIMG ?>x.svg" alt="X" class="w-8 h-8">
            </a>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
    
        function setupDropdown() {
            const notificationBtn = document.getElementById('notification-btn');
            const notificationDropdown = document.getElementById('notification-dropdown');
            if (notificationBtn && notificationDropdown) {
                notificationBtn.addEventListener('click', (e) => {
                    e.stopPropagation(); 
                    notificationDropdown.classList.toggle('hidden');
                });

                window.addEventListener('click', (e) => {
                    if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                        notificationDropdown.classList.add('hidden');
                    }
                });
            }
        }

        setupDropdown();
    });
    
</script>



<?php
}


    public function footer()
    {
    ?>
        <footer class="bg-bg2/15 py-8 text-center rounded-[15px] mb-8 mt-auto">
            <div class="container mx-auto px-4">

                <nav class="mb-4">
                    <ul class="flex flex-wrap justify-center gap-6 text-primary font-poppins font-medium">
                        <li>  <a href="/ElMountada/">Accueil</a></li>
                        <li> <a href="/ElMountada/content/showContent">News</a></li>
                        <li><a href="/ElMountada/partners/showCatalogue">Catalogue</a></li>
                        <li><a href="/ElMountada/offers/showOffers">Offres</a></li>
                        <li> <a href="/ElMountada/dons/showDonsPage/">Dons</a></li>
                        <li> <a  class="underline" href="/ElMountada/contact/showContactForm">Nous Contacter</a></li>
                        
                    </ul>
                </nav>





                

                <div class="social-media flex justify-center items-center space-x-4 mb-4">
                    <a href="https://facebook.com" target="_blank">
                        <img src="<?= ROOTIMG ?>facebook.svg" alt="Facebook" class="w-8 h-8">
                    </a>
                    <a href="https://instagram.com" target="_blank">
                        <img src="<?= ROOTIMG ?>instagram.svg" alt="Instagram" class="w-8 h-8">
                    </a>
                    <a href="https://linkedin.com" target="_blank">
                        <img src="<?= ROOTIMG ?>linkedin.svg" alt="LinkedIn" class="w-8 h-8">
                    </a>
                    <a href="https://x.com" target="_blank">
                        <img src="<?= ROOTIMG ?>x.svg" alt="X" class="w-8 h-8">
                    </a>

                </div>
                <p class="text-text font-openSans text-sm">
                    &copy; 2024 ElMountada. Tous droits réservés.
                </p>
            </div>
        </footer>
        
    <?php
    }



    public function Head()
    {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ElMountada</title>
            <script src="https://cdn.tailwindcss.com"></script>
            <script src="<?= ROOTSCRIPT?>script.js"></script>
            <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
            <link href="<?= ROOTSTYLE ?>styles.css" rel="stylesheet">
    
        </head>

        <body>
        <?php
    }


    public function foot()
    {
        ?>
        </body>

        </html>
<?php
    }


    function displaySessionMessage() {
        if (isset($_SESSION['status'])) {
            $statusType = $_SESSION['status_type'] ?? 'success'; 
            $bgColor = $statusType === 'error' ? 'bg-red-500' : 'bg-green-500';
            ?>
            <div id="sessionAlert" class="fixed top-5 left-1/2 transform -translate-x-1/2 <?= $bgColor; ?> text-white py-2 px-4 rounded-lg shadow-lg opacity-0 transition-opacity duration-500 ease-in-out z-50">
                <?= htmlspecialchars($_SESSION['status']); ?>
            </div>
            <script>
                const alertBox = document.getElementById("sessionAlert");
                alertBox.classList.add("opacity-100");
                setTimeout(function() {
                    alertBox.classList.remove("opacity-100");
                }, 3000);
            </script>
            <?php
            unset($_SESSION['status']);
            unset($_SESSION['status_type']);
        }
    }
    
    


}
