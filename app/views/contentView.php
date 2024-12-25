<?php
class ContentView
{
use View;
    public function addContent()
    {
        ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter un contenu</h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
                <form action="/ElMountada/content/store" method="POST" enctype="multipart/form-data" class="space-y-4">

                    <div>
                        <label for="title" class="text-[16px] font-poppins font-medium text-text">Titre</label>
                        <input type="text" id="title" name="title" required placeholder="Titre"
                            class="mt-1   border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] ">
                    </div>


                    <div>
                        <label for="description" class="text-[16px] font-poppins font-medium text-text">Description</label>
                        <textarea id="description" name="description" rows="4" required placeholder="Description"
                            class="mt-1  w-full border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px] p-4 "></textarea>
                    </div>


                    <div>
                        <label for="type" class="text-[16px] font-poppins font-medium text-text">Type</label>
                        <select id="type" name="type" required
                            class="mt-1  w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                            <option value="">Type</option>
                            <option value="announce">Announce</option>
                            <option value="nouvelle">Nouvelle</option>
                            <option value="evenement">Evenement</option>
                            <option value="activite">Activité</option>
                        </select>
                    </div>


                    <div>
                        <label for="event_date" class="text-[16px] font-poppins font-medium text-text">Date</label>
                        <input type="date" id="event_date" name="event_date" placeholder="JJ-MM-AAAA"
                            class="mt-1  w-full p-4 rounded-[10px] border border-primary/20 focus-within:border-primary focus:outline-none">
                    </div>


                    <div>
                        <label for="image" class="text-[16px] font-poppins font-medium text-text">Image</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="mt-1 w-full  text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary  hover:file:text-bg hover:file:bg-primary">
                    </div>


                    <div>
                        <label for="location" class="text-[16px] font-poppins font-medium text-text">Localisation</label>
                        <input type="text" id="location" name="location" required placeholder="Localisation"
                            class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90  text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <?php
    }
}
?>