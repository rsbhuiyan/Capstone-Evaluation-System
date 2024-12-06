<?php
class Apputil
{
	protected $base;

	function __construct()
	{
		
		$ini_array = parse_ini_file(__DIR__ . '\..\includes\settings.ini', false);
		$this->base = $ini_array['baseloc'];
	}

	public function getBaseUri()
	{
		// $url = explode('/', $_SERVER["REQUEST_URI"]);
		return $this->base;
	}

	public function checkLogin($filepath)
	{
		if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) { //if login in session is not set  
			$base = $this->getBaseURI();
			$uri = $base . "/login.php";
			$filepathc = str_replace("\\", "/", $filepath);
			$position = stripos($filepathc, $base, 0);
			echo "the position is " . $position;
			if (is_numeric($position)) {
				$sourcepath = substr($filepathc, $position);
				//   $sourcepath = str_replace("\\","/", $sourcepath);
				$uri = $uri . "?srcloc=" . $sourcepath;
			}
			$this->redirect_location($uri);
		}
	}

	public function redirect_location($uri)
	{
		header("Location: " . $uri);
	}

}
?>