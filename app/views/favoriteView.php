<?php
class FavoriteView
{
    use View;
    public function FavoritePage($favorites)
    {
?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mes Favoris</h2>
            <div class="bg-white/80 shadow-md w-full max-h-[400px] overflow-y-auto rounded-[15px] p-6">
                <div class="flex flex-wrap gap-4 justify-start">
                    <?php foreach ($favorites as $partner): ?>
                        <div class="w-[300px] flex flex-col justify-center items-center bg-text/5 p-4 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg relative">
                            <div class="absolute top-2 right-2">

                            </div>
                            <img src="<?= htmlspecialchars(ROOT . '/' . ($partner->logo_path ?? 'public/assets/ElMountada1.svg')) ?>"
                                alt="Partner Logo" class="size-28 object-contain">
                            <h3 class="font-poppins font-bold text-lg mb-2"><?= htmlspecialchars($partner->full_name ?? 'N/A') ?></h3>
                            <p class="font-openSans font-semibold"><?= htmlspecialchars($partner->ville ?? 'N/A') ?></p>
                            <a class="bg-text text-white py-2 px-4 rounded mt-4 hover:bg-text/80" href="<?= ROOT ?>/partners/showPartnerDetails/?id=<?= htmlspecialchars($partner->id) ?>">Voir plus</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

<?php
    }
}
?>