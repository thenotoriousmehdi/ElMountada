<?php
class OffersView
{
    use View;

    public function offers($offers, $cities = [], $categories = [], $types = []) {
        echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Avantages</h2>';


        $sortableColumns = [
            'partner_name' => 'Nom du partenaire',
            'category_name' => 'Catégorie',
            'location' => 'Ville',
            'type' => 'Type',
            'value' => 'Valeur',
            'created_at' => 'Date de création'
        ];
        ?>
        <div class="bg-white/80 shadow-md rounded-[15px] p-6 mb-8">
            <form method="POST" class="flex flex-wrap gap-4 items-end">
                <div class="flex flex-col gap-2">
                    <label for="ville" class="font-poppins font-semibold">Ville</label>
                    <select name="ville" id="ville" class="p-2 rounded-lg border border-text/20 min-w-[200px]">
                        <option value="">Toutes les villes</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?= htmlspecialchars($city) ?>"
                                <?= (isset($_POST['ville']) && $_POST['ville'] === $city) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($city) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <div class="flex flex-col gap-2">
                    <label for="category" class="font-poppins font-semibold">Catégorie</label>
                    <select name="category" id="category" class="p-2 rounded-lg border border-text/20 min-w-[200px]">
                        <option value="">Toutes les catégories</option>
                        <?php foreach ($categories as $id => $name): ?>
                            <option value="<?= htmlspecialchars($id) ?>"
                                <?= (isset($_POST['category']) && $_POST['category'] == $id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($name) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <div class="flex flex-col gap-2">
                    <label for="type" class="font-poppins font-semibold">Type</label>
                    <select name="type" id="type" class="p-2 rounded-lg border border-text/20 min-w-[200px]">
                        <option value="">Tous les types</option>
                        <?php foreach ($types as $id => $type): ?>
                            <option value="<?= htmlspecialchars($id) ?>"
                                <?= (isset($_POST['type']) && $_POST['type'] == $id) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($type) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="sort_column" class="font-poppins font-semibold">Trier par</label>
                    <select name="sort_column" id="sort_column" class="p-2 rounded-lg border border-text/20 min-w-[200px]">
                        <option value="">Sélectionner un tri</option>
                        <?php foreach ($sortableColumns as $column => $label): ?>
                            <option value="<?= htmlspecialchars($column) ?>"
                                <?= (isset($_POST['sort_column']) && $_POST['sort_column'] === $column) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($label) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
    
                <div class="flex flex-col gap-2">
                    <label for="sort_direction" class="font-poppins font-semibold">Direction</label>
                    <select name="sort_direction" id="sort_direction" class="p-2 rounded-lg border border-text/20 min-w-[200px]">

                    <option value="">Sélectionner la direction</option>
                        <option value="DESC" <?= (isset($_POST['sort_direction']) && $_POST['sort_direction'] === 'DESC') ? 'selected' : '' ?>>
                            Croissant
                        </option>
                        <option value="ASC" <?= (isset($_POST['sort_direction']) && $_POST['sort_direction'] === 'ASC') ? 'selected' : '' ?>>
                            Décroissant
                        </option>
                    </select>
                </div>
    
                <button type="submit" name="filter_submit" 
                    class="bg-text text-white py-2 px-6 rounded-lg hover:bg-text/80 font-poppins">
                    Appliquer
                </button>

            </form>
        </div>
        <?php
        if (empty($offers)) {
            echo "<p class='text-center text-lg text-gray-500'>Aucun partenaire disponible pour le moment.</p>";
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
                
                
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($offer->logo_path) && !empty($offer->logo_path) 
                    ? "<img src='" . htmlspecialchars($offer->logo_path) . "' alt='Logo' width='50'>" 
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
                if (isset($offer->value)) echo "%";
                echo "</td>";

        
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