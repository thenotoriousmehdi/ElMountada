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
}
?>