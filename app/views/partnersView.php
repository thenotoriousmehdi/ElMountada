<?php
class PartnersView
{
    use View;
   // General function to display partner section
public function PartnerSection($title, $partners)
{
    ?>
    <div class="flex flex-col justify-start gap-2 mb-8">
        <h2 class="text-start text-[24px] font-poppins font-bold text-text"><?= htmlspecialchars($title) ?></h2>

        <div class="bg-text bg-opacity-5 w-full max-h-[400px] overflow-y-auto rounded-[15px] p-6">
            <div class="flex flex-wrap gap-4 justify-start">
                <?php
                foreach ($partners as $partner) {
                    echo "
                    <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg relative'>
                        <div class='absolute top-2 right-2'>
                            <button onclick='addToFavorites(" . htmlspecialchars($partner->id) . ")' class='p-2 bg-bg border border-primary border-opacity-50 rounded-[10px] shadow hover:bg-[#E76F51] hover:bg-opacity-70 '>
                               <img src='/ElMountada/public/assets/star.svg' alt='Add to Favorites' class='h-6 w-6'>
                            </button>
                        </div>
                        <img src='" . htmlspecialchars($partner->logo_path) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>" . htmlspecialchars($partner->name) . "</h3>
                        <p class='font-openSans font-semibold'> <span class='font-bold'>Ville</span>  " . htmlspecialchars($partner->ville) . "</p>
                        <p class='font-openSans font-semibold'><span class='font-bold'>Réduction</span> " . htmlspecialchars($partner->reduction) . "%</p>
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails(" . htmlspecialchars($partner->id) . ")'>Voir plus</button>
                    </div>
                    ";
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

public function showPartnersByCategory($categoryTitle, $partners)
{
    $this->PartnerSection($categoryTitle, $partners);
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

public function PartnerCard($partnerCard)
{

?>

  <div class="cardcontainer flex flex-col gap-4 justify-center items-center w-full h-full p-24 ">
    <h2 class="font-poppins font-semibold text-text text-[24px]">Ma carte partenaire</h2>
    <div class="bg-white shadow-md rounded-lg p-6 w-full sm:w-3/4 md:w-1/2 ">
      
        <div class="flex flex-col h-full justify-center md:justify-start gap-2 items-center md:items-start w-full sm:w-1/2">

        <h1 class="font-poppins font-semibold text-text text-center text-[24px]">PARTENAIRE</h1>
          <img src="<?= ROOTIMG ?>ElMountada4.svg" alt="Logo" class="w-32 h-12" />
          <p class="text-center text-principale"> <strong> Identifiant # </strong> <?= htmlspecialchars($partnerCard->partner_id); ?></p>
          <p class="text-center text-principale"> <strong> Email</strong> <?= htmlspecialchars($partnerCard->email); ?></p>
          <p class="text-center text-principale"> <strong> Nom</strong> <?= htmlspecialchars($partnerCard->full_name) ?: 'null'; ?></p>
          <p class="text-center text-principale"> <strong> Téléphone</strong> <?= htmlspecialchars($partnerCard ->phone_number) ?: 'null'; ?></p>
          <p class=" text-principale"> <strong> Ville </strong><?= htmlspecialchars($partnerCard->ville); ?></p>
          <p class=" text-principale"> <strong> Catégorie </strong><?= htmlspecialchars($partnerCard->category_name); ?></p>
      
      </div>
    </div>

  </div>

<?php
}


}



?>