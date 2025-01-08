<?php 


Trait Controller
{

	public function __construct()
    {
        $this->startSession();
    }

    protected function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function getSessionData()
    {
        return [
            'user_id' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null,
            'user_type' => isset($_SESSION['user_type']) ? $_SESSION['user_type'] : null,
        ];
    }
	public function view($name, $data = [])
	{
		if(!empty($data))
			extract($data);
		
		$filename = "./app/views/".$name."View.php";
		if(file_exists($filename))
		{
			require $filename;
		}else{
			$filename = "./app/views/404View.php";
			require $filename;
		}
	}

	function checkLogin() {
		session_start(); 
		if (!isset($_SESSION['user_id'])) {
			header("Location: /ElMountada/auth/showLoginPage/");
			exit();
		}
	}
	


    public function method_not_found()
    {
        echo "Method doesn't exist!";
    }
}