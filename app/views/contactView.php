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
      
      <form id="suggestion-form" method="POST" action="/ElMountada/contact/handleFormSubmit">
       
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

}
?>