<?php
require_once("app/controllers/newsController.php");
class Accueil
{

    public function navBar()
    {
        ?>
        <div class="flex justify-center items-center m-6">
            <ul class="flex justify-center  items-center bg-primary/75 px-[45px] py-[20px] rounded-[15px] gap-6">
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

    public function diaporama($latestNews)
    {
       
        ?>
        <div class="relative overflow-hidden w-full rounded-[15px] h-[550px]">
            <div id="diaporama" class="flex transition-transform duration-1000 ease-in-out">
                <?php
                foreach ($latestNews as $item) {
                    echo "<div class='w-full h-[550px] flex-shrink-0 relative'>";
                    echo "<img src='" . $item['image_path'] . "' alt='" . $item['title'] . "' class='w-full h-full object-cover'>";
                    echo "<div class='absolute top-0 left-0 bottom-0 right-0 bg-primary opacity-30'></div>";
                    echo "<div class='absolute top-0 left-0 bottom-0 right-0 flex flex-col justify-center items-center text-white p-4'>";
                    echo "<h2 class='text-3xl font-poppins font-bold '>" . $item['title'] . "</h2>";
                    echo "<p class='text-lg font-openSans mt-2'>" . $item['description'] . "</p>";
                    echo "</div>"; 
                    echo "</div>";
                }
                ?>
            </div>
        </div>

       
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

    public function footer (){
        ?>
        </body>
        </html>
        <?php
    }



}
?>