<?php
class AuthView
{
    use View;

    public function login($errorMessage = null)
    {
        ?>
        <div class="flex h-screen justify-center xl:bg-bg">
            
            <div class="hidden xl:block xl:relative xl:py-[25px] xl:pr-[25px] xl:w-[52%] ">
                <div class="absolute  flex justify-center items-center inset-0 xl:my-[25px] xl:mr-[25px] rounded-[25px] bg-principale/60 bg-opacity-50 z-10">
                    <div>
                        <img src="<?= ROOTIMG ?>ElMountada1.svg" alt="Logo" class=" size-80" />
                    </div>
                </div>
                <img src="<?= ROOTIMG ?>charity2.jpg" alt="Login Image" class="rounded-[25px] h-full w-auto" />
            </div>

            <div class="w-full xl:w-[48%] xl:m-0 m-8 flex flex-col justify-center bg-bg px-[25px] sm:px-[50px] md:px-[107px] gap-[60px] xl:overflow-hidden xl:h-full z-20">
                <div class="flex flex-col items-center justify-center px-[30px] ">
                    <h1 class="font-poppins font-semibold mb-4 text-[24px] text-text">
                        Bienvenue! <span class="wave-emoji">👋</span>
                    </h1>
                    <p class="font-openSans font-regular text-[16px] text-text text-opacity-80 text-center">
                        Connectez-vous à votre compte en remplissant le formulaire de connexion avec vos informations personnelles.
                    </p>
                </div>

                <!-- Display error message if login failed -->
                <?php if ($errorMessage): ?>
                    <div class="bg-red-500 text-white p-2 rounded-md mb-4 text-center">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <form action="/ElMountada/auth/handleLogin" method="post">
                    <div class="flex flex-col gap-[25px]">
                        <div>
                            <label>
                                <input
                                    class="sm:p-[20px] bg-transparent p-[15px] w-full rounded-[10px] text-[16px] font-openSans font-regular border border-primary/30 focus-within:border-primary focus:outline-none"
                                    type="email" 
                                    name="email" 
                                    placeholder="Adresse email" 
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
                                    required
                                />
                            </label>
                        </div>

                        <div>
                            <div class="flex sm:p-[20px] p-[15px] w-full text-[16px] rounded-[10px] font-openSans font-regular border border-primary/30 focus-within:border-primary justify-between">
                                <input
                                    class="bg-transparent border-transparent "
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    minLength="8" 
                                    maxLength="20" 
                                    placeholder="Mot de passe" 
                                    required
                                />
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full hover:bg-primary/80 bg-primary p-[12px] sm:p-[16px] text-white rounded-[20px] font-poppins text-[20px] font-medium">
                                Se connecter
                            </button>
                        </div>

     <div>
     <p class="flex justify-center items-center font-openSans text-center text-[14px] text-PrimaryBlack/80">
                    Vous n'avez pas de compte? <a href="/ElMountada/auth/showSignUpPage/" class="ml-2 font-poppins font-semibold text-[14px] underline text-primary"> Créer un compte </a>
                </p>
     </div>

                    </div>
                </form>

                <p class="flex justify-center items-center font-openSans text-center text-[14px] text-PrimaryBlack/80">
                    ElMountada © 2024. tous droits réservés.
                </p>
            </div>
        </div>
        <?php
    }

    public function signup($errorMessage = null)
    {
        ?>
        <div class="flex h-screen justify-center xl:bg-bg">
            
           

            <div class="w-full xl:w-[48%] xl:m-0 m-8 flex flex-col justify-center bg-bg px-[25px] sm:px-[50px] md:px-[107px] gap-[60px] xl:overflow-hidden xl:h-full z-20">
                <div class="flex flex-col items-center justify-center px-[30px] ">
                    <h1 class="font-poppins font-semibold mb-4 text-[24px] text-text">
                    Inscrivez-vous! <span class="wave-emoji">👋</span>
                    </h1>
                    <p class="font-openSans font-regular text-[16px] text-text text-opacity-80 text-center">
                    Créez votre compte en remplissant le formulaire d'inscription avec vos informations personnelles. Rejoignez-nous dès aujourd'hui!
                    </p>
                </div>

                <!-- Display error message if login failed -->
                <?php if ($errorMessage): ?>
                    <div class="bg-red-500 text-white p-2 rounded-md mb-4 text-center">
                        <?= htmlspecialchars($errorMessage) ?>
                    </div>
                <?php endif; ?>

                <form action="/ElMountada/auth/handleSignup" method="post">
                    <div class="flex flex-col gap-[15px]">
                        <div class="flex justify-between">
                            <label>
                                <input
                                    class="sm:py-[20px] sm:px-[25px] bg-transparent p-[15px] w-full rounded-[10px] text-[16px] font-openSans font-regular border border-primary/30 focus-within:border-primary focus:outline-none"
                                    type="text" 
                                     name="full_name" 
                                    id="full_name" 
                                    placeholder="Nom Complet" 
                                    pattern="^[A-Za-zÀ-ÖØ-öø-ÿ \-']{2,50}$" 
                                    value="<?= isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '' ?>" 
                                    required
                                />
                            </label>
                            <label>
                                <input
                                    class="sm:py-[20px] sm:px-[25px] bg-transparent p-[15px] w-full rounded-[10px] text-[16px] font-openSans font-regular border border-primary/30 focus-within:border-primary focus:outline-none"
                                    type="tel" 
                                    name="phone_number" 
                                    id="phone_number" 
                                    placeholder="Numero de téléphone" 
                                   pattern="^(05|06|07)[0-9]{8}$"
                                    value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>" 
                                    required
                                />
                            </label>
                        </div>

                        <div>
                            <label>
                                <input
                                    class="sm:p-[20px] bg-transparent p-[15px] w-full rounded-[10px] text-[16px] font-openSans font-regular border border-primary/30 focus-within:border-primary focus:outline-none"
                                    type="email" 
                                    name="email" 
                                    placeholder="Adresse email" 
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" 
                                    required
                                />
                            </label>
                        </div>

                        <div>
                            <div class="flex sm:p-[20px] p-[15px] w-full text-[16px] rounded-[10px] font-openSans font-regular border border-primary/30 focus-within:border-primary justify-between">
                                <input
                                    class="bg-transparent border-transparent "
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    minLength="8" 
                                    maxLength="20" 
                                    placeholder="Mot de passe" 
                                    required
                                />
                            </div>
                        </div>
                        <div>
                            <div class="flex sm:p-[20px] p-[15px] w-full text-[16px] rounded-[10px] font-openSans font-regular border border-primary/30 focus-within:border-primary justify-between">
                                <input
                                    class="bg-transparent border-transparent "
                                    type="password" 
                                    id="confirm_password" 
                                    name="confirm_password"
                                    minLength="8" 
                                    maxLength="20" 
                                    placeholder="Confirmer le mdpasse" 
                            
                                />
                            </div>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full hover:bg-primary/80 bg-primary p-[12px] sm:p-[16px] text-white rounded-[20px] font-poppins text-[20px] font-medium">
                                Créer un compte
                            </button>
                        </div>

     <div>
     <p class="flex justify-center items-center font-openSans text-center text-[14px] text-PrimaryBlack/80">
                    Vous avez un compte? <a href="/ElMountada/auth/showLoginPage/" class="ml-2 font-poppins font-semibold text-[14px] underline text-primary"> Se Connecter </a>
                </p>
     </div>

                    </div>
                </form>

                <p class="flex justify-center items-center font-openSans text-center text-[14px] text-PrimaryBlack/80">
                    ElMountada © 2024. tous droits réservés.
                </p>
            </div>



            <div class="hidden xl:block xl:relative xl:py-[25px] xl:pl-[25px] xl:w-[52%] ">
                <div class="absolute flex justify-center items-center inset-0 xl:my-[25px] xl:ml-[25px] rounded-[25px] bg-principale/60 bg-opacity-50 z-10">
                    <div>
                        <img src="<?= ROOTIMG ?>ElMountada1.svg" alt="Logo" class=" size-80" />
                    </div>
                </div>
                <img src="<?= ROOTIMG ?>charity4.jpg" alt="Login Image" class="rounded-[25px] h-full w-auto" />
            </div>
        </div>
        <?php
    }
}
?>
