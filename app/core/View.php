<?php

trait View
{

    public function header($sessionData)
    {
?>

        <div class="sticky top-0 left-0 w-full z-50 bg-bg flex justify-between items-center px-4">


            <div>
                <a href="/ElMountada/"> 
                <img src="<?= ROOTIMG ?>ElMountada2.svg" alt="logo" class="w-44" >
                </a>
            </div>

            <div class="flex items-center gap-2">
                <div class="flex justify-center items-center my-6">
                    <ul class="flex justify-center items-center bg-primary/75 px-[45px] py-[20px] rounded-[20px] gap-6">
                    <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/">Accueil</a>
        </li>
        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/News') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/News">News</a>
        </li>
        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/partners') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/partners">Catalogue</a>
        </li>
        <li class="font-poppins font-medium hover:text-principale/80 <?php if ($_SERVER['REQUEST_URI'] == '/ElMountada/offers/showOffers') echo 'text-text font-semibold'; else echo 'text-bg'; ?>">
            <a href="/ElMountada/offers/showOffers">Offres</a>
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
                <?php if (isset($sessionData['user_id'])): ?>
    <div class="flex justify-center items-center bg-primary/75 w-full h-full p-4 rounded-[15px] ">
        <button class="user-btn flex items-center ">
            <img src="<?= ROOTIMG ?>user.svg" alt="logo" class="w-6">
        </button>

        <div class="relative">
    <div class="dropdown-content absolute bg-white shadow-lg rounded-lg p-4 w-48 mt-2 right-0 hidden z-10">
        <?php if (isset($sessionData['user_type']) && $sessionData['user_type'] == 'admin'): ?>
            <!-- Admin Menu Items -->
            <a href="/admin/dashboard" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Admin Dashboard</a>
            <a href="/admin/users" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Manage Users</a>
            <a href="/ElMountada/content/showAddContent" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Ajouter du Contenu</a>
            <?php elseif (isset($sessionData['user_type']) && $sessionData['user_type'] == 'member'): ?>
            <!-- Member Menu Items -->
            <a href="/profile" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Profile</a>
            <a href="/settings" class="block py-2 px-4 text-gray-800 hover:bg-gray-200 rounded-lg transition-colors">Settings</a>
       
        <?php endif; ?>
        <a href="/ElMountada/auth/handleLogout" class="block py-2 px-4 text-primary hover:bg-primary/10 rounded-lg transition-colors">Logout</a>
    </div>
</div>


    </div>
    <script>
        const userBtn = document.querySelector('.user-btn');
        const dropdownContent = document.querySelector('.dropdown-content');

        userBtn.addEventListener('click', () => {
            dropdownContent.classList.toggle('hidden');
        });
        window.addEventListener('click', (e) => {
            if (!userBtn.contains(e.target) && !dropdownContent.contains(e.target)) {
                dropdownContent.classList.add('hidden');
            }
        });
    </script>
<?php endif; ?>


            </div>

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

    <?php
    }

    public function footer()
    {
    ?>
        <footer class="bg-bg2/15 py-8 text-center rounded-[15px] mb-8 mt-auto">
            <div class="container mx-auto px-4">

                <nav class="mb-4">
                    <ul class="flex flex-wrap justify-center gap-6 text-primary font-poppins font-medium">
                        <li><a href="#" class="hover:underline">Accueil</a></li>
                        <li><a href="#" class="hover:underline">News</a></li>
                        <li><a href="#" class="hover:underline">Partenaires</a></li>
                        <li><a href="#" class="hover:underline">Remises</a></li>
                        <li><a href="#" class="hover:underline">Aides</a></li>
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
            <link href="<?= ROOTSTYLE ?>styles.css" rel="stylesheet">
           

        </head>

        <body>
        <script src="<?= ROOTSCRIPT ?>script.js"></script>
        <?php
    }


    public function foot()
    {
        ?>
        </body>

        </html>
<?php
    }
}
