<?php
class Partners
{
    public function PartnerSection($title, $partners)
    {
        ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-center text-[24px] font-poppins font-bold text-text"><?= htmlspecialchars($title) ?></h2>

            <div class="bg-text bg-opacity-5 w-full rounded-[15px] p-6">
                <div class="flex flex-wrap gap-4 justify-start">
                    <?php
                    foreach ($partners as $partner) {
                        echo "
                        <div class='w-[300px] flex flex-col justify-center items-center bg-bg p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg'>
                            <img src='" . htmlspecialchars($partner['logo_path']) . "' alt='Partner Logo' class='h-16  object-contain'>
                            <h3 class='font-poppins font-bold text-lg mb-2'>" . htmlspecialchars($partner['name']) . "</h3>
                            <p class='font-openSans font-semibold'>Ville: " . htmlspecialchars($partner['ville']) . "</p>
                            <p class='font-openSans font-semibold'>Réduction: " . htmlspecialchars($partner['reduction']) . "%</p>
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
}



?>