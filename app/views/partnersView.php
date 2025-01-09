<?php
class PartnersView
{
    use View;

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
                            <button onclick='addToFavorites(" . htmlspecialchars($partner->partner_id) . ")' class='p-2 bg-bg border border-primary border-opacity-50 rounded-[10px] shadow hover:bg-[#E76F51] hover:bg-opacity-70 '>
                               <img src='/ElMountada/public/assets/star.svg' alt='Add to Favorites' class='h-6 w-6'>
                            </button>
                        </div>
                        <img src='" . htmlspecialchars($partner->logo_path) . "' alt='Partner Logo' class='h-16  object-contain'>
                        <h3 class='font-poppins font-bold text-lg mb-2'>" . htmlspecialchars($partner->full_name) . "</h3>
                        <p class='font-openSans font-semibold'> " . htmlspecialchars($partner->ville) . "</p>
                        
                        <button class='bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80' onclick='viewDetails(" . htmlspecialchars($partner->partner_id) . ")'>Voir plus</button>
                    </div>
                    ";
                    }
                    ?>
                </div>
            </div>
        </div>

        <script>
            function viewDetails(partnerId) {
                window.location.href = '/ElMountada/partners/showPartnerDetails/?id=' + partnerId;
            }
        </script>

    <?php
    }


    public function partnerDetails($partner)
    {
    ?>
        <div class="mx-auto p-6">
            <div class="bg-white p-6 rounded-lg shadow-lg">

                <div class="text-center mb-6">
                    <h2 class="text-4xl font-semibold text-gray-800"><?= htmlspecialchars($partner->full_name ?? 'N/A') ?></h2>
                    <p class="text-xl text-gray-600"><?= htmlspecialchars($partner->category_name ?? 'N/A') ?></p>
                </div>


                <div class="flex justify-center items-center bg-text pb-8 rounded-[15px] bg-opacity-10 gap-8 mb-8">
                    <div class="flex flex-col items-center">
                        <img src="<?= htmlspecialchars($partner->logo_path) ?>" alt="Partner Logo" class="h-32 w-32 object-contain rounded-full mb-4">
                        <p class="text-lg text-gray-600"><?= htmlspecialchars($partner->partner_description ?? 'N/A') ?></p>
                        <p class="text-md text-gray-500"><strong>Ville</strong> <?= htmlspecialchars($partner->ville ?? 'N/A') ?></p>
                        <p class="text-md text-gray-500"><strong>Adresse</strong> <?= htmlspecialchars($partner->adresse ?? 'N/A') ?></p>
                        <p class="text-md text-gray-500"><strong>Email</strong> <?= htmlspecialchars($partner->email ?? 'N/A') ?></p>
                        <p class="text-md text-gray-500"><strong>Numéro</strong> <?= htmlspecialchars($partner->phone_number ?? 'N/A') ?></p>
                    </div>
                </div>


                <div class="mb-8">
                    <h3 class="text-3xl font-semibold text-gray-800 mb-4">Reductions</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php
                        $reductions = !empty($partner->reductions) ? explode(',', $partner->reductions) : [];
                        $reductionMembershipTypes = !empty($partner->reduction_membership_type_names) ? explode(',', $partner->reduction_membership_type_names) : [];
                        if (empty($reductions)) {
                            echo "<p class='text-gray-500'>Aucune réduction disponible</p>";
                        } else {
                            $seenMembershipTypes = [];
                            foreach ($reductionMembershipTypes as $key => $type) {
                                if (!in_array($type, $seenMembershipTypes)) {
                                    echo "
                                <div class='bg-[#E9C46A] bg-opacity-20 p-4 rounded-lg shadow-md'>
                                    <h4 class='text-xl font-semibold text-gray-700'>$type</h4>
                                    <ul class='mt-2 text-gray-600'>
                                        <li>" . htmlspecialchars($reductions[$key] ?? 'N/A') . "%</li>
                                    </ul>
                                </div>";
                                    $seenMembershipTypes[] = $type;
                                }
                            }
                        }
                        ?>
                    </div>


                    <h3 class="text-3xl font-semibold text-gray-800 mt-8 mb-4">Avantages</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <?php

                        $advantages = !empty($partner->advantages) ? explode(',', $partner->advantages) : [];
                        $advantageMembershipTypes = !empty($partner->advantage_membership_type_names) ? explode(',', $partner->advantage_membership_type_names) : [];


                        if (empty($advantages)) {
                            echo "<p class='text-gray-500'>Aucun avantage disponible</p>";
                        } else {
                            $seenAdvantageMembershipTypes = [];
                            foreach ($advantageMembershipTypes as $key => $type) {

                                if (!in_array($type, $seenAdvantageMembershipTypes)) {
                                    echo "
                                <div class='bg-primary bg-opacity-20 p-4 rounded-lg shadow-md'>
                                    <h4 class='text-xl font-semibold text-gray-700'>$type</h4>
                                    <ul class='mt-2 text-gray-600'>
                                        <li>" . htmlspecialchars($advantages[$key] ?? 'N/A') . "</li>
                                    </ul>
                                </div>";

                                    $seenAdvantageMembershipTypes[] = $type;
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
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


    public function showPartnersByCategory($categoryTitle, $partners)
    {
        if (isset($_POST['filter_submit'])) {
            $filteredPartners = $this->filterPartners($partners);
            $this->PartnerSection($categoryTitle, $filteredPartners);
        } else {
            $this->PartnerSection($categoryTitle, $partners);
        }
    }


    private function filterPartners($partners)
    {
        if (empty($partners)) {
            return [];
        }

        return array_filter($partners, function ($partner) {
            if (!empty($_POST['ville']) && $partner->ville !== $_POST['ville']) {
                return false;
            }
            return true;
        });
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
                    <p class="text-center text-principale"> <strong> Identifiant # </strong> <?= htmlspecialchars($partnerCard->partner_id ?? 'N/A'); ?></p>
                    <p class="text-center text-principale"> <strong> Email</strong> <?= htmlspecialchars($partnerCard->email ?? 'N/A'); ?></p>
                    <p class="text-center text-principale"> <strong> Nom</strong> <?= htmlspecialchars($partnerCard->full_name ?? 'N/A') ?: 'null'; ?></p>
                    <p class="text-center text-principale"> <strong> Téléphone</strong> <?= htmlspecialchars($partnerCard->phone_number ?? 'N/A'); ?></p>
                    <p class=" text-principale"> <strong> Ville </strong><?= htmlspecialchars($partnerCard->ville ?? 'N/A'); ?></p>
                    <p class=" text-principale"> <strong> Catégorie </strong><?= htmlspecialchars($partnerCard->category_name ?? 'N/A'); ?></p>

                </div>
            </div>

        </div>

    <?php
    }

    public function CheckMembers($data = [])
    {

        $userData = isset($data['userData']) ? $data['userData'] : null;
        $message = isset($data['message']) ? $data['message'] : '';

    ?>
        <div class="flex justify-center items-center">
            <div class="bg-white shadow-md rounded-lg p-6 w-full sm:w-3/4 md:w-1/2 m-8">
                <h1 class="text-2xl font-poppins font-semibold text-center text-gray-800 mb-6">Vérifier un Membre</h1>

                <form method="POST" class="mb-6">
                    <label for="user_id" class="block text-sm text-gray-600">Entrez un identifiant:</label>
                    <input type="text" id="user_id" name="user_id" required
                        class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-text" />
                    <button type="submit"
                        class="w-full mt-4 py-2 bg-text text-white font-semibold rounded-md hover:bg-text/80 focus:outline-none focus:ring-2 focus:ring-green-500">
                        Rechercher
                    </button>
                </form>

                <?php if ($userData): ?>
                    <div class="flex flex-col lg:flex-row lg:justify-start justify-center items-center lg:items-center gap-4 h-auto w-full">

                        <div class="flex flex-col h-full justify-center md:justify-start gap-2 items-center md:items-start w-full sm:w-1/2">
                            <img src="<?= ROOTIMG ?>ElMountada4.svg" alt="Logo" class="w-32 h-12" />
                            <p class="text-center text-principale"><strong>Identifiant #</strong> <?= htmlspecialchars($userData->user_id ?? 'N/A'); ?></p>
                            <p class="text-center text-principale"><strong>Email</strong> <?= htmlspecialchars($userData->email ?? 'N/A'); ?></p>
                            <p class="text-center text-principale"><strong>Nom complet</strong> <?= htmlspecialchars($userData->full_name ?? 'N/A') ?: 'null'; ?></p>
                            <p class="text-center text-principale"><strong>Téléphone</strong> <?= htmlspecialchars($userData->phone_number ?? 'N/A') ?: 'null'; ?></p>
                            <p class="text-principale"><strong>Plan</strong> <?= htmlspecialchars($userData->membership_type_name ?? 'N/A'); ?></p>
                            <p class="text-principale"><strong>Date de facturation</strong> <?= htmlspecialchars($userData->billing_date ?? 'N/A'); ?></p>
                        </div>

                        <div class="bg-bg flex justify-center items-center p-2 rounded-[10px] h-full w-full sm:w-1/2">
                            <img src="<?= htmlspecialchars($userData->QrCode); ?>" alt="QR Code" class="w-full h-full rounded-md object-contain" />
                        </div>

                    </div>
                <?php elseif ($message): ?>
                    <p class="text-center text-red-500 text-lg mt-4"><?= htmlspecialchars($message); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php
    }

    public function Partners($partners, $villes, $categories)
    {
        echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Gestion des Partenaires</h2>';

        echo '<div class="flex justify-between items-end mb-4">';

        echo '<form action="/ElMountada/partners/ShowPartners" method="POST" class="flex gap-4 items-end">';


        echo '<div class="flex flex-col w-1/3">';
        echo '<label for="ville" class="block text-sm font-semibold mb-2">Ville</label>';
        echo '<select name="ville" id="ville" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">'; // Set fixed height for input
        echo '<option value="">Séléctionnez</option>';
        foreach ($villes as $ville) {
            echo '<option value="' . htmlspecialchars($ville->ville) . '">' . htmlspecialchars($ville->ville) . '</option>';
        }
        echo '</select>';
        echo '</div>';

        echo '<div class="flex flex-col w-1/3">';
        echo '<label for="categorie" class="block text-sm font-semibold mb-2">Catégorie</label>';
        echo '<select name="categorie" id="categorie" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">';
        echo '<option value="">Séléctionnez</option>';
        foreach ($categories as $category) {
            echo '<option value="' . htmlspecialchars($category->name) . '">' . htmlspecialchars($category->name) . '</option>';
        }
        echo '</select>';
        echo '</div>';

        echo '<div class="flex items-center">';
        echo '<button type="submit" class="h-[40px] px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Filtrer</button>';
        echo '</div>';

        echo '</form>';


        echo '<div class="flex gap-2 items-center">';
        echo '<a href="/ElMountada/partners/showAddOffer">';
        echo '<button class="mt-4 inline-flex justify-end gap-2 px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Ajouter une remise/avantage</button>';
        echo '</a>';

        echo '<a href="/ElMountada/partners/showAddPartner">';
        echo '<button class="mt-4 inline-flex justify-end gap-2 px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Ajouter un partenaire</button>';
        echo '</a>';
        echo '</div>';




        echo '</div>';


        if (empty($partners)) {
            echo "<p class='text-center text-lg text-gray-500'>No partners available at the moment.</p>";
        } else {
            echo '<div class="flex flex-col items-end gap-4">';
            echo '<div class="overflow-auto w-full max-h-[700px]">';
            echo '<table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">';
            echo '<thead class="bg-text sticky top-0 z-10">';
            echo '<tr>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom du partenaire</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Catégorie</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Identifiant</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Email</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Ville</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Adresse</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Logo</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Réductions</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Memberships</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Advantages</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Memberships </th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Actions</th>
        </tr>';
            echo '</thead>';

            echo '<tbody>';
            foreach ($partners as $partner) {
                echo "<tr class='border-t border-primary/5 hover:bg-primary/10'>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->full_name) ? htmlspecialchars($partner->full_name ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->category_name) ? htmlspecialchars($partner->category_name ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->partner_id) ? htmlspecialchars($partner->partner_id ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->email) ? htmlspecialchars($partner->email ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->ville) ? htmlspecialchars($partner->ville ?? 'N/A') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->adresse) ? htmlspecialchars($partner->adresse ?? 'N/A') : 'N/A';
                echo "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($partner->logo_path) && !empty($partner->logo_path) ? "<img src='" . htmlspecialchars($partner->logo_path) . "' alt='Logo' width='50'>" : 'No Logo';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($partner->reductions) ? htmlspecialchars($partner->reductions) : 'N/A') . " </td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($partner->reduction_membership_type_names) ? htmlspecialchars($partner->reduction_membership_type_names) : 'N/A') . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($partner->advantages) ? htmlspecialchars($partner->advantages) : 'N/A') . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($partner->advantage_membership_type_names) ? htmlspecialchars($partner->advantage_membership_type_names) : 'N/A') . "</td>";
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";

                echo "<div class='flex flex-col gap-2'>";
                echo "<form action='/ElMountada/partners/deletePartner' method='POST'onsubmit='return confirm(\"Etes vous sure de vouloir supprimer cette partenaire ?\")' >";
                echo "<input type='hidden' name='partner_id' value='" . htmlspecialchars($partner->partner_id) . "'>";
                echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-lg'>Supprimer</button>";
                echo "</form>";

                echo "<a href='/ElMountada/partners/updatePartner/?id=" . htmlspecialchars($partner->partner_id) . "'>";
                echo "<button class='bg-blue-500 text-white px-4 py-2 rounded-lg'>Modifier</button>";
                echo "</a>";
                echo '</div>';



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


    public function addPartner()
    {

    ?>

        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter un partenaire</h2>
            <div class="flex flex-col gap-4 bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
                <form action="/ElMountada/partners/handleAddPartner" method="POST" enctype="multipart/form-data" class="space-y-4">


                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="email" class="text-[16px] font-poppins font-medium text-text">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Adresse email"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="name" class="text-[16px] font-poppins font-medium text-text">Nom</label>
                            <input type="text" id="name" name="name" required placeholder="Nom"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>


                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="phone_number" class="text-[16px] font-poppins font-medium text-text">Numéro de téléphone</label>
                            <input type="tel" id="phone_number" name="phone_number" required placeholder="Numéro de téléphone"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div>
                            <label for="logo" class="text-[16px] font-poppins font-medium text-text">Logo</label>
                            <input type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg"
                                class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-2 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
                        </div>

                    </div>


                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="password" class="text-[16px] font-poppins font-medium text-text">Mot de passe</label>
                            <input type="password" id="password" name="password" required placeholder="Mot de passe "
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="confirmed_password" class="text-[16px] font-poppins font-medium text-text">Confirmer le mot de passe</label>
                            <input type="password" id="confirmed_password" name="confirmed_password" required placeholder="Confirmer le mot de passe"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>


                    <div>
                        <label for="partner_categorie" class="text-[16px] font-poppins font-medium text-text">Catégorie</label>
                        <select id="partner_categorie" name="partner_categorie" required
                            class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                            <option value="">Sélectionner une categorie</option>
                            <option value="1">Hotel</option>
                            <option value="2">Clinique</option>
                            <option value="3">Ecole</option>
                            <option value="4">AgenceDeVoyage</option>

                        </select>
                    </div>

                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="ville" class="text-[16px] font-poppins font-medium text-text">Ville</label>
                            <input type="text" id="ville" name="ville" required placeholder="Ville"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="adresse" class="text-[16px] font-poppins font-medium text-text">Adresse</label>
                            <input type="text" id="adresse" name="adresse" required placeholder="Adresse"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="text-[16px] font-poppins font-medium text-text">Description</label>
                        <textarea id="description" name="description" required placeholder="Décrivez votre demande"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>
        </div>

    <?php
    }


    public function updatePartnerForm($partner)
    {
    ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Modifier le partenaire</h2>
            <div class="flex flex-col gap-4 bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
                <form action="/ElMountada/partners/handleUpdatePartner" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <input type="hidden" name="partner_id" value="<?php echo htmlspecialchars($partner->id); ?>">

                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="email" class="text-[16px] font-poppins font-medium text-text">Email</label>
                            <input type="email" id="email" name="email" required placeholder="Adresse email"
                                value="<?php echo htmlspecialchars($partner->email); ?>"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="name" class="text-[16px] font-poppins font-medium text-text">Nom</label>
                            <input type="text" id="name" name="name" required placeholder="Nom"
                                value="<?php echo htmlspecialchars($partner->full_name); ?>"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="phone_number" class="text-[16px] font-poppins font-medium text-text">Numéro de téléphone</label>
                            <input type="tel" id="phone_number" name="phone_number" required placeholder="Numéro de téléphone"
                                value="<?php echo htmlspecialchars($partner->phone_number); ?>"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div>
                            <label for="logo" class="text-[16px] font-poppins font-medium text-text">Logo</label>
                            <?php if (!empty($partner->logo_path)): ?>
                                <div class="mb-2">
                                    <img src="<?php echo htmlspecialchars($partner->logo_path); ?>" alt="Current Logo" class="h-10 w-10 object-cover">
                                </div>
                            <?php endif; ?>
                            <input type="file" id="logo" name="logo" accept="image/png, image/jpeg, image/jpg"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-2 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="password" class="text-[16px] font-poppins font-medium text-text">Nouveau mot de passe (optionnel)</label>
                            <input type="password" id="password" name="password" placeholder="Laisser vide pour ne pas modifier"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="confirmed_password" class="text-[16px] font-poppins font-medium text-text">Confirmer le nouveau mot de passe</label>
                            <input type="password" id="confirmed_password" name="confirmed_password" placeholder="Confirmer le nouveau mot de passe"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>

                    <div>
                        <label for="partner_categorie" class="text-[16px] font-poppins font-medium text-text">Catégorie</label>
                        <select id="partner_categorie" name="partner_categorie" required
                            class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                            <option value="">Sélectionner une categorie</option>
                            <option value="1" <?php echo ($partner->categorie_id == 1) ? 'selected' : ''; ?>>Hotel</option>
                            <option value="2" <?php echo ($partner->categorie_id == 2) ? 'selected' : ''; ?>>Clinique</option>
                            <option value="3" <?php echo ($partner->categorie_id == 3) ? 'selected' : ''; ?>>Ecole</option>
                            <option value="4" <?php echo ($partner->categorie_id == 4) ? 'selected' : ''; ?>>AgenceDeVoyage</option>
                        </select>
                    </div>
                    <div class="flex items-center justify-between gap-4 w-full">
                        <div class="w-full">
                            <label for="ville" class="text-[16px] font-poppins font-medium text-text">Ville</label>
                            <input type="text" id="ville" name="ville" required placeholder="Ville"
                                value="<?php echo htmlspecialchars($partner->ville); ?>"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>

                        <div class="w-full">
                            <label for="adresse" class="text-[16px] font-poppins font-medium text-text">Adresse</label>
                            <input type="text" id="adresse" name="adresse" required placeholder="Adresse"
                                value="<?php echo htmlspecialchars($partner->adresse); ?>"
                                class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="text-[16px] font-poppins font-medium text-text">Description</label>
                        <textarea id="description" name="description" required placeholder="Décrivez votre demande"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]"><?php echo htmlspecialchars($partner->description); ?></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
<?php
    }


    public function addOffer($users, $membershipTypes)
    {
    ?>
      <div class="flex flex-col justify-start gap-2 mb-8">
    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter une réduction ou avantage</h2>
    <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
    
        <form action="/ElMountada/partners/handleAddOffer" method="POST" class="space-y-4">
        
        
            <div>
                <label for="type" class="text-[16px] font-poppins font-medium text-text">Type </label>
                <select name="type" id="type" required 
                    class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]">
                    <option value="">Type</option>
                    <option value="reduction">Réduction</option>
                    <option value="advantage">Avantage</option>
                </select>
            </div>

           
            <div>
                <label for="user_id" class="text-[16px] font-poppins font-medium text-text">Partenaire</label>
                <select name="user_id" id="user_id" required 
                        class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]">
                    <?php foreach ($users as $user): ?>
                        <option value="<?= $user -> id; ?>"><?= htmlspecialchars($user -> full_name, ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <div>
                <label for="membership_type_id" class="text-[16px] font-poppins font-medium text-text">Choisir le type d'adhésion</label>
                <select name="membership_type_id" id="membership_type_id" required 
                        class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]">
                    <?php foreach ($membershipTypes as $type): ?>
                        <option value="<?= $type -> id; ?>"><?= htmlspecialchars($type -> name , ENT_QUOTES, 'UTF-8'); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

        
            <div id="reductionFields" style="display:none;">
                <label for="reduction_value" class="text-[16px] font-poppins font-medium text-text">Valeur de la réduction</label>
                <input type="number" name="reduction_value" id="reduction_value" min="1" 
                       class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]" placeholder="Entrez la valeur de la réduction">
            </div>

            <div id="advantageFields" style="display:none;">
                <label for="description" class="text-[16px] font-poppins font-medium text-text">Description de l'avantage</label>
                <textarea name="description" id="description" rows="6" 
                          class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]" 
                          placeholder="Entrez la description de l'avantage"></textarea>
            </div>

            <div class="pt-4">
                <button type="submit" 
                        class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                    Ajouter
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    // JavaScript to show/hide fields based on type selection
    document.getElementById('type').addEventListener('change', function() {
        var type = this.value;
        if (type === 'reduction') {
            document.getElementById('reductionFields').style.display = 'block';
            document.getElementById('advantageFields').style.display = 'none';
        } else if (type === 'advantage') {
            document.getElementById('reductionFields').style.display = 'none';
            document.getElementById('advantageFields').style.display = 'block';
        }
    });
</script>
<?php

    }
}
?>