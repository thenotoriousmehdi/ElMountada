<?php
class Commun
{

    public function navBar()
    {
        ?>
        <div class="flex justify-center items-center m-6">
            <ul class="flex justify-center  items-center bg-primary/80 px-[45px] py-[20px] rounded-[15px] gap-6">
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/Accueil">Accueil</a></li>
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/News">News</a></li>
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/Catalogue">Catalogue</a></li>
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/Remises">Remises</a></li>
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/Aides">Aides</a></li>
                <li class="text-[#fdeeee] hover:text-principale/80"><a href="/S'authentifier">S'authentifier</a></li>
            </ul>
        </div>
        <?php
    }


    public function header()
    {
        ?>

        <div class="sticky top-0 left-0 w-full z-50 bg-bg flex justify-between items-center px-4">


            <div>
                <img src="public/assets/ElMountada2.svg" alt="logo" class="w-44">
            </div>


            <div class="flex justify-center items-center m-6">
                <ul class="flex justify-center items-center bg-primary/75 px-[45px] py-[20px] rounded-[20px] gap-6">
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a
                            href="/ElMountada/">Accueil</a>
                    </li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/News">News</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a
                            href="/ElMountada/partners">Catalogue</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/ElMountada/offers">Remises</a>
                    </li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/Aides">Dons</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a
                            href="/ElMountada/auth">S'authentifier</a></li>
                </ul>
            </div>


            <div class="social-media flex items-center space-x-4">
                <a href="https://facebook.com" target="_blank">
                    <img src="public/assets/facebook.svg" alt="Facebook" class="w-8 h-8">
                </a>
                <a href="https://instagram.com" target="_blank">
                    <img src="public/assets/instagram.svg" alt="Instagram" class="w-8 h-8">
                </a>
                <a href="https://linkedin.com" target="_blank">
                    <img src="public/assets/linkedin.svg" alt="LinkedIn" class="w-8 h-8">
                </a>
                <a href="https://x.com" target="_blank">
                    <img src="public/assets/x.svg" alt="X" class="w-8 h-8">
                </a>
            </div>
        </div>

        <?php
    }

    public function footer()
    {
        ?>
        <footer class="bg-bg2/15 py-8 text-center rounded-[15px] mb-8">
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
                        <img src="public/assets/facebook.svg" alt="Facebook" class="w-8 h-8">
                    </a>
                    <a href="https://instagram.com" target="_blank">
                        <img src="public/assets/instagram.svg" alt="Instagram" class="w-8 h-8">
                    </a>
                    <a href="https://linkedin.com" target="_blank">
                        <img src="public/assets/linkedin.svg" alt="LinkedIn" class="w-8 h-8">
                    </a>
                    <a href="https://x.com" target="_blank">
                        <img src="public/assets/x.svg" alt="X" class="w-8 h-8">
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
            <link href="public/dist/styles.css" rel="stylesheet">
            <script src="public/scripts/script.js"></script>

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

}
?>