<?php
class NotificationsView
{
    use View;


    public function addNotifications()
    {
?>

        <div class="flex flex-col justify-start gap-2 mb-8">
            <h2 class="text-start text-[24px] font-poppins font-bold text-text">Ajouter une notification </h2>
            <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">

                <form action="<?= ROOT ?>/notifications/createNotification" method="POST" class="space-y-4">
                    <div>
                        <label for="title" class="text-[16px] font-poppins font-medium text-text">Titre</label>
                        <input type="text" id="title" name="title" required placeholder="Titre"
                            class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]">
                    </div>

                    <div>
                        <label for="message" class="text-[16px] font-poppins font-medium text-text">Message</label>
                        <textarea id="message" name="message" rows="6" required placeholder="Entrez votre message"
                            class="mt-1 w-full p-4 border border-primary/20 focus-within:border-primary focus:outline-none rounded-[10px]"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
                            Créer
                        </button>
                    </div>

                </form>
            </div>
        </div>

<?php
    }
}
?>