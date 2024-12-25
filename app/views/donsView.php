<?php
class DonsView
{
    use View;
    public function demanderUnDon()
    {
?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter une demande de don</h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
                <form action="/ElMountada/dons/storeRequest/" method="POST" enctype="multipart/form-data" class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label for="name" class="text-[16px] font-poppins font-medium text-text">Nom</label>
                        <input type="text" id="name" name="name" required placeholder="Nom complet"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                    </div>



                    <!-- Date of Birth -->
                    <div>
                        <label for="dob" class="text-[16px] font-poppins font-medium text-text">Date de naissance</label>
                        <input type="date" id="dob" name="dob" required
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]">
                    </div>

                    <!-- Aid Type -->

                    <div>
                        <label for="aid_type" class="text-[16px] font-poppins font-medium text-text">Type d'aide</label>
                        <select id="aid_type" name="aid_type" required
                            class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                            <option value="">Sélectionner une type</option>
                            <option value="1">Alimentation</option>
                            <option value="2">Vêtements</option>
                            <option value="3">Santé</option>
                            <option value="4">Éducation</option>
                            <option value="5">Logement</option>
                            <option value="6">Environnement</option>
                            <option value="7">Animaux</option>
                            <option value="8">Technologie</option>
                            <option value="9">Culture</option>
                            <option value="10">Aide d’urgence</option>
                            <option value="11">Ramadan</option>
                            <option value="12">Aide</option>
                        </select>
                    </div>
                    <!-- Description -->
                    <div>
                        <label for="description" class="text-[16px] font-poppins font-medium text-text">Description</label>
                        <textarea id="description" name="description" required placeholder="Décrivez votre demande"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px]"></textarea>
                    </div>

                    <!-- Document -->
                    <div>
                        <label for="document" class="text-[16px] font-poppins font-medium text-text">Document justificatif</label>
                        <input type="file" id="document" name="document" accept="application/pdf"
                            class="mt-1 w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Soumettre la demande
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php



    }


    public function faireUnDon()
    {
    ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter une donation</h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
                <form action="/ElMountada/dons/store" method="POST" enctype="multipart/form-data" class="space-y-4">

                    <div>
                        <label for="somme" class="text-[16px] font-poppins font-medium text-text">Montant de la donation</label>
                        <input type="text" id="somme" name="somme" required placeholder="Montant"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] ">
                    </div>


                    <div>
                        <label for="recu" class="text-[16px] font-poppins font-medium text-text">Reçu de donation</label>
                        <input type="file" id="recu" name="recu" accept="application/pdf"
                            class="mt-1 w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
                    </div>


                    <div>
                        <label for="donation_category_id" class="text-[16px] font-poppins font-medium text-text">Catégorie de donation</label>
                        <select id="donation_category_id" name="donation_category_id" required
                            class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                            <option value="">Sélectionner une catégorie</option>
                            <option value="1">Alimentation</option>
                            <option value="2">Vêtements</option>
                            <option value="3">Santé</option>
                            <option value="4">Éducation</option>
                            <option value="5">Logement</option>
                            <option value="6">Environnement</option>
                            <option value="7">Animaux</option>
                            <option value="8">Technologie</option>
                            <option value="9">Culture</option>
                            <option value="10">Aide d’urgence</option>
                            <option value="11">Ramadan</option>
                            <option value="12">Aide</option>
                        </select>
                    </div>


                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Ajouter la donation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    <?php
    }

    public function Dons($categoryCounts, $sessionData,  $donationsRequests)
    {
    ?>

        <?php if ((!isset($sessionData['user_type']) || $sessionData['user_type'] != 'admin')): ?>
            <div class="flex flex-col justify-start gap-2 mb-8">
                <h2 class="text-start text-[24px] font-poppins font-bold text-text">Dons </h2>

                <div class="flex flex-col justify-end gap-4">


                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($categoryCounts as $category): ?>
                                <div class="w-[222px] border border-primary/20  bg-white hover:bg-[#E76F51] hover:bg-opacity-30 p-4 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105">
                                    <h3 class="text-lg font-semibold text-text text-center"><?= htmlspecialchars($category->name); ?></h3>
                                    <p class="text-center text-principale"> <?= htmlspecialchars($category->donation_count); ?> Dossiers</p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="flex gap-2">

                        <a class="w-full bg-bg  border-2 border-text hover:bg-text text-center hover:bg-opacity-20 text-text font-poppins font-bold p-4 rounded-[10px] focus:outline-none focus:shadow-outline" href="/ElMountada/dons/showRequestDon/">
                            <button>
                                Demander un don
                            </button>
                        </a>
                        <a class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg text-center font-poppins font-bold p-4 rounded-[10px] focus:outline-none focus:shadow-outline" href="/ElMountada/dons/showAddDon/">
                            <button>
                                Faire un don
                            </button>
                        </a>

                    </div>


                </div>


            </div>
        <?php endif; ?>

        <?php if (isset($sessionData['user_type']) && $sessionData['user_type'] == 'admin'): ?>

            <div class="flex flex-col justify-start gap-4">

                <div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Demandes de dons</h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($donationsRequests as $request): ?>
                                <div class=" flex  w-full gap-2 border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md">
                                    <h3 class="text-lg font-semibold w-1/6 text-text text-center"><?= htmlspecialchars($request->name); ?></h3>
                                    <p class="text-center w-1/6 text-principale "> <?= htmlspecialchars($request->dob); ?></p>
                                    <p class="text-center w-1/6 text-principale "> <?= htmlspecialchars($request->aid_type); ?></p>
                                    <p class="text-center w-1/6 text-principale "> <?= htmlspecialchars($request->description); ?></p>
                                    <a href="<?= htmlspecialchars($request->document); ?>"
                                        class="text-white bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                                        download="<?= htmlspecialchars($request->document); ?>">
                                        Document
                                    </a>
                                    <div class="flex items-center gap-2">

                                        <a class=" bg-bg  border-2 border-[#f12323] hover:bg-[#f12323] hover:bg-opacity-20 p-4 rounded-[10px] " href="/ElMountada/dons/showRequestDon/">
                                            <img src="<?= ROOTIMG ?>cross.svg" alt="refuser" class=" size-5" />
                                        </a>
                                        <a class=" bg-[#0c9621] bg-opacity-50 hover:bg-[#0c9621] hover:bg-opacity-30   p-4 rounded-[10px] " href="/ElMountada/dons/showAddDon/">
                                            <img src="<?= ROOTIMG ?>done.svg" alt="confirm" class=" size-6" />
                                        </a>

                                    </div>

                                </div>

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>



                <div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Liste de dons  </h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($donationsRequests as $request): ?>
                                

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Dons effectués par les membres en attente de confirmation</h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($donationsRequests as $request): ?>
                                

                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

















            </div>
        <?php endif; ?>
<?php
    }
}
?>