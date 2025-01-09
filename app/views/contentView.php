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
                                'benevolat' => 'bg-red-100 text-red-800',
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
                           <a href="/ElMountada/content/showDetails/?id=<?= htmlspecialchars($item->id) ?>"
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


public function ContentDetails($content, $sessionData, $users)
{
    ?>
<div class="mx-auto p-6">
    <div class="bg-white p-6 rounded-lg shadow-lg">

        
        <div class="text-center mb-6">
            <h2 class="text-4xl font-semibold text-gray-800"><?= htmlspecialchars($content->title ?? 'N/A') ?></h2>
            <p class="text-xl text-gray-600"><?= htmlspecialchars($content->type ?? 'N/A') ?></p>
        </div>

        <div class="flex flex-col justify-center items-center bg-gray-100 pb-8 rounded-[15px] bg-opacity-10 gap-4 mb-8">
            <?php if (!empty($content->image_path)): ?>
                <div class="flex flex-col items-center">
                    <img src="<?= htmlspecialchars($content->image_path) ?>" 
                        alt="Content Image" 
                        class="h-64 w-full object-cover rounded-lg mb-4">
                </div>
            <?php endif; ?>
            <div class="text-center">
                <?php if (!empty($content->location)): ?>
                    <p class="text-md text-gray-500"><strong>Lieu:</strong> <?= htmlspecialchars($content->location) ?></p>
                <?php endif; ?>
                <?php if (!empty($content->event_date)): ?>
                    <p class="text-md text-gray-500"><strong>Date:</strong> <?= htmlspecialchars(date('M d, Y', strtotime($content->event_date))) ?></p>
                <?php endif; ?>
                <p class="text-md text-gray-500"><strong>Créé le:</strong> <?= htmlspecialchars(date('M d, Y', strtotime($content->created_at))) ?></p>
                <p class="text-md text-gray-500"><strong>Dernière mise à jour:</strong> <?= htmlspecialchars(date('M d, Y', strtotime($content->updated_at))) ?></p>
            </div>
        </div>

        
        <div class="mb-8">
            <h3 class="text-3xl font-semibold text-gray-800 mb-4">Description</h3>
            <p class="text-gray-700"><?= nl2br(htmlspecialchars($content->description ?? 'N/A')) ?></p>
        </div>

        <?php if (strtolower($content->type ?? '') === 'benevolat'): ?>
            <div class="flex justify-end mt-6">
    <form action="/ElMountada/benevolat/Participer" method="POST" onsubmit="return confirm('Etes-vous sûr de vouloir participer a cet evenement?')"    >
        <input type="hidden" name="content_id" value="<?= htmlspecialchars($content->id) ?>">
        <button type="submit" class="inline-block bg-[#264653] text-white px-4 py-2 rounded hover:bg-[#264653]/80 transition duration-300">
            Participer
        </button>
    </form>



</div>

        <?php endif; ?>

        <?php if (isset($sessionData['user_type']) && $sessionData['user_type'] == 'admin'): ?>

            <div class="mt-8">
    <h3 class="text-3xl font-semibold text-gray-800 mb-4">Liste des participants</h3>
    <table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">
        <thead class="bg-text sticky top-0 z-10">
            <tr>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Name</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Email</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Phone</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Type</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr class="border-t border-primary/5 hover:bg-primary/10">
                        <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($user->full_name) ?></td>
                        <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($user->email) ?></td>
                        <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($user->phone_number) ?></td>
                        <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($user->type) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center border border-gray-300">No participants available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>




        <?php endif; ?>
    </div>
</div>

 <?php
}


public function ContentTable($content, $villes )
{
    echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
    echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Gestion de Contenu</h2>';


    echo '<div class="flex justify-between items-end mb-4">';

    echo '<form action="/ElMountada/content/showContent" method="POST" class="flex gap-4 items-end">'; 
    
    echo '<div class="flex flex-col w-1/3">'; 
echo '<label for="location" class="block text-sm font-semibold mb-2">Ville</label>'; 
echo '<select name="location" id="location" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">'; 
echo '<option value="">Selectionnez</option>';
foreach ($villes as $location) {
    echo '<option value="' . htmlspecialchars($location->location) . '">' . htmlspecialchars($location->location) . '</option>';
}
echo '</select>';
echo '</div>';

    echo '<div class="flex flex-col w-1/3">'; 
    echo '<label for="type" class="block text-sm font-semibold mb-2">Type</label>'; 
    echo '<select name="type" id="type" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">'; 
    echo '<option value="">Type</option>';
    echo '<option value="announce">Announce</option>';
    echo '<option value="nouvelle">Nouvelle</option>';
    echo '<option value="evenement">Evenement</option>';
    echo '<option value="activite">Activité</option>';
    echo '<option value="benevolat">Bénévolat</option>';
    echo '</select>';
    echo '</div>';
    
   
    echo '<div class="flex flex-col w-1/3">'; 
    echo '<label for="event_date" class="block text-sm font-semibold mb-2">Date</label>'; 
    echo '<input type="date" name="event_date" id="event_date" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">';
    echo '</div>';
    

    echo '<div class="flex items-end">'; 
    echo '<button type="submit" class="h-[40px] px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Filter</button>';
    echo '</div>';
    
    echo '</form>';
    
    echo '<a href="/ElMountada/content/showAddContent">';
    echo '<button class="mt-4 inline-flex justify-end gap-2 px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Ajouter un contenu</button>';
    echo '</a>';
    
    echo '</div>';
    

    if (empty($content)) {
        echo "<p class='text-center text-lg text-gray-500'>No content available at the moment.</p>";
    } else {
        echo '<div class="flex flex-col items-end gap-4">';
        echo '<div class="overflow-auto w-full max-h-[700px]">';
        echo '<table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">';
        echo '<thead class="bg-text sticky top-0 z-10">';
        echo '<tr>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Titre</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Type</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Date de l\'évenement</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Crée le</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Lieu</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Image</th>
            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Actions</th>
        </tr>';
        echo '</thead>';

        echo '<tbody>';
        foreach ($content as $item) {
            echo "<tr class='border-t border-primary/5 hover:bg-primary/10'>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo htmlspecialchars($item->title ?? 'N/A');
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo htmlspecialchars($item->type ?? 'N/A');
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo htmlspecialchars($item->event_date ?? 'N/A');
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo htmlspecialchars($item->created_at ?? 'N/A');
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo htmlspecialchars($item->location ?? 'N/A');
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
            echo isset($item->image_path) && !empty($item->image_path) ? "<img src='" . htmlspecialchars($item->image_path) . "' alt='Image' width='50'>" : 'No Image';
            echo "</td>";

            echo "<td class='py-5 px-4 text-sm  font-openSans text-principale'>";

            echo "<div class='flex flex-col gap-2'>";
            echo "<form action='/ElMountada/content/deleteContent' method='POST' onsubmit='return confirm(\"Etes vous sur de vouloir supprimer ce contenu?\")'>";
            echo "<input type='hidden' name='content_id' value='" . htmlspecialchars($item->id) . "'>";
            echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-lg'>Supprimer</button>";
            echo "</form>";

            echo "<a href='/ElMountada/content/showEditContent/?id=" . htmlspecialchars($item->id) . "'>";
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


public function updateContent($content){
?>
<div class="flex flex-col justify-start gap-2 mb-8">
    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Modifier le contenu</h2>
    <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
        <form action="/ElMountada/content/updateContent" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($content->id ?? ''); ?>">
            <input type="hidden" name="existing_image_path" value="<?php echo htmlspecialchars($content->image_path ?? ''); ?>">
            <?php var_dump($content->id); ?>
            <div>
                <label for="title" class="text-[16px] font-poppins font-medium text-text">Titre</label>
                <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($content->title ?? ''); ?>" required placeholder="Titre"
                    class="mt-1 border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] ">
            </div>

            <div>
                <label for="description" class="text-[16px] font-poppins font-medium text-text">Description</label>
                <textarea id="description" name="description" rows="4" required placeholder="Description"
                    class="mt-1 w-full border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px] p-4 "><?php echo htmlspecialchars($content->description ?? ''); ?></textarea>
            </div>

            <div>
                <label for="type" class="text-[16px] font-poppins font-medium text-text">Type</label>
                <select id="type" name="type" required
                    class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
                    <option value="announce" <?php echo ($content->type ?? '') == 'announce' ? 'selected' : ''; ?>>Announce</option>
                    <option value="nouvelle" <?php echo ($content->type ?? '') == 'nouvelle' ? 'selected' : ''; ?>>Nouvelle</option>
                    <option value="evenement" <?php echo ($content->type ?? '') == 'evenement' ? 'selected' : ''; ?>>Evenement</option>
                    <option value="activite" <?php echo ($content->type ?? '') == 'activite' ? 'selected' : ''; ?>>Activité</option>
                    <option value="benevolat" <?php echo ($content->type ?? '') == 'benevolat' ? 'selected' : ''; ?>>Bénévolat</option>
                </select>
            </div>

            <div>
                <label for="event_date" class="text-[16px] font-poppins font-medium text-text">Date</label>
                <input type="date" id="event_date" name="event_date" value="<?php echo htmlspecialchars($content->event_date ?? ''); ?>"
                    class="mt-1 w-full p-4 rounded-[10px] border border-primary/20 focus-within:border-primary focus:outline-none">
            </div>

            <div>
                <label for="image" class="text-[16px] font-poppins font-medium text-text">Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="mt-1 w-full text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
            
                <?php if (!empty($content->image_path)): ?>
                    <div class="mt-2">
                        <img src="<?php echo htmlspecialchars($content->image_path); ?>" alt="Current Image" width="100">
                    </div>
                <?php endif; ?>
            </div>

            <div>
                <label for="location" class="text-[16px] font-poppins font-medium text-text">Localisation</label>
                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($content->location ?? ''); ?>" required placeholder="Localisation"
                    class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
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
                            <option value="benevolat">Bénévolat </option>
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