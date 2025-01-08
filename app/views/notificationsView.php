<?php
class NotificationsView
{
use View;


public function addNotifications()
{
    ?>
    <form action="/ElMountada/notifications/createNotification" method="POST" class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-lg m-8">
    <h2 class="text-2xl font-semibold mb-4">Créer une Notification</h2>
    
    <div class="mb-4">
        <label for="title" class="block text-lg font-medium text-gray-700">Titre:</label>
        <input type="text" name="title" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez le titre de la notif">
    </div>

    <div class="mb-4">
        <label for="message" class="block text-lg font-medium text-gray-700">Message:</label>
        <textarea name="message" required class="w-full mt-2 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Entrez votre message" rows="6"></textarea>
    </div>

    <div class="mb-4">
        <button type="submit" class="w-full py-3 bg-text text-white font-semibold rounded-md hover:bg-primary/80 transition duration-200">
            Créer
        </button>
    </div>
</form>

<?php
    }
}
?>