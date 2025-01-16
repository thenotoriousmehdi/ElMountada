<?php
class StatistiquesView
{

    use View;
    public function Statistiques($userData)
    {
        // Assuming $userData is an array containing 'total_users', 'total_partners', 'total_members'
        ?>
        <div class="container mx-auto p-6">
            <h1 class="text-3xl font-semibold text-center mb-6">Statistiques des utilisateurs</h1>
    
            <!-- Total Members, Total Users, Total Partners -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total des Membres</h2>
                    <p class="text-2xl"><?= $userData[0]->total_members ?></p>
                </div>
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg  shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total des Utilisateurs</h2>
                    <p class="text-2xl"><?= $userData[0]->total_users ?></p>
                </div>
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-semibold">Total des Partenaires</h2>
                    <p class="text-2xl"><?= $userData[0]->total_partners ?></p>
                </div>
            </div>
    
          
        </div>
        <?php
    }
     
}
?>