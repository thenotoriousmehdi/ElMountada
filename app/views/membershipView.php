<?php
class MembershipView
{
use View;
    public function Memberships($memberships)
    {
       ?>
        <div class="flex flex-col justify-start gap-6 mt-4 mb-8">
            <div> 
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Réclamez votre carte ElMountada dès aujourd'hui! </h2>
                    <p class="text-start text-[16px] font-openSans font-medium text-principale text-opacity-80">Achetez un abonnement et profitez de toutes les remises et avantages qu'offrent nos nombreux partenaires </p>
                    </div>
                     

            <div class="flex  w-full h-full overflow-y-auto rounded-[15px] p-6 justify-center items-center gap-6">
            <?php
                    foreach ($memberships as $membership) {
                        echo "
                        <div class='w-[300px] bg-text/5 flex flex-col gap-4 justify-center items-center bg-bg px-4 py-6 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg relative'>
                            <h3 class='font-poppins font-bold text-principale text-lg mb-2'>" . htmlspecialchars($membership -> name) . "</h3>
                            <p class='font-openSans text-center font-medium'> <span class='font-bold'></span>  " . htmlspecialchars($membership -> description) . "</p>
                            <button class='bg-primary text-white py-2 px-4 rounded mt-4 hover:bg-primary/80' >Acheter</button>
                        </div>
                        ";
                        
                    }
                    ?>



                        </div>
                    
    
                </div>
                



        
     <?php
    }

public function MembershipCard($membershipCard){
    
?>
<div class="cardcontainer flex flex-col gap-4 justify-center items-center w-full h-full p-24 ">
    <h2 class="font-poppins font-semibold text-text text-[24px]">Ma carte d'abonnement</h2>
    <div class="bg-white shadow-md rounded-lg p-6 w-full sm:w-3/4 md:w-1/2 ">
  <div class="flex flex-col md:flex-row justify-between items-start gap-4 h-auto w-full">

    <div class="flex flex-col justify-start items-start gap-2 w-full sm:w-1/2">

    <img src="<?= ROOTIMG ?>ElMountada4.svg" alt="Logo" class="w-32 h-12" />
   
    <p class="text-center text-principale"> <strong> Identifiant # </strong> <?= htmlspecialchars($membershipCard->user_id); ?></p>
      <p class="text-center text-principale"> <strong> Email</strong>  <?= htmlspecialchars($membershipCard->email); ?></p>
      <p class="text-center text-principale"> <strong> Nom complet</strong>  <?= htmlspecialchars($membershipCard->full_name); ?></p>
      <p class="text-center text-principale"> <strong> Téléphone</strong> <?= htmlspecialchars($membershipCard->phone_number); ?></p>


      <p class="text-center text-principale"> <strong> Date de facturation  </strong><?= htmlspecialchars($membershipCard->billing_date); ?></p>

      
    </div>

    <div class="bg-bg flex justify-center items-center p-2 rounded-[10px] h-full w-full sm:w-1/2">
      <img src="<?= htmlspecialchars($membershipCard->QrCode); ?>" alt="" class="w-full h-full rounded-md object-contain">
    </div>
  </div>
</div>

</div>

<?php
}




}
?>