<?php
class Auth
{

    public function login()
    {
        ?>
            <div class="flex h-screen  justify-center xl:bg-bg">


                <div class=" hidden xl:block  xl:relative  xl:p-[25px] xl:w-[52%] ">
                    <div
                        class="absolute flex justify-center items-center inset-0 m-[25px] rounded-[25px] bg-principale/60 bg-opacity-50 z-10">
                        <div>
                        <img src="public/assets/ElMountada1.svg" alt="Logo" class=" size-80" />
                        </div>

                    </div>
                    <img src="public/assets/charity2.jpg" alt="Login Image" class="rounded-[25px] h-full w-auto" />
                </div>

                <div
                    class="w-full xl:w-[48%] xl:m-0 m-8 flex flex-col justify-center bg-bg px-[25px] sm:px-[50px] md:px-[107px] gap-[60px] xl:overflow-hidden xl:h-full z-20">

                    <div class="flex flex-col items-center justify-center px-[30px] ">
                        <h1 class="font-poppins font-semibold mb-4 text-[24px] text-text">
                            Bienvenue! <span class="wave-emoji">👋</span>
                        </h1>
                        <p class="font-openSans font-regular text-[16px]  text-text text-opacity-80 text-center">
                            Connectez-vous à votre compte en remplissant le formulaire de
                            connexion avec vos informations personnelles.
                        </p>
                    </div>
                    <form method="post">
                        <div class="flex flex-col gap-[25px]">
                            <div>
                                <label>
                                    <input
                                        class="sm:p-[20px] bg-transparent p-[15px] w-full rounded-[10px] text-[16px] font-openSans font-regular border border-primary/30 focus-within:border-primary focus:outline-none"
                                        type="email" placeholder="Adresse email"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                                </label>
                            </div>

                            <div>
                                <div
                                    class="flex sm:p-[20px] p-[15px] w-full text-[16px] rounded-[10px] font-openSans font-regular border border-primary/30 focus-within:border-primary justify-between">
                                    <input class="bg-transparent border-transparent " type="password" id="password"
                                        name="password" minLength={8} maxLength={20} placeholder="Mot de passe" />
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full hover:bg-primary/80 bg-primary p-[12px] sm:p-[16px] text-white rounded-[20px] font-poppins text-[20px] font-medium">
                                    Se connecter
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class=" flex justify-center items-center font-openSans text-center text-[14px] text-PrimaryBlack/80">
                        ElMountada © 2024. tous droits réservés.
                    </p>
                </div>

            </div>
        <?php
    }

}
?>