<?php
class ProfileView
{
    use View;
    public function myProfile($profile)
    {
?>

        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Mon profil</h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">


                <form id="profileForm" method="POST" action="/ElMountada/profile/updateProfile" enctype="multipart/form-data" class="space-y-4">

                    <div>
                        <label for="full_name" class="text-[16px] font-poppins font-medium text-text">Nom Complet</label>
                        <input
                            type="text"
                            id="full_name"
                            name="full_name"
                            value="<?= htmlspecialchars($profile->full_name); ?>"
                            class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none" />
                    </div>

                    <div>
                        <label for="email" class="text-[16px] font-poppins font-medium text-text">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value=" <?= htmlspecialchars($profile->email); ?>"
                            class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none" />
                    </div>

                    <div>
                        <label for="phone_number" class="text-[16px] font-poppins font-medium text-text">Numéro de téléphone</label>
                        <input
                            type="text"
                            id="phone_number"
                            name="phone_number"
                           value="<?= $profile->phone_number ? htmlspecialchars($profile->phone_number) : 'Numéro de téléphone'; ?>"
                            class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none" />
                    </div>


                    <button
                        id="profileSubmit"
                        type="submit"
                        disabled
                        class="w-full bg-text hover:bg-text hover:bg-opacity-90  text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline disabled:opacity-50 disabled:cursor-not-allowed">
                        Modifier les informations
                    </button>
                </form>
            </div>
        </div>



        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Changer mon mot de passe</h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
            <form id="passwordForm" method="POST" action="/ElMountada/profile/updatePassword" class="space-y-4">
    <!-- Current Password -->
    <div>
      <label for="current_password" class="text-[16px] font-poppins font-medium text-text">Mot de passe actuel</label>
      <input
        type="password"
        id="current_password"
        name="current_password"
        required
        class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none"
      />
    </div>
    <!-- New Password -->
    <div>
      <label for="new_password" class="text-[16px] font-poppins font-medium text-text">Nouveau mot de passe</label>
      <input
        type="password"
        id="new_password"
        name="new_password"
        required
class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none"
      />
    </div>
    <!-- Confirm New Password -->
    <div>
      <label for="confirm_password" class="text-[16px] font-poppins font-medium text-text">Confirmez le nouveau mot d epasse</label>
      <input
        type="password"
        id="confirm_password"
        name="confirm_password"
        required
       class="mt-1  w-full p-4 rounded-[10px] shadow-sm border border-primary/20 focus-within:border-primary focus:outline-none"
      />
    </div>
    <!-- Submit Button -->
    <button
      id="passwordSubmit"
      type="submit"
      disabled
      class="w-full bg-text hover:bg-text hover:bg-opacity-90  text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline disabled:opacity-50 disabled:cursor-not-allowed">
    
      Modifier le mot de passe
    </button>
  </form>

            
            </div>
        </div>


        <script>
            const profileForm = document.getElementById('profileForm');
            const profileSubmit = document.getElementById('profileSubmit');
            const originalValues = {};

            // Save original values
            profileForm.querySelectorAll('input').forEach(input => {
                originalValues[input.name] = input.value;
            });

            // Listen for changes in inputs
            profileForm.addEventListener('input', () => {
                let isModified = false;

                profileForm.querySelectorAll('input').forEach(input => {
                    if (input.value !== originalValues[input.name]) {
                        isModified = true;
                    }
                });

                profileSubmit.disabled = !isModified;
            });
        </script>

<script>
  const passwordForm = document.getElementById('passwordForm');
  const passwordSubmit = document.getElementById('passwordSubmit');
  const inputs = passwordForm.querySelectorAll('input');

  inputs.forEach(input => {
    input.addEventListener('input', () => {
      let isFilled = Array.from(inputs).every(input => input.value.trim() !== '');
      passwordSubmit.disabled = !isFilled;
    });
  });
</script>

<?php
    }
}
?>