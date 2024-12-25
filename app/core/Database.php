<?php 

Trait Database
{

	public function connectDb() {
		$dsn = "mysql:host=" . SERVERNAME . ";dbname=" . DATABASE;
		try {
			$conn = new PDO($dsn, USERNAME, PASSWORD);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $ex) {
			echo "Connection failed: " . $ex->getMessage();
			exit();
		}
	
		return $conn;
	}

	public function query($query, $data = [])
{
    try {
        $conn = $this->connectDb();
        $stm = $conn->prepare($query);

        $check = $stm->execute($data);

        if ($check) {
            $result = $stm->fetchAll(PDO::FETCH_OBJ); 
            if (is_array($result) && count($result)) {
                return $result;
            }
        }
    } catch (PDOException $e) {
        error_log("Database Query Error: " . $e->getMessage());
    }

    return false;
}



	public function disconnectDb(&$conn) {
		$conn = null;
	}
	
	

	public function get_row($query, $data = [])
	{

		$conn = $this->connect();
		$stm = $conn->prepare($query);

		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result[0];
			}
		}

		return false;
	}
	
}


