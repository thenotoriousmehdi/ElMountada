<?php
class AccueilView
{

    use View;
    public function diaporama($News)
    {

?>
        <div class="relative overflow-hidden w-full rounded-[15px] h-[600px] mb-12">
            <div id="diaporama" class="flex transition-transform duration-1000 ease-in-out">
                <?php
                foreach ($News as $item) {
                    echo "<div class='w-full h-[600px] flex-shrink-0 relative'>";
                    echo "<img src='" . ROOT . $item->image_path . "' alt='" . htmlspecialchars($item->title) . "' class='w-full h-full object-cover'>";
                    echo "<div class='absolute top-0 left-0 bottom-0 right-0 bg-primary opacity-30'></div>";
                    echo "<div class='absolute top-0 left-0 bottom-0 right-0 flex flex-col justify-center items-center text-white p-4'>";
                    echo "<h2 class='text-3xl font-poppins font-bold '>" . $item->title . "</h2>";
                    echo "<p class='text-lg font-openSans mt-2'>" . $item->description . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>


    <?php
    }


    public function offers($offers)
    {

        echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Avantages</h2>';
        if (empty($offers)) {
            echo "<p class='text-center text-lg text-gray-500'>No partners available at the moment.</p>";
        } else {
            echo '<div class="flex flex-col items-end gap-4">';
            echo '<div class="overflow-auto w-full max-h-[700px]">';
            echo '<div class="flex flex-col items-end gap-4">';
            echo '<table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">';
            echo '<thead class="bg-text sticky top-0 z-10">';
            echo '<tr>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Logo</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom du partenaire</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Catégorie</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Ville</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Type</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Valeur</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Description</th>
        </tr>';
            echo '</thead>';

            echo '<tbody>';
            foreach ($offers as $offer) {
                echo "<tr class='border-t border-primary/5 hover:bg-primary/10'>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->logo_path) && !empty($offer->logo_path)
                    ? "<img src='" . htmlspecialchars(ROOT . '/' . $offer->logo_path) . "' alt='Logo' width='50'>"
                    : 'No Logo';

                echo "</td>";



                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->partner_name) ? htmlspecialchars($offer->partner_name ?? 'N/A') : 'N/A';
                echo "</td>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->category_name) ? htmlspecialchars($offer->category_name ?? 'N/A') : 'N/A';
                echo "</td>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->location) ? htmlspecialchars($offer->location ?? 'N/A') : 'N/A';
                echo "</td>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->type) ? htmlspecialchars($offer->type ?? 'N/A') : 'N/A';
                echo "</td>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->value) ? htmlspecialchars($offer->value ?? 'N/A') : 'N/A';
                echo "%</td>";


                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->description) ? htmlspecialchars($offer->description ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "</tr>";
            }
            echo '</tbody>';
            echo '</table>';

            echo '<div class="pr-2">';
            echo '<a href="' . ROOT . '/offers/showOffers" class="font-poppins underline text-[16px] font-semibold text-text">Voir plus</a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        echo '</div>';
    }

    public function partnersLogos($partnersLogos)

    {

    ?>

        <div class="mb-12  py-[25px] rounded-[15px]">
            <h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Nos Partenaires</h2>
            <div class="overflow-hidden">
                <div class="flex gap-8 animate-slide" style="animation: slide 5s linear infinite;">
                    <?php foreach ($partnersLogos as $partner): ?>
                        <img src="<?= htmlspecialchars($partner->logo_path ? ROOT . '/' . $partner->logo_path : ROOT . '/public/assets/ElMountada1.svg') ?>"
                            alt="Partner Logo"
                            class="h-24 w-24 object-contain rounded-[10px] mb-4">

                    <?php endforeach; ?>
                    <?php foreach ($partnersLogos as $partner): ?>
                        <img src="<?= htmlspecialchars($partner->logo_path ? ROOT . '/' . $partner->logo_path : ROOT . '/public/assets/ElMountada1.svg') ?>"
                            alt="Partner Logo"
                            class="h-24 w-24 object-contain rounded-[10px] mb-4">
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


    public function adminWelcome()

    {

    ?>

        <div class="flex items-center h-full w-full justify-center p-48 ">

            <div class="w-full h-full max-w-4xl p-8 bg-white shadow-xl rounded-xl">
                <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">
                    Bienvenue dans le portail administrateur!
                </h1>
                <p class="text-lg text-gray-600 text-center ">
                    Gérez votre application facilement. Naviguez à travers le portail pour accéder aux différents outils et fonctionnalités administratives.
                </p>

            </div>
        </div>


    <?php
    }

    public function partnerWelcome()

    {

    ?>

        <div class="flex items-center h-full w-full justify-center p-48 ">

            <div class="w-full h-full max-w-4xl p-8 bg-white shadow-xl rounded-xl">
                <h1 class="text-4xl font-bold text-gray-800 text-center mb-6">
                    Bienvenue dans le portail Partenaire!
                </h1>
                <p class="text-lg text-gray-600 text-center ">
                    Accédez à votre espace partenaire pour gérer et suivre vos interactions avec nos membres. Simplifiez vos tâches administratives grâce à nos outils dédiés.
                </p>

            </div>
        </div>


    <?php
    }




    public function latest($Latest)
    {
    ?>

        <div class="container flex flex-col gap-4 mx-auto px-4 mb-12 ">

            <div class="flex justify-between items-end ">
                <h2 class="text-center text-[32px] font-poppins font-bold text-text">Nouvautés</h2>

                <a href="<?= ROOT ?>/content/showContent" class="font-poppins underline text-[16px] font-semibold text-text">Voir plus</a>
            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php foreach ($Latest as $item): ?>
                    <div
                        class="bg-white/80 shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:scale-105 flex flex-col h-full">
                        <?php if (!empty($item->image_path)): ?>
                            <img src="<?= htmlspecialchars(ROOT . $item->image_path) ?>" alt="<?= htmlspecialchars($item->title) ?>" class="w-full h-48 object-cover">

                        <?php endif; ?>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm rounded-full px-4 py-1 uppercase 
                            <?php echo match (strtolower($item->type)) {
                                'announce' => 'bg-blue-100 text-blue-800',
                                'nouvelle' => 'bg-green-100 text-green-800',
                                'evenement' => 'bg-yellow-100 text-yellow-800',
                                'activite' => 'bg-purple-100 text-purple-800',
                                default => 'bg-gray-100 text-gray-800'
                            }; ?>">
                                    <?php echo htmlspecialchars($item->type); ?>
                                </span>
                                <?php if (!empty($item->event_date)): ?>
                                    <span class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars(date('M d, Y', strtotime($item->event_date))); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-xl font-poppins font-bold text-gray-800 mb-3">
                                <?php echo htmlspecialchars($item->title); ?>
                            </h3>
                            <p class="text-gray-600 font-openSans mb-4 flex-grow">
                                <?php echo htmlspecialchars(substr($item->description, 0, 150) . (strlen($item->description) > 150 ? '...' : '')); ?>
                            </p>
                            <?php if (!empty($item->location)): ?>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <?php echo htmlspecialchars($item->location); ?>
                                </div>
                            <?php endif; ?>
                            <div class="flex justify-end mt-auto">
                                <a href="<?= ROOT ?>/content/showDetails/?id=<?= htmlspecialchars($item->id) ?>"
                                    class="inline-block bg-[#264653] text-white px-4 py-2 rounded hover:bg-text/80 transition duration-300">
                                    Plus de détails
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
<?php
    }
}
?>