<?php
class Dbh{
    private $server = '127.0.0.1';
    private $database = 'ccesdb';
    private  $username = 'john';
    private $password = 'pass1234'; 
    
    function connect(){
      $dsn = 'mysql:host='.$this->server. ';dbname='.$this->database;
      $pdo = new PDO($dsn, $this->username, $this->password);
                  // Check connection
      if($pdo === false){
        die("ERROR: Could not connect. " );
      }
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute( PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

      return $pdo;
    }

    //query function
	//SECURITY: helps protect against sql injections
	public function query($query, $data = [])
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		//supplies data if any is available
		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result;
			}
		}
		//returns false for a deleted query
		return false;
	}


}
?>