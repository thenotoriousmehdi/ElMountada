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
                        <input type="file" id="document" name="document" accept="application/zip"
                        class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
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

    public function MesDons($mesDons)
    {
    ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mes Dons</h2>

            <?php if (empty($mesDons)): ?>
                <div class="bg-text/5 flex justify-center items-center shadow-sm w-full h-[470px] overflow-y-auto rounded-[15px] p-6">
<div class="flex justify-center items-center bg-white shadow-md rounded-lg"> 
                    <p class="text-center text-text/80">Aucun don trouvé.</p>
                </div>

                </div>
            <?php else: ?>

                <div class="bg-text/5 shadow-sm w-full h-[470px] overflow-y-auto rounded-[15px] p-6">
                    <div class="flex flex-wrap gap-4">
                        <?php foreach ($mesDons as $mesdons): ?>
                            <div class="flex flex-col justify-between  md:flex-row flex-wrap w-full items-center  border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md ">
                                <h3 class="text-lg w-1/6 font-semibold  text-text text-center"><?= htmlspecialchars($mesdons->somme); ?>DA</h3>
                                <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($mesdons->category_name); ?></p>
                                <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($mesdons->created_at); ?></p>
                                <a href="<?= htmlspecialchars($mesdons->recu); ?>"
                                    class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                                    download="<?= htmlspecialchars($mesdons->recu); ?>">
                                    Reçu
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

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
                        <input type="text" id="somme" name="somme" required placeholder="Montant Da"
                            class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] ">
                    </div>


                    <div>
                        <label for="recu" class="text-[16px] font-poppins font-medium text-text">Reçu de donation</label>
                        <input type="file" id="recu" name="recu" accept="application/pdf"
                        class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
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

    public function Dons($categoryCounts, $sessionData,  $donationsRequests, $donations, $donationsDone)
    {
    ?>

        <?php if ((!isset($sessionData['user_type']) || $sessionData['user_type'] != 'admin')): ?>
            <div class="flex flex-col justify-start gap-4 mt-4 mb-8">

            <div class="flex  w-full items-center justify-between"> 
                <h2 class="text-start text-[24px] font-poppins font-bold text-text">Dons </h2>
                <a href="<?= ROOTIMG ?>mehdi.pdf" 
               
                 download="ReglesDeDons.pdf" 
                 class="inline-flex items-center gap-2 px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                 <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                 <polyline points="7 10 12 15 17 10"></polyline>
                <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
                 Plus d'informations
                </a>
                </div>





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
                                <div class=" flex justify-between  w-full gap-2 border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md">

                                    <div class="flex flex-col md:flex-row flex-wrap w-full items-center ">
                                        <h3 class="text-lg w-1/6 font-semibold  text-text text-center"><?= htmlspecialchars($request->name); ?></h3>
                                        <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($request->dob); ?></p>
                                        <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($request->aid_type); ?></p>
                                        <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($request->description); ?></p>
                                        <a href="<?= htmlspecialchars($request->document); ?>"
                                            class="text-white  bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                                            download="<?= htmlspecialchars($request->document); ?>">
                                            Dossier
                                        </a>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <a class=" bg-bg  border-2 border-[#f12323] hover:bg-[#f12323] hover:bg-opacity-10 p-4 rounded-[10px]"
                                         href="javascript:void(0);"
                                            onclick="confirmRefuseRequest(<?= htmlspecialchars($request->id) ?>)">
                        
                                            <img src="<?= ROOTIMG ?>cross.svg" alt="refuser" class=" size-5" />
                                        </a>
                                        <a class=" bg-[#0c9621] bg-opacity-50 hover:bg-[#0c9621] hover:bg-opacity-40   p-4 rounded-[10px] " 
                                        href="javascript:void(0);"
                                        onclick="confirmAcceptRequest(<?= htmlspecialchars($request->id) ?>)">
                                            <img src="<?= ROOTIMG ?>done.svg" alt="confirm" class=" size-6" />
                                        </a>
                                    </div>




                                </div>

                            <?php endforeach; ?>

                            <script>
                                    function confirmRefuseRequest(id) {
                                        const isConfirmed = confirm("Etes vous sur de vouloir refuser cette demande de donation?");
                                        if (isConfirmed) {
                                            window.location.href = '/ElMountada/dons/refuseRequest/?id=' + id;
                                        }
                                    }

                                    function confirmAcceptRequest(id) {
                                        const isConfirmed = confirm("Etes vous sur de vouloir Accepter cette demande de donation?");
                                        if (isConfirmed) {
                                            window.location.href = '/ElMountada/dons/acceptRequest/?id=' + id;
                                        }
                                    }

                                   
                                </script>
                        </div>
                    </div>
                </div>



                <div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Liste de dons </h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($donations as $don): ?>
                                <div class="flex flex-col justify-between md:flex-row flex-wrap w-full items-center  border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md ">
                                    <h3 class="text-lg  font-semibold  text-text text-center"><?= htmlspecialchars($don->name); ?></h3>
                                    <p class="text-center   text-principale "> <?= htmlspecialchars($don->aid_type); ?></p>
                                    <p class="text-center   text-principale "> <?= htmlspecialchars($don->donation_category_id ?? 'N/A'); ?> </p>
                                    <a href="<?= htmlspecialchars($don->document); ?>"
                                        class="text-white  bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                                        download="<?= htmlspecialchars($don->document); ?>">
                                        Dossier
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>




                <div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Dons effectués par les membres en attente de confirmation</h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
                        <div class="flex flex-wrap gap-4">
                            <?php foreach ($donationsDone as $donDone): ?>
                                <div class=" flex justify-between  w-full gap-2 border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md">
                                    <div class="flex flex-col md:flex-row flex-wrap w-full items-center ">
                                        <h3 class="text-lg w-1/6 font-semibold  text-text text-center"><?= htmlspecialchars($donDone->user_name); ?></h3>
                                        <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($donDone->somme); ?></p>
                                        <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($donDone->category_name); ?></p>
                                        <a href="<?= htmlspecialchars($donDone->recu); ?>"
                                            class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                                            download="<?= htmlspecialchars($donDone->recu); ?>">
                                            Reçu
                                        </a>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a class=" bg-bg  border-2 border-[#f12323] hover:bg-[#f12323] hover:bg-opacity-10 p-4 rounded-[10px] "
                                            href="javascript:void(0);"
                                            onclick="confirmRefuseDonation(<?= htmlspecialchars($donDone->id) ?>)">
                                            <img src="<?= ROOTIMG ?>cross.svg" alt="refuser" class=" size-5" />
                                        </a>
                                        <a class=" bg-[#0c9621] bg-opacity-50 hover:bg-[#0c9621] hover:bg-opacity-40   p-4 rounded-[10px] "
                                            href="javascript:void(0);"
                                            onclick="confirmAcceptDonation(<?= htmlspecialchars($donDone->id) ?>)">
                                            <img src="<?= ROOTIMG ?>done.svg" alt="confirm" class=" size-6" />
                                        </a>
                                    </div>
                                </div>
                                <script>
                                    function confirmRefuseDonation(id) {
                                        const isConfirmed = confirm("Etes vous sur de vouloir refuser cette donation?");
                                        if (isConfirmed) {
                                            window.location.href = '/ElMountada/dons/refuseDonation/?id=' + id;
                                        }
                                    }

                                    function confirmAcceptDonation(id) {
                                        const isConfirmed = confirm("Etes vous sur de vouloir accepter cette donation?");
                                        if (isConfirmed) {
                                            window.location.href = '/ElMountada/dons/acceptDonation/?id=' + id;
                                        }
                                    }
                                </script>
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