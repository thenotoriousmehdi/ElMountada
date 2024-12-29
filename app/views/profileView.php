<?php
class ProfileView
{
use View;
    public function myProfile($profile)
    {
      ?>

<div class="flex flex-col justify-start gap-2 mb-8">
                    <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mon profil</h2>
                    <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">

                    <p class="text-center text-principale"> <strong> Identifiant # </strong> <?= htmlspecialchars($profile->id); ?></p>

</div>
</div>
<?php
    }
}
?>