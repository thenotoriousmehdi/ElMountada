<?php
class MembershipView
{
  use View;
  public function Memberships($memberships)
  {
?>
    <div class="flex flex-col justify-start gap-6 mt-4 mb-8">
      <div>
        <h2 class="text-start text-[24px] font-poppins font-bold text-text">Réclamez votre carte ElMountada dès aujourd'hui! </h2>
        <p class="text-start text-[16px] font-openSans font-medium text-principale text-opacity-80">Achetez un abonnement et profitez de toutes les remises et avantages qu'offrent nos nombreux partenaires </p>
      </div>
      <div class="flex  w-full h-full overflow-y-auto rounded-[15px] p-6 justify-center items-center gap-6">
        <?php
        foreach ($memberships as $membership) {
          echo "
                        <div class='w-[300px] bg-text/5 flex flex-col gap-4 justify-center items-center bg-bg px-4 py-6 transition duration-300 ease-in-out transform hover:scale-105 rounded-lg shadow-lg relative'>
                            <h3 class='font-poppins font-bold text-principale text-lg mb-2'>" . htmlspecialchars($membership->name) . "</h3>
                            <p class='font-openSans text-center font-medium'> <span class='font-bold'></span>  " . htmlspecialchars($membership->description) . "</p>
                            <p class='font-openSans text-center font-bold'> <span class='font-bold'></span>  " . htmlspecialchars($membership->price) . " DA</p>
                            <a href='showMembershipForm' > 
                            <button class='bg-primary text-white py-2 px-4 rounded mt-4 hover:bg-primary/80' >Acheter</button>
                            </a>
                        </div>
                        ";
        }
        ?>
      </div>
    </div>
  <?php
  }

  public function MembershipForm($sessionData)
  {
  ?>
    <div class="flex flex-col justify-start gap-2 mb-8">
      <h2 class="text-start text-[24px] font-poppins font-bold text-text">Formulaire d'abonnement </h2>
      <div class="bg-text/5 shadow-sm w-full h-full overflow-y-auto rounded-[15px] p-6">
        <form action="/ElMountada/membership/handleMembershipRequest" method="POST" enctype="multipart/form-data" class="space-y-4">
          <div>
            <label for="membership_type_id" class="text-[16px] font-poppins font-medium text-text">Type d'abonnement</label>
            <select id="membership_type_id" name="membership_type_id" required
              class="mt-1 w-full rounded-[10px] p-4 border border-primary/20 focus-within:border-primary focus:outline-none">
              <option value="">Sélectionner une type d'abonnement</option>
              <option value="1">Classique</option>
              <option value="2">Jeunes</option>
              <option value="3">Premimium</option>
            </select>
          </div>

          <div>
            <label for="recu" class="text-[16px] font-poppins font-medium text-text">Photo </label>
            <input type="file" id="photo" name="photo" accept="image/png, image/jpeg, image/jpg"
              class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">
          </div>

          <div>
            <label for="recu" class="text-[16px] font-poppins font-medium text-text">Pièce d'identité</label>
            <input type="file" id="identity" name="identity" accept="application/pdf"
              class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">

          </div>

          <div>
            <label for="recu" class="text-[16px] font-poppins font-medium text-text">Reçu de paiment</label>
            <input type="file" id="receipt" name="receipt" accept="application/pdf, image/png, image/jpeg, image/jpg"
              class="mt-1  border-primary/20 focus-within:border-primary focus:outline-none block w-full p-4 rounded-[10px] bg-white text-sm text-text file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:bg-opacity-20 file:text-primary hover:file:text-bg hover:file:bg-primary">

          </div>
          <div class="pt-4">
            <button type="submit"
              class="w-full bg-text hover:bg-text hover:bg-opacity-90 text-bg font-poppins font-bold p-4 rounded-[15px] focus:outline-none focus:shadow-outline">
              S'abonner
            </button>
          </div>
        </form>
      </div>
    </div>
  <?php
  }





  public function MembershipCard($membershipCard)
  {
  ?>
    <div class="cardcontainer flex flex-col gap-4 justify-center items-center w-full h-full p-24 ">
      <h2 class="font-poppins font-semibold text-text text-[24px]">Ma carte d'abonnement</h2>
      <div class="bg-white shadow-md rounded-lg p-6 w-full sm:w-3/4 md:w-1/2 ">
        <div class="flex flex-col lg:flex-row lg:justify-start justify-center items-center lg:items-start gap-4 h-auto w-full">
          <div class="flex flex-col h-full justify-center md:justify-start gap-2 items-center md:items-start w-full sm:w-1/2">
            <img src="<?= ROOTIMG ?>ElMountada4.svg" alt="Logo" class="w-32 h-12" />
            <p class="text-center text-principale"> <strong> Identifiant # </strong> <?= htmlspecialchars($membershipCard->user_id); ?></p>
            <p class="text-center text-principale"> <strong> Email</strong> <?= htmlspecialchars($membershipCard->email); ?></p>
            <p class="text-center text-principale"> <strong> Nom complet</strong> <?= htmlspecialchars($membershipCard->full_name) ?: 'null'; ?></p>
            <p class="text-center text-principale"> <strong> Téléphone</strong> <?= htmlspecialchars($membershipCard->phone_number) ?: 'null'; ?></p>
            <p class=" text-principale"> <strong> Plan </strong><?= htmlspecialchars($membershipCard->membership_type_name); ?></p>
            <p class=" text-principale"> <strong> Date de facturation </strong><?= htmlspecialchars($membershipCard->billing_date); ?></p>

            <?php if ($membershipCard->needs_renewal): ?>
              <a href="/ElMountada/membership/showMembershipForm"
                class="mt-4 px-6 py-2 bg-text text-white rounded-md hover:bg-principale/80 transition-colors">
                Renouveler l'abonnement
              </a>
            <?php endif; ?>
          </div>
          <div class="bg-bg flex justify-center items-center p-2 rounded-[10px] h-full w-full sm:w-1/2">
            <img src="<?= htmlspecialchars($membershipCard->QrCode); ?>" alt="" class="w-full h-full rounded-md object-contain">
          </div>
        </div>
      </div>
    </div>
  <?php
  }


  public function displayMembers($members)
  {
    echo '<div class="bg-primary bg-opacity-5 p-5 rounded-[15px] mb-8">';
    echo '<h2 class="text-center text-[32px] font-poppins font-bold mb-8 text-text">Nos Membres</h2>';

    if (empty($members)) {
      echo "<p class='text-center text-lg text-gray-500'>No members available at the moment.</p>";
    } else {

      echo '<div class="flex flex-col items-end gap-4">';

      echo '<div class="overflow-auto w-full max-h-[700px]">';
      echo '<table class="min-w-full bg-white/80 border border-primary rounded-[15px] overflow-hidden">';
      echo '<thead class="bg-text sticky top-0 z-10">';
      echo '<tr>
       
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Nom complet</th>
                 <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Identifiant</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Email</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Numero</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Statut</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Date d\'abonnement</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Date de facturation</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">QR Code</th>
                <th class="py-5 px-4 text-left text-sm font-poppins font-semibold text-bg">Type d\'abonnement</th>
              </tr>';
      echo '</thead>';

      echo '<tbody>';
      foreach ($members as $member) {
        echo "<tr class='border-t border-primary/5 hover:bg-primary/10'>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>";
        echo isset($member->full_name) && !empty($member->full_name) ? htmlspecialchars($member->full_name) : 'N/A';
        echo "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->user_id) ? htmlspecialchars($member->user_id) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->email) ? htmlspecialchars($member->email) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->phone_number) && !empty($member->phone_number) ? htmlspecialchars($member->phone_number) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->status) ? htmlspecialchars($member->status) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->membership_date) ? htmlspecialchars($member->membership_date) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->billing_date) ? htmlspecialchars($member->billing_date) : 'N/A') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->QrCode) && !empty($member->QrCode) ? htmlspecialchars($member->QrCode) : 'No QR Code') . "</td>";
        echo "<td class='py-5 px-4 text-sm font-openSans text-principale'>" . (isset($member->membership_type_id) ? htmlspecialchars($member->membership_name) : 'N/A') . "</td>";

        echo "</tr>";
      }
      echo '</tbody>';
      echo '</table>';
      echo '</div>';

      echo '</div>';
    }

    echo '</div>';
  }

  public function MembershipRequests($membersRequest)
  {
  ?>

    <div class="flex flex-col justify-start gap-2 mb-8">
      <h2 class="text-start text-[24px] font-poppins font-bold text-text">Demandes d'abonnements</h2>

      <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
        <div class="flex flex-wrap gap-4">
          <?php if (!empty($membersRequest)): ?>
            <?php foreach ($membersRequest as $request): ?>
              <div class="flex justify-between w-full gap-2 border border-primary/10 bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md">
                <div class="flex flex-col gap-8 md:flex-row flex-wrap w-full items-center">
                  <h3 class="text-lg w-1/12 font-semibold text-text text-center">
                    <?= htmlspecialchars($request->full_name); ?>
                  </h3>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->email); ?>
                  </p>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->phone_number ?? 'N/A'); ?>
                  </p>

                  <?php
                  $photoPath = htmlspecialchars($request->photo);
                  $idPath = htmlspecialchars($request->idpiece);
                  $recuPath = htmlspecialchars($request->recu);
                  $photoName = basename($photoPath);
                  $idName = basename($idPath);
                  $recuName = basename($recuPath);
                  ?>


                  <a href="<?= $photoPath; ?>"
                    class="text-white bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $photoName; ?>">
                    Photo
                  </a>


                  <a href="<?=  $idPath; ?>"
                    class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $idName; ?>">
                    Pièce d'identité
                  </a>

                  <a href="<?= $recuPath;?>"
                    class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $recuName; ?>">
                    Reçu de paiement
                  </a>


                </div>
                <div class="flex items-center gap-2">
                  <a class="bg-bg border-2 border-[#f12323] hover:bg-[#f12323] hover:bg-opacity-10 p-4 rounded-[10px]"
                    href="javascript:void(0);"
                    onclick="confirmRefuseMembership(<?= htmlspecialchars($request->user_id) ?>)">
                    <img src="<?= ROOTIMG ?>cross.svg" alt="refuser" class="size-5" />
                  </a>
                  <a class="bg-[#0c9621] bg-opacity-50 hover:bg-[#0c9621] hover:bg-opacity-40 p-4 rounded-[10px]"
                    href="javascript:void(0);"
                    onclick="confirmAcceptMembership(<?= htmlspecialchars($request->user_id) ?>)">
                    <img src="<?= ROOTIMG ?>done.svg" alt="confirm" class="size-6" />
                  </a>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center text-lg text-gray-500">Aucune demande d'abonnement pour le moment.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <script>
      function confirmRefuseMembership(user_id) {
        const isConfirmed = confirm("Etes vous sur de vouloir refuser cet abonnement");
        if (isConfirmed) {
          window.location.href = '/ElMountada/membership/refuseMembership/?id=' + user_id;
        }
      }

      function confirmAcceptMembership(user_id) {
        const isConfirmed = confirm("Etes vous sur de vouloir accepter cet abonnement");
        if (isConfirmed) {
          window.location.href = '/ElMountada/membership/acceptMembership/?id=' + user_id;
        }
      }
    </script>

<?php
  }


  public function SubscriptionsHistory($subscriptions)
  {
  ?>

    <div class="flex flex-col justify-start gap-2 mb-8">
      <h2 class="text-start text-[24px] font-poppins font-bold text-text">Historique d'abonnements</h2>

      <div class="bg-text/5 shadow-sm w-full h-[400px] overflow-y-auto rounded-[15px] p-6">
        <div class="flex flex-wrap gap-4">
          <?php if (!empty($subscriptions)): ?>
            <?php foreach ($subscriptions as $request): ?>
              <div class="flex justify-between w-full gap-2 border border-primary/10 bg-white hover:bg-[#E76F51] hover:bg-opacity-10 p-4 rounded-lg shadow-md">
                <div class="flex flex-col gap-8 md:flex-row flex-wrap w-full items-center">
                  <h3 class="text-lg w-1/12 font-semibold text-text text-center">
                    <?= htmlspecialchars($request->full_name); ?>
                  </h3>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->email); ?>
                  </p>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->phone_number ?? 'N/A'); ?>
                  </p>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->membership_date ?? 'N/A'); ?>
                  </p>
                  <p class="text-sm w-1/12  text-text text-center">
                    <?= htmlspecialchars($request->membership_name ?? 'N/A'); ?>
                  </p>

                  <?php
                  $photoPath = htmlspecialchars($request->photo);
                  $idPath = htmlspecialchars($request->idpiece);
                  $recuPath = htmlspecialchars($request->recu);
                  $photoName = basename($photoPath);
                  $idName = basename($idPath);
                  $recuName = basename($recuPath);
                  ?>


                  <a href="<?= $photoPath; ?>"
                    class="text-white bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $photoName; ?>">
                    Photo
                  </a>


                  <a href="<?=  $idPath; ?>"
                    class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $idName; ?>">
                    Pièce d'identité
                  </a>

                  <a href="<?= $recuPath;?>"
                    class="text-white   bg-text hover:bg-text/80 px-4 py-2 rounded-lg text-sm"
                    download="<?= $recuName; ?>">
                    Reçu de paiement
                  </a>


                </div>
                <div class="flex items-center gap-2">
                  <a class="bg-bg border-2 border-[#f12323] hover:bg-[#f12323] hover:bg-opacity-10 p-4 rounded-[10px]"
                    href="javascript:void(0);"
                    onclick="confirmArchiveSubscription(<?= htmlspecialchars($request->membership_id) ?>)">
                   Archiver
                  </a>
              
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p class="text-center text-lg text-gray-500">Aucune demande d'abonnement pour le moment.</p>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <script>
      function confirmArchiveSubscription(membership_id) {
        const isConfirmed = confirm("Etes vous sur de vouloir refuser cet abonnement");
        if (isConfirmed) {
          window.location.href = '/ElMountada/membership/archiveSubscription/?id=' + membership_id;
        }
      }
    </script>

<?php
  }
}
?>