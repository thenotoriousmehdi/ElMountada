<?php
require_once("app/controllers/newsController.php");
class Accueil
{

    public function navBar()
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
        </head>
        <body>






        </body>
        </html>
        <?php
    }

    public function diaporama($latestNews)
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
        </head>
        <body>
        <div class="relative overflow-hidden w-full h-64">
            <div id="diaporama" class="flex transition-transform duration-1000 ease-in-out">
                <?php
                // Supposons que vous avez une méthode dans votre modèle pour récupérer les dernières nouvelles pour le diaporama
                 // Méthode pour récupérer les dernières nouvelles avec image, titre et description
                foreach ($latestNews as $item) {
                    echo "<div class='w-full h-full flex-shrink-0 relative'>";
                    echo "<img src='" . $item['image_path'] . "' alt='" . $item['title'] . "' class='w-full h-full object-cover'>";
                    echo "<div class='absolute top-0 left-0 bottom-0 right-0 bg-black bg-opacity-50 flex flex-col justify-center items-center text-white p-4'>";
                    echo "<h2 class='text-3xl font-bold'>" . $item['title'] . "</h2>";
                    echo "<p class='text-lg mt-2'>" . $item['description'] . "</p>";
                    echo "</div>"; // Container pour le titre et la description
                    echo "</div>"; // Slide
                }
                ?>
            </div>
        </div>

        





        </body>
        <script>
            let currentIndex = 0;
            const slides = document.querySelectorAll('#diaporama .flex-shrink-0');
            const totalSlides = slides.length;

            function showNextSlide() {
                currentIndex = (currentIndex + 1) % totalSlides;
                const diaporama = document.getElementById('diaporama');
                diaporama.style.transform = `translateX(-${currentIndex * 100}%)`;
            }

            setInterval(showNextSlide, 3000); 
        </script>
        </html>
        <?php
    }


}
?>