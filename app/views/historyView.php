<?php
class HistoryView
{
    use View;
       public function MesDons($mesDons)
    {
    ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
        <h2 class="text-center text-[30px] font-poppins font-bold text-text mt-4">Mon Historique</h2>
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mes Dons</h2>
            <?php if (empty($mesDons)): ?>
                <div class="bg-text/5 flex justify-center items-center shadow-sm w-full h-full max-h-[470px] overflow-y-auto rounded-[15px] p-6">
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

    public function MesBenevolats($mesBenevolats)
    {
    ?>
        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mes Participations aux bénévolats</h2>
            <?php if (empty($mesBenevolats)): ?>
                <div class="bg-text/5 flex justify-center items-center shadow-sm w-full h-full max-h-[470px] overflow-y-auto rounded-[15px] p-6">
<div class="flex justify-center items-center bg-white shadow-md rounded-lg"> 
                    <p class="text-center text-text/80">Aucune benevolat trouvée.</p>
                </div>

                </div>
            <?php else: ?>

                <div class="bg-text/5 shadow-sm w-full h-[470px] overflow-y-auto rounded-[15px] p-6">
                    <div class="flex flex-wrap gap-4">
                        <?php foreach ($mesBenevolats as $Benevolat): ?>
                            <div class="flex flex-col justify-between  md:flex-row flex-wrap w-full items-center  border border-primary/10  bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md ">
                                <h3 class="text-lg w-1/6 font-semibold  text-text text-center"><?= htmlspecialchars($Benevolat->title); ?></h3>
                                <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($Benevolat->description); ?></p>
                                <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($Benevolat->location); ?></p>
                                <p class="text-center w-1/6  text-principale "> <?= htmlspecialchars($Benevolat->event_date ?? "Aucune Date"); ?></p>
                              
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>

    <?php
    }






    
   
}
?>