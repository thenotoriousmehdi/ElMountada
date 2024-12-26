<?php
class ContentView
{
use View;


public function Content($content)
{
    ?>
<div class="flex flex-col justify-start gap-2 mt-4 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Découvrez toutes les Nouvautés de ElMountada! </h2>
                    <div class="bg-bg shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6"> 
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($content as $item): ?>
                    <div
                        class="bg-principale/5 shadow-lg rounded-lg overflow-hidden transition duration-300 ease-in-out transform hover:scale-105 flex flex-col h-full">
                        <?php if (!empty($item -> image_path)): ?>
                            <img src="<?php echo htmlspecialchars($item -> image_path); ?>"
                                alt="<?php echo htmlspecialchars($item -> title); ?>" class="w-full h-48 object-cover">
                        <?php endif; ?>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm rounded-full px-4 py-1 uppercase 
                            <?php echo match (strtolower($item -> type)) {
                                'announce' => 'bg-blue-100 text-blue-800',
                                'nouvelle' => 'bg-green-100 text-green-800',
                                'evenement' => 'bg-yellow-100 text-yellow-800',
                                'activite' => 'bg-purple-100 text-purple-800',
                                default => 'bg-gray-100 text-gray-800'
                            }; ?>">
                                    <?php echo htmlspecialchars($item -> type); ?>
                                </span>
                                <?php if (!empty($item -> event_date)): ?>
                                    <span class="text-sm text-gray-500">
                                        <?php echo htmlspecialchars(date('M d, Y', strtotime($item -> event_date))); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <h3 class="text-xl font-poppins font-bold text-gray-800 mb-3">
                                <?php echo htmlspecialchars($item -> title); ?>
                            </h3>
                            <p class="text-gray-600 font-openSans mb-4 flex-grow">
                                <?php echo htmlspecialchars(substr($item -> description, 0, 150) . (strlen($item -> description) > 150 ? '...' : '')); ?>
                            </p>
                            <?php if (!empty($item -> location)): ?>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <?php echo htmlspecialchars($item -> location); ?>
                                </div>
                            <?php endif; ?>
                            <div class="flex justify-end mt-auto">
                                <a href="<?php echo htmlspecialchars($item -> details_link ?? '#'); ?>"
                                    class="inline-block bg-[#264653] text-white px-4 py-2 rounded hover:bg-text/80 transition duration-300">
                                    Plus de détails
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
                </div>
                </div>

 <?php
}








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