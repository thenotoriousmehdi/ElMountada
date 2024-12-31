<?php
class OffersView
{
use View;
    public function offers($offers)
    {
        echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8  text-text">Avantages</h2>';
        if (empty($offers)) {
            echo "<p class='text-center text-lg text-gray-500'>No offers available at the moment.</p>";
        } else {

            echo '<div class="flex flex-col items-end gap-4">';

            echo '<div class="overflow-auto w-full h-[700px]">'; 
            echo '<table class="min-w-full bg-white/80 shadow-smborder  border-primary rounded-[15px] overflow-hidden">';
            echo '<thead class="bg-text sticky top-0 z-10">';
            echo '<tr>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Ville</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Categorie</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Abonnement</th>
                    <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Reduction</th>
                  </tr>';
            echo '</thead>';

            echo '<tbody>';
            echo '<tbody class="overflow-y-auto">';
            foreach ($offers as $offer) {
                echo "<tr class='border-t border-primary/5   hover:bg-primary/10'>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer->ville) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer -> categorie) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer -> establishment) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer -> membership_type) . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . htmlspecialchars($offer -> reduction) . "%</td>";
                echo "</tr>";
            }
            echo '</div>';
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
           

            echo '</div>';
        }

        echo '</div>';
    }
}
?>