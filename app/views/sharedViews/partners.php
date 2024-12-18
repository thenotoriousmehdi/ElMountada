<?php
class Partners
{

    public function Hotels($partnersH)
    {
        ?>
          <div class="flex flex-col justify-start gap-2 mb-8">
        <h2 class="text-start text-[24px] font-poppins font-bold text-text">Hôtels</h2>

        <div class="bg-text bg-opacity-5 w-full rounded-[15px] overflow-y-auto p-6">
            <div class="flex flex-wrap gap-4 justify-start">
                <?php
                foreach ($partnersH as $hotel) {
                    echo "
                    <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg'>
                        <img src='" . htmlspecialchars($hotel['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>{$hotel['name']}</h3>
                        <p class='font-openSans font-semibold'>Ville {$hotel['ville']}</p>
                        <p class='font-openSans font-semibold'>Réduction {$hotel['reduction']}%</p>
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails({$hotel['id']})'>Voir plus</button>
                    </div>
                    ";
                }
                
                ?>
            </div>
        </div>
    </div>
        <?php
    }

    public function Cliniques($partnersC)
    {
        ?>
           <div class="flex flex-col justify-start gap-2 mb-8">
        <h2 class="text-start text-[24px] font-poppins font-bold text-text">Cliniques</h2>

        <div class="bg-text bg-opacity-5 w-full rounded-[15px] p-6">
            <div class="flex flex-wrap gap-4 justify-start">
                <?php
                foreach ($partnersC as $clinique) {
                    echo "
                    <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg'>
                        <img src='" . htmlspecialchars($clinique['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>{$clinique['name']}</h3>
                        <p class='font-openSans font-semibold'>Ville: {$clinique['ville']}</p>
                        <p class='font-openSans font-semibold'>Réduction: {$clinique['reduction']}%</p>
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails({$clinique['id']})'>Voir plus</button>
                    </div>
                    ";
                }
                
                ?>
            </div>
        </div>
    </div>
        <?php
    }


    public function Ecoles($partnersE)
    {
        ?>
            <div class="flex flex-col justify-start gap-2 mb-8">
        <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ecoles</h2>

        <div class="bg-text bg-opacity-5 w-full rounded-[15px] p-6">
            <div class="flex flex-wrap gap-4 justify-start">
                <?php
                foreach ($partnersE as $Ecole) {
                    echo "
                    <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg'>
                        <img src='" . htmlspecialchars($Ecole['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>{$Ecole['name']}</h3>
                        <p class='font-openSans font-semibold'>Ville: {$Ecole['ville']}</p>
                        <p class='font-openSans font-semibold'>Réduction: {$Ecole['reduction']}%</p>
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails({$Ecole['id']})'>Voir plus</button>
                    </div>
                    ";
                }
                
                ?>
            </div>
        </div>
    </div>
        <?php
    }

    public function AgencesDeVoyages($partnersA)
    {
        ?>
            <div class="flex flex-col justify-start gap-2 mb-4">
        <h2 class="text-start text-[24px] font-poppins font-bold text-text">Agences de voyages</h2>

        <div class="bg-text bg-opacity-5 w-full rounded-[15px] p-6">
            <div class="flex flex-wrap gap-4 justify-start">
                <?php
                foreach ($partnersA as $Agence) {
                    echo "
                    <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg'>
                        <img src='" . htmlspecialchars($Agence['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>{$Agence['name']}</h3>
                        <p class='font-openSans font-semibold'>Ville: {$Agence['ville']}</p>
                        <p class='font-openSans font-semibold'>Réduction: {$Agence['reduction']}%</p>
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails({$Agence['id']})'>Voir plus</button>
                    </div>
                    ";
                }
                
                ?>
            </div>
        </div>
    </div>
        <?php
    }
    

    










}
?>