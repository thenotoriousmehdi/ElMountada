<?php
class PartnersView
{
    use View;
    public function PartnerSection($title, $partners)
    {
        ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text"><?= htmlspecialchars($title) ?></h2>

            <div class="bg-text bg-opacity-5 w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                <div class="flex flex-wrap gap-4 justify-start">
                    <?php
                    foreach ($partners as $partner) {
                        echo "
                        <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg relative'>
                            <div class='absolute top-2 right-2'>
                                <button onclick='addToFavorites(" . htmlspecialchars($partner['id']) . ")' class='p-2 bg-bg border border-primary border-opacity-50 rounded-[10px] shadow hover:bg-[#E76F51] hover:bg-opacity-70 '>
                                   <img src='./public/assets/star.svg' alt='Add to Favorites' class='h-6 w-6'>
                                </button>
                            </div>
                            <img src='" . htmlspecialchars($partner['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                            <h3 class='font-poppins font-bold text-lg mb-2'>" . htmlspecialchars($partner['name']) . "</h3>
                            <p class='font-openSans font-semibold'> <span class='font-bold'>Ville</span>  " . htmlspecialchars($partner['ville']) . "</p>
                            <p class='font-openSans font-semibold'><span class='font-bold'>Réduction</span> " . htmlspecialchars($partner['reduction']) . "%</p>
                            <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails(" . htmlspecialchars($partner['id']) . ")'>Voir plus</button>
                        </div>
                        ";
                        
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    public function Hotels($partnersH)
    {
        $this->PartnerSection("Hôtels", $partnersH);
    }

    public function Cliniques($partnersC)
    {
        $this->PartnerSection("Cliniques", $partnersC);
    }

    public function Ecoles($partnersE)
    {
        $this->PartnerSection("Ecoles", $partnersE);
    }

    public function AgencesDeVoyages($partnersA)
    {
        $this->PartnerSection("Agences de voyages", $partnersA);
    }
    
public function displayFilterForm($cities)
{
    ?>
    <div class="flex flex-col justify-start gap-2 mb-8">
        <form method="POST" class="bg-text bg-opacity-5 p-4 rounded-[15px]">
            <div class="flex gap-4 items-end">
                <div class="flex flex-col gap-2">
                    <label for="categorie" class="font-poppins font-semibold">Catégorie</label>
                    <select name="categorie" id="categorie" class="p-2  rounded-lg border border-text/20">
                        <option value="">Toutes les catégories</option>
                        <option value="1" <?= isset($_POST['categorie']) && $_POST['categorie'] == '1' ? 'selected' : '' ?>>Hôtels</option>
                        <option value="2" <?= isset($_POST['categorie']) && $_POST['categorie'] == '2' ? 'selected' : '' ?>>Cliniques</option>
                        <option value="3" <?= isset($_POST['categorie']) && $_POST['categorie'] == '3' ? 'selected' : '' ?>>Ecoles</option>
                        <option value="4" <?= isset($_POST['categorie']) && $_POST['categorie'] == '4' ? 'selected' : '' ?>>Agences de voyage</option>
                    </select>
                </div>
                
                <div class="flex flex-col gap-2">
                    <label for="ville" class="font-poppins font-semibold">Ville</label>
                    <select name="ville" id="ville" class="p-2 rounded-lg border border-text/20">
                        <option value="">Toutes les villes</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?= htmlspecialchars($city) ?>" <?= isset($_POST['ville']) && $_POST['ville'] == $city ? 'selected' : '' ?>>
                                <?= htmlspecialchars($city) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <button type="submit" name="filter_submit" class="bg-text text-white py-2 px-6 rounded-lg hover:bg-text/80">
                    Filtrer
                </button>
            </div>
        </form>
    </div>
    <?php
}

}



?>