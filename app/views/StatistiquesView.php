<?php
class StatistiquesView
{

    use View;
    public function Statistiques($userData, $donationsData)
    {
?>
        <div class=" mx-auto p-32">
            <h1 class="text-3xl font-semibold text-center mb-6">Statistiques des utilisateurs</h1>

            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-bold">Total des Membres</h2>
                    <p class="text-2xl"><?= $userData[0]->total_members ?></p>
                </div>
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg  shadow-md text-center">
                    <h2 class="text-xl font-bold">Total des Utilisateurs</h2>
                    <p class="text-2xl"><?= $userData[0]->total_users ?></p>
                </div>
                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-bold">Total des Partenaires</h2>
                    <p class="text-2xl"><?= $userData[0]->total_partners ?></p>
                </div>

                <div class="bg-white bg-opacity-80 text-text p-4 rounded-lg shadow-md text-center">
                    <h2 class="text-xl font-bold">Total Donations</h2>
                    <p class="text-2xl"><?= $donationsData[0]->total_donations  ?> DA</p>
                </div>


            </div>


        </div>
<?php
    }
}
?>