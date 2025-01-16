<?php
class UsersView
{

    use View;
    public function Users($users)
    {
        echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
        echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Gestion des Utilisateurs</h2>';
        
        echo '<div class="flex justify-between items-end mb-4">';
    
        echo '<form action="' . ROOT . '/users/ShowUsers" method="POST" class="flex gap-4 items-end">';
    
    echo '<div class="flex flex-col w-1/3">'; 
    echo '<label for="type" class="block text-sm font-semibold mb-2">Type</label>'; 
    echo '<select name="type" id="type" class="w-full h-[40px] rounded-[10px] p-2 border border-primary/20 focus-within:border-primary focus:outline-none">'; 
    echo '<option value="">Type</option>';
    echo '<option value="simple">Simple</option>';
    echo '<option value="member">Membre</option>';
    echo '<option value="partner">Partenaire</option>';
    echo '<option value="admin">Admin</option>';
    echo '</select>';
    echo '</div>';
    
    echo '<div class="flex items-center">'; 
    echo '<button type="submit" class="h-[40px] px-4 py-2 bg-text text-white rounded-lg hover:bg-text/80 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-text focus:ring-offset-2">Filtrer</button>';
    echo '</div>';
    
    echo '</form>';
    
    
     echo '</div>';
    
        
        if (empty($users)) {
            echo "<p class='text-center text-lg text-gray-500'>No users available at the moment.</p>";
        } else {
            echo '<div class="flex flex-col items-end gap-4">';
            echo '<div class="overflow-auto w-full max-h-[700px]">';
            echo '<table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">';
            echo '<thead class="bg-text sticky top-0 z-10">';
            echo '<tr>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Identifiant</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Email</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Numéro de téléphone</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">type</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">membre?</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Bloqué?</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Actions</th>
            </tr>';
            echo '</thead>';
    
            echo '<tbody>';
            foreach ($users as $user) {
                echo "<tr class='border-t border-primary/5 hover:bg-primary/10' >";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->id) ? htmlspecialchars($user->id ?? 'N/A') : 'N/A';
                echo "</td>";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->full_name) ? htmlspecialchars($user->full_name ?? 'N/A') : 'N/A';
                echo "</td>";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->email) ? htmlspecialchars($user->email ?? 'N/A') : 'N/A';
                echo "</td>";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->phone_number) ? htmlspecialchars($user->phone_number ?? 'N/A') : 'N/A';
                echo "</td>";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->type) ? htmlspecialchars($user->type ?? 'N/A') : 'N/A';
                echo "</td>";
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->is_member) ? ($user->is_member ? 'Oui' : 'Non') : 'N/A';
                echo "</td>";

                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo isset($user->active) ? ($user->active ? 'Non' : 'Oui') : 'N/A';
                echo "</td>";
              
    
                echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
                echo "<div class='flex flex-col gap-2'>";

                echo "<form action='" . ROOT . "/users/deleteUser' method='POST' onsubmit='return confirm(\"Etes vous sure de vouloir supprimer cet utilisateur ?\")'>";
                echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($user->id) . "'>";
                echo "<button type='submit' class='bg-red-500 text-white px-4 py-2 rounded-lg'>Supprimer</button>";
                echo "</form>";
                


               echo "<form action='" . ROOT . "/users/blockUser' method='POST' onsubmit='return confirm(\"Etes vous sure de vouloir bloquer cet utilisateur ?\")'>";
                echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($user->id) . "'>";
                echo "<button type='submit' class='bg-black text-white px-4 py-2 rounded-lg'>Bloquer</button>";
                echo "</form>";

                echo "<form action='" . ROOT . "/users/makeMember' method='POST' onsubmit='return confirm(\"Etes vous sure de vouloir rendre cet utilisateur membre ?\")'>";
                echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($user->id) . "'>";
                echo "<button type='submit' class='bg-blue-500 text-white px-4 py-2 rounded-lg'>Rendre membre</button>";
                echo "</form>";
                
            echo '</div>';
                echo "</td>";

                echo "</tr>";
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            echo '</div>';
        }
    
        echo '</div>';
    } 
}
?>