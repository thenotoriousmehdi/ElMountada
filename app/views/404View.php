<?php
class _404View
{
    use View;

    public function pageNotFound()
    {
?>
        <div class="flex items-center justify-center p-40 ">
            <div class="bg-white text-center shadow-lg rounded-lg p-8 max-w-md">
                <h1 class="text-4xl font-bold text-primary mb-4">404 Page Non Trouvée</h1>
                <p class="text-lg text-gray-700 mb-6">
                Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                </p>
                <a href="<?= ROOT ?>/" class="inline-block bg-text text-white px-6 py-2 rounded hover:bg-text/80 transition">
                Retour à l'Accueil
                </a>
            </div>
        </div>
<?php
    }
}
?>