<?php
class Accueil
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

            <!-- Logo -->
            <div>
                <img src="public/assets/ElMountada2.svg" alt="logo" class="w-44">
            </div>

            <!-- Navbar -->
            <div class="flex justify-center items-center m-6">
                <ul class="flex justify-center items-center bg-primary/75 px-[45px] py-[20px] rounded-[20px] gap-6">
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="http://localhost:8888/Elmountada/">Accueil</a>
                    </li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/News">News</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a
                            href="/Partners">Partenaires</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/Remises">Remises</a>
                    </li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a href="/Aides">Aides</a></li>
                    <li class="text-[#fdeeee] font-poppins font-medium hover:text-principale/80"><a
                            href="http://localhost:8888/Elmountada/auth">S'authentifier</a></li>
                </ul>
            </div>

            <!-- Social Media Section -->
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


    public function diaporama($News)
    {

        ?>
        <div class="relative overflow-hidden w-full rounded-[15px] h-[650px] mb-8">
            <div id="diaporama" class="flex transition-transform duration-1000 ease-in-out">
                <?php
                foreach ($News as $item) {
                    echo "<div class='w-full h-[650px] flex-shrink-0 relative'>";
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


    public function offers($offers) {
        echo '<div class="bg-text/10 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8  text-text">Avantages</h2>';
        if (empty($offers)) {
            echo "<p class='text-center text-lg text-gray-500'>No offers available at the moment.</p>";
        } else {

            echo '<div class="flex flex-col items-end gap-4">';


            echo '<table class="min-w-full bg-bg border border-primary rounded-[15px] overflow-hidden">';
            echo '<thead class="bg-primary">';
            echo '<tr>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Ville</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Categorie</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Abonnement</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Reduction</th>
                  </tr>';
            echo '</thead>';
            
            echo '<tbody>';
            foreach ($offers as $offer) {
                echo "<tr class='border-t border-primary/5  hover:bg-primary/10'>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer['ville']) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer['categorie']) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer['establishment']) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer['membership_type']) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer['reduction']) . "%</td>";
                echo "</tr>";
            }
            echo '</tbody>';
            echo '</table>';

            echo '<div class="pr-2">';
            echo '<a href="" class="font-poppins underline text-lg font-semibold text-text">Plus de détails</a>';
            echo '</div>';


            echo '</div>';



        }

        echo '</div>';
    }

    public function partners($partners = [])
    {
        ?>
        <div class="mb-8 bg-primary bg-opacity-5 py-[25px] rounded-[15px]">
            <h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Nos Partenaires</h2>
            <div class="overflow-hidden">
                <div class="flex gap-8 animate-slide" style="animation: slide 5s linear infinite;">
                    <?php foreach ($partners as $partner): ?>
                        <img src="<?php echo htmlspecialchars($partner['logo_path']); ?>" alt="Partner Logo"
                            class="h-16 object-contain">
                    <?php endforeach; ?>
                    <?php foreach ($partners as $partner): ?>
                        <img src="<?php echo htmlspecialchars($partner['logo_path']); ?>" alt="Partner Logo"
                            class="h-16 object-contain">
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <style>
            @keyframes slide {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-25%);
                }
            }

            .animate-slide {
                width: 200%;
            }
        </style>
        <?php
    }

    public function latest($Latest)
    {
        ?>
        <body>
        <h2 class="text-center text-[32px] font-poppins font-bold mb-4 text-text">Nouvautés</h2>
       <div class="container mx-auto px-4 mb-8 py-8">
        <?php if (!empty($message)): ?>
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($Latest as $item): ?>
                <div class="bg-principale shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:scale-105">
                    <?php if (!empty($item['image_path'])): ?>
                        <img 
                            src="<?php echo htmlspecialchars($item['image_path']); ?>" 
                            alt="<?php echo htmlspecialchars($item['title']); ?>" 
                            class="w-full h-48 object-cover"
                        >
                    <?php endif; ?>

                    <div class="p-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm bg-primary rounded-full px-4 py-1 bg-opacity-20 text-gray-600 uppercase">
                                <?php echo htmlspecialchars($item['type']); ?>
                            </span>
                            <?php if (!empty($item['event_date'])): ?>
                                <span class="text-sm text-gray-500">
                                    <?php echo htmlspecialchars(date('M d, Y', strtotime($item['event_date']))); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <h3 class="text-xl font-poppins font-bold text-gray-800 mb-3">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </h3>
                        
                        <p class="text-gray-600 font-openSans mb-4">
                            <?php echo htmlspecialchars(substr($item['description'], 0, 150) . (strlen($item['description']) > 150 ? '...' : '')); ?>
                        </p>
                        
                        <?php if (!empty($item['location'])): ?>
                            <div class="flex items-center text-sm text-gray-500 mb-2">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                <?php echo htmlspecialchars($item['location']); ?>
                            </div>
                        <?php endif; ?>
                        <div class="flex justify-end"> 
                        <a href="#" class="inline-block  bg-[#264653] text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                            Plus de détails
                        </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    </body>
<script> 
    document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    const gridContainer = container.querySelector('.grid');
    const cards = Array.from(gridContainer.children);

    // If there are 3 or fewer cards, no need for carousel
    if (cards.length <= 3) return;

    // Create carousel navigation
    const carouselNav = document.createElement('div');
    carouselNav.className = 'flex justify-start items-center space-x-4 mt-6';
    
    const prevButton = document.createElement('button');
    prevButton.innerHTML = '&larr;';
    prevButton.className = 'bg-primary text-white px-4 py-2 rounded';
    
    const nextButton = document.createElement('button');
    nextButton.innerHTML = '&rarr;';
    nextButton.className = 'bg-primary text-white px-4 py-2 rounded';
    
    carouselNav.appendChild(prevButton);
    carouselNav.appendChild(nextButton);
    container.appendChild(carouselNav);

    // Initial setup
    let currentIndex = 0;
    const cardsPerView = {
        mobile: 1,
        tablet: 2,
        desktop: 3
    };

    function updateCarousel() {
        // Determine cards per view based on screen width
        let viewCount = window.innerWidth < 640 ? cardsPerView.mobile 
                      : window.innerWidth < 1024 ? cardsPerView.tablet 
                      : cardsPerView.desktop;

        // Hide all cards
        cards.forEach(card => {
            card.classList.add('hidden');
        });

        // Show correct cards
        for (let i = 0; i < viewCount; i++) {
            const index = (currentIndex + i) % cards.length;
            cards[index].classList.remove('hidden');
        }
    }

    // Next button functionality
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % cards.length;
        updateCarousel();
    });

    // Previous button functionality
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        updateCarousel();
    });

    // Initial display and responsive updates
    updateCarousel();
    window.addEventListener('resize', updateCarousel);
});



</script>



        <?php
    }

    public function footer()
    {
        ?>
       <footer class="bg-bg2/15 py-8 text-center rounded-[15px] mb-8">
  <div class="container mx-auto px-4">
    <!-- Menu Simplifié -->
    <nav class="mb-4">
      <ul class="flex flex-wrap justify-center gap-6 text-primary font-poppins font-medium">
        <li><a href="#" class="hover:underline">Accueil</a></li>
        <li><a href="#" class="hover:underline">News</a></li>
        <li><a href="#" class="hover:underline">Partenaires</a></li>
        <li><a href="#" class="hover:underline">Remises</a></li>
        <li><a href="#" class="hover:underline">Aides</a></li>
      </ul>
    </nav>

    <!-- Lien Réseaux Sociaux -->
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

    <!-- Copyright -->
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