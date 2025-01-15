<?php
class ContactView
{
    use View;


    public function ContactForm($partners)
    {
       
        ?> 
        <div class="flex flex-col items-center justify-center m-8 ">
    <div class="bg-white shadow-md rounded-lg p-6 w-full sm:w-3/4 md:w-1/2">
      <h2 class="text-xl font-poppins text-text font-semibold text-center mb-4">Envoyez vos avis ou suggestions !</h2>
      
      <form id="suggestion-form" method="POST" action="<?= ROOT ?>/contact/handleFormSubmit">
       
        <div class="mb-4">
          <label for="message-type" class="block text-gray-700 font-medium mb-2">Type du Message</label>
          <select
            id="message-type"
            name="message_type"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            onchange="togglePartnerDropdown()"
          >
          <option value="">Selectionner un type de message</option>
            <option value="suggestion">Suggestion</option>
            <option value="avis">Avis sur un partenaire</option>
          </select>
        </div>

      
        <div id="partner-dropdown-container" class="mb-4 hidden">
          <label for="partner" class="block text-gray-700 font-medium mb-2">Selectionner un Partenaire:</label>
          <select
            id="partner"
            name="partner_id"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
          >
            <option value="">Selectionner un Partenraire</option>
            <?php foreach ($partners as $partner): ?>
              <option value="<?= htmlspecialchars($partner -> id); ?>"><?= htmlspecialchars($partner -> full_name); ?></option>
            <?php endforeach; ?>
          </select>
        </div>

      
        <div class="mb-4">
          <label for="message-content" class="block text-gray-700 font-medium mb-2">Votre message:</label>
          <textarea
            id="message-content"
            name="message_content"
            rows="4"
            class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary"
            placeholder="Votre message ici..."
            required
          ></textarea>
        </div>

        <div class="text-center">
          <button
            type="submit"
            class="bg-text text-white w-full font-medium py-2 px-4 rounded-md hover:bg-text/80 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2"
          >
           Envoyer
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function togglePartnerDropdown() {
      const messageType = document.getElementById('message-type').value;
      const partnerDropdown = document.getElementById('partner-dropdown-container');

      if (messageType === 'avis') {
        partnerDropdown.classList.remove('hidden');
      } else {
        partnerDropdown.classList.add('hidden');
      }
    }
  </script>
        <?php
    }


public function MessagesPage($messages){
?>
<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">
    <h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Messages des utilisateurs</h2>

    <?php if (empty($messages)) : ?>
        <p class="text-center text-lg text-gray-500">Aucun message disponible pour le moment.</p>
    <?php else : ?>
        <div class="flex flex-col items-end gap-4">
            <div class="overflow-auto w-full max-h-[700px]">
                <table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">
                    <thead class="bg-text sticky top-0 z-10">
                        <tr>
                            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">#</th>
                            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Type</th>
                            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Message</th>
                            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom du Partenaire</th>
                            <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Date de Création</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $index => $message) : ?>
                            <tr class="border-t border-primary/5 hover:bg-primary/10">
                                <td class="py-5 px-4 text-sm font-openSans text-principale"><?= $index + 1; ?></td>
                                <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($message ->type); ?></td>
                                <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($message ->message); ?></td>
                                <td class="py-5 px-4 text-sm font-openSans text-principale">
                                    <?= !empty($message -> partner_name) ? htmlspecialchars($message -> partner_name?? 'N/A') : 'N/A'; ?>
                                </td>
                                <td class="py-5 px-4 text-sm font-openSans text-principale"><?= htmlspecialchars($message -> created_at); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>






<?php
}


}
?>