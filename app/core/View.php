<?php

trait View
{
    use Controller;
    public function header($sessionData, $notifications, $unreadCount)
    {
?>
        <div class="sticky top-0 left-0 w-full z-40 bg-bg flex justify-between items-center py-10 lg:py-0 lg:pl-0 lg:pr-0  px-4 pl-2 pr-2   lg:m-0">


            <div>
                <a href="<?= ROOT ?>/">
                    <img src="<?= ROOTIMG ?>ElMountada2.svg" alt="logo" class=" w-44">
                </a>
            </div>




            <div class="flex items-center gap-2">

                <div class="lg:hidden order-1">
                    <button id="burger-menu-btn" class="flex items-center bg-primary/75 p-4 rounded-[15px] ">
                        <img src="<?= ROOTIMG ?>menu.svg" alt="Burger Menu" class="w-7 h-7">

                    </button>
                </div>


                <div class="flex items-center justify-between my-6 gap-2">
                    <div class="hidden lg:flex justify-center items-center flex-grow">
                        <ul class="flex justify-center items-center bg-primary/75 px-[45px] py-[20px] rounded-[20px] gap-6">
                            <?php if ($sessionData['user_type'] !== 'admin'): ?>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/">Accueil</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/content/showContent') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/content/showContent">News</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/partners/showCatalogue') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/partners/showCatalogue">Catalogue</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/offers/showOffers') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/offers/showOffers">Offres</a>
                                </li>
                            <?php endif; ?>
                            <?php if ($sessionData['user_type'] == 'admin'): ?>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/partners/showPartners') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/partners/showPartners">Partenaires</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/membership/showMembers') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/membership/showMembers">Membres</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/users/ShowUsers') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/users/ShowUsers">Utilisateurs</a>
                                </li>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/content/showContent') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/content/showContent">Contenu</a>
                                </li>
                            <?php endif; ?>
                            <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/benevolat/showBenevolat/') echo 'text-text font-semibold';
                                                                                            else echo 'text-bg'; ?>">
                                <a href="<?= ROOT ?>/benevolat/showBenevolat/">Bénévolat</a>
                            </li>
                            <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/dons/showDonsPage/') echo 'text-text font-semibold';
                                                                                            else echo 'text-bg'; ?>">
                                <a href="<?= ROOT ?>/dons/showDonsPage/">Dons</a>
                            </li>
                            <?php if (!isset($sessionData['user_id'])): ?>
                                <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/auth/showLoginPage/') echo 'text-text font-semibold';
                                                                                                else echo 'text-bg'; ?>">
                                    <a href="<?= ROOT ?>/auth/showLoginPage/">S'authentifier</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden fixed inset-0 bg-black bg-opacity-80 text-white z-50 flex flex-col items-center justify-center">
                    <button id="close-menu" class="absolute top-4 right-4 text-white hover:text-gray-300">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                    <ul class="text-center space-y-6">
                        <?php if ($sessionData['user_type'] !== 'admin'): ?>
                            <li><a href="<?= ROOT ?>/" class="text-lg hover:underline">Accueil</a></li>
                            <li><a href="<?= ROOT ?>/content/showContent" class="text-lg hover:underline">News</a></li>
                            <li><a href="<?= ROOT ?>/partners/showCatalogue" class="text-lg hover:underline">Catalogue</a></li>
                            <li><a href="<?= ROOT ?>/offers/showOffers" class="text-lg hover:underline">Offres</a></li>
                        <?php endif; ?>
                        <?php if ($sessionData['user_type'] == 'admin'): ?>
                            <li><a href="<?= ROOT ?>/partners/showPartners" class="text-lg hover:underline">Partenaires</a></li>
                            <li><a href="<?= ROOT ?>/membership/showMembers" class="text-lg hover:underline">Membres</a></li>
                            <li><a href="<?= ROOT ?>/users/ShowUsers" class="text-lg hover:underline">Utilisateurs</a></li>
                            <li><a href="<?= ROOT ?>/content/showContent" class="text-lg hover:underline">Contenu</a></li>
                        <?php endif; ?>
                        <li><a href="<?= ROOT ?>/benevolat/showBenevolat/" class="text-lg hover:underline">Bénévolat</a></li>
                        <li><a href="<?= ROOT ?>/dons/showDonsPage/" class="text-lg hover:underline">Dons</a></li>
                        <?php if (!isset($sessionData['user_id'])): ?>
                            <li><a href="<?= ROOT ?>/auth/showLoginPage/" class="text-lg hover:underline">S'authentifier</a></li>
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
                                <a href="<?= ROOT ?>/notifications/showAddNotification" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ajouter une notification</a>
                                <a href="<?= ROOT ?>/contact/showMessagesPage" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Messages</a>
                                <a href="<?= ROOT ?>/membership/showSubscriptionsHistory" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Historique d'abonnement</a>
                            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'member'): ?>
                                <!-- Member  -->
                                <a href="<?= ROOT ?>/history/showHistoryPage/?id=<?= htmlspecialchars($sessionData['user_id']) ?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Historique</a>
                                <a href="<?= ROOT ?>/membership/showMembershipCard/?id=<?= htmlspecialchars($sessionData['user_id']) ?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ma carte d'abonnement</a>
                                <a href="<?= ROOT ?>/favorite/showFavorite/?id=<?= htmlspecialchars($sessionData['user_id']) ?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Mes Favoris</a>
                                <!-- simple -->
                            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'simple'): ?>
                                <a href="/ElMountada/membership/showSubscribePage" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">S'abonner</a>
                                <a href="<?= ROOT ?>/favorite/showFavorite/?id=<?= htmlspecialchars($sessionData['user_id']) ?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Mes Favoris</a>
                                <!-- Partner -->
                            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'partner'): ?>
                                <a href="<?= ROOT ?>/partners/showCheckMembers" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors"> Vérifier un membre</a>
                                <a href="<?= ROOT ?>/partners/showPartnerCard/?id=<?= htmlspecialchars($sessionData['user_id']) ?>" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ma Carte</a>
                                <!-- Everyone -->
                            <?php endif; ?>
                            <a href="<?= ROOT ?>/profile/showProfilePage/?id=<?= htmlspecialchars($sessionData['user_id']) ?> " class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Mon profil</a>
                            <a href="<?= ROOT ?>/auth/handleLogout" class="block py-2 px-4 text-primary hover:bg-primary/10 rounded-lg transition-colors">Logout</a>
                        </div>
                    </div>

                    <div class="relative">
    <!-- Notification Button -->
    <button id="notification-btn" class="flex items-center bg-primary/75 p-4 rounded-[15px] relative">
        <!-- Bell Icon -->
        <img src="<?= ROOTIMG ?>bell.svg" alt="Notifications" class="w-6">
        <!-- Red Badge for Unread Notifications -->
        <?php if ($unreadCount > 0): ?>
            <span id="notification-badge" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-2 py-1">
                <?= $unreadCount ?>
            </span>
        <?php endif; ?>
    </button>

    <!-- Notification Dropdown -->
    <div id="notification-dropdown" class="hidden absolute bg-white h-[300px] overflow-y-auto shadow-lg rounded-lg p-4 w-64 mt-2 right-0 z-10">
        <h4 class="font-semibold text-gray-800 mb-2">Notifications</h4>
        <ul>
            <?php if (!empty($notifications)): ?>
                <?php foreach ($notifications as $notification): ?>
                    <li class="py-2 px-4 hover:bg-gray-100 rounded-lg transition-colors mb-1">
                        <h2 class="text-md font-semibold text-gray-800"><?= htmlspecialchars($notification->title) ?></h2>
                        <p class="text-sm text-gray-600"><?= htmlspecialchars($notification->message) ?></p>
                        <small class="text-xs text-gray-400"><?= $notification->created_at ?></small>
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

       
            <div class="social-media hidden  xl:flex items-center space-x-4">
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
    const notificationBtn = document.getElementById('notification-btn');
    const notificationDropdown = document.getElementById('notification-dropdown');
    const notificationBadge = document.getElementById('notification-badge');

    async function markNotificationsAsRead() {
        try {
            const response = await fetch('/ElMountada/notifications/markAsRead', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            });
            
            const data = await response.json();
            if (!data.success) {
                console.error('Failed to mark notifications as read');
            }
        } catch (error) {
            console.error('Error marking notifications as read:', error);
        }
    }

    if (notificationBtn && notificationDropdown) {
        // Toggle dropdown visibility
        notificationBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent the link from navigating
            
            // Toggle dropdown
            notificationDropdown.classList.toggle('hidden');
            
            // If opening the dropdown
            if (!notificationDropdown.classList.contains('hidden')) {
                // Hide the red badge
                if (notificationBadge) {
                    notificationBadge.style.display = 'none';
                }
                // Mark notifications as read
                markNotificationsAsRead();
            }
        });

        // Close the dropdown when clicking outside
        document.addEventListener('click', (e) => {
            if (!notificationBtn.contains(e.target) && !notificationDropdown.contains(e.target)) {
                notificationDropdown.classList.add('hidden');
            }
        });
    }
});
</script>
        <script>
            const burgerBtn = document.getElementById('burger-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const closeMenu = document.getElementById('close-menu');

            burgerBtn.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });

            closeMenu.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
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
                        <li> <a href="<?= ROOT ?>/">Accueil</a></li>
                        <li> <a href="<?= ROOT ?>/content/showContent">News</a></li>
                        <li><a href="<?= ROOT ?>/partners/showCatalogue">Catalogue</a></li>
                        <li><a href="<?= ROOT ?>/offers/showOffers">Offres</a></li>
                        <li> <a href="<?= ROOT ?>/dons/showDonsPage/">Dons</a></li>
                        <li> <a class="underline" href="<?= ROOT ?>/contact/showContactForm">Nous Contacter</a></li>

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
            <script src="<?= ROOTSCRIPT ?>script.js"></script>
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


    function displaySessionMessage()
    {
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
