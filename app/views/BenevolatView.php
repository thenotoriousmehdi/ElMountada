<?php
class BenevolatView
{
    use View;

    public function Benevolat($content)
    {
        ?>
        <div class="flex flex-col justify-start gap-2 mt-4 mb-8">
                            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Pensez a participez comme bénevol avec ElMountada! </h2>
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

   
}
?>
