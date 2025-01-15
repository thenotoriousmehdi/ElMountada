<?php
class OffersView
{
use View;
public function offers($offers)
{
    echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
    echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Avantages</h2>';
    if (empty($offers)) {
        echo "<p class='text-center text-lg text-gray-500'>No partners available at the moment.</p>";
    } else {
        echo '<div class="flex flex-col items-end gap-4">';
        echo '<div class="overflow-auto w-full max-h-[700px]">';
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

            // Logo
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->logo_path) && !empty($offer->logo_path) ? "<img src='" . htmlspecialchars($offer->logo_path) . "' alt='Logo' width='50'>" : 'No Logo';
            echo "</td>";

            // Partner Name
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->partner_name) ? htmlspecialchars($offer->partner_name ?? 'N/A') : 'N/A';
            echo "</td>";

            // Category
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->category_name) ? htmlspecialchars($offer->category_name ?? 'N/A') : 'N/A';
            echo "</td>";

            // City
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->location) ? htmlspecialchars($offer->location ?? 'N/A') : 'N/A';
            echo "</td>";

            // Type (Reduction, Special Offer, or Advantage)
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->type) ? htmlspecialchars($offer->type ?? 'N/A') : 'N/A';
            echo "</td>";

            // Value (Reduction Value or NULL for Advantages)
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->value) ? htmlspecialchars($offer->value ?? 'N/A') : 'N/A';
            echo "%</td>";

            // Description (Special Offer or Advantage Description)
            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($offer->description) ? htmlspecialchars($offer->description ?? 'N/A') : 'N/A';
            echo "</td>";

            echo "</tr>";
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
}
}
?>