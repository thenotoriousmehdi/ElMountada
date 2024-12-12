<?php
class Auth
{

    public function login()
    {
        ?>

        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ElMountada</title>

            <link href="public/dist/styles.css" rel="stylesheet">
        </head>

        <body>

            <div class="flex h-screen justify-center xl:bg-white ">


                <div class="flex items-center justify-center p-[25px]  w-[52%] ">
                        <img src="public/assets/charity2.jpg" alt="Login Image"
                            class="rounded-[25px] h-auto w-auto  "/>  
              </div>

                <div
                    class="w-full xl:w-[48%] xl:m-0 m-8 flex flex-col justify-center bg-white px-[25px] sm:px-[50px] md:px-[107px] gap-[60px] xl:overflow-hidden xl:h-full z-20">
                    <div class="flex flex-col items-start justify-start ">
                        <h1 class="font-poppins font-semibold mb-4 text-[24px] text-black">
                            Bienvenue! <span class="wave-emoji">👋</span>
                        </h1>
                        <p class="font-openSans font-regular text-[16px]  text-black text-opacity-80 text-start">
                            Connectez-vous à votre compte en remplissant le formulaire de
                            connexion avec vos informations personnelles.
                        </p>
                    </div>
                    <!-- Form inputs  -->
                    <form method="post">
                        <div class="flex flex-col gap-[25px]">
                            <div>
                                <label>
                                    <input
                                        class="sm:p-[20px] p-[15px] w-full rounded-[15px] text-[16px] font-openSans font-regular border border-BorderWithoutAction focus-within:border-black focus:outline-none"
                                        type="email" placeholder="Adresse email"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" />
                                </label>
                            </div>

                            <div>
                                <div
                                    class="flex sm:p-[20px] p-[15px] w-full text-[16px]  rounded-[15px] font-openSans font-regular border border-BorderWithoutAction focus-within:border-black justify-between">
                                    <input class="bg-transparent border-transparent" id="password" name="password" minLength={8}
                                        maxLength={20} placeholder="Mot de passe" />
                                </div>
                            </div>
                            
                            <div> 
                            <button type="submit"
                                class="w-full hover:bg-black/80 bg-black p-[12px] sm:p-[16px] text-white rounded-[30px] font-poppins text-[20px] font-medium">
                                Se connecter
                            </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>


        </body>

        </html>
        <?php
    }
    
}
?>