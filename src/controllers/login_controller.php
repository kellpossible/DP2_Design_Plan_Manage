<?php
require_once("controllers/controller.php");

/**
* Controls the user login etc
*/
class LoginController extends Controller
{
	/**
	* Login method
	* takes return_uri=/example/uri as get argument.
	*/
	public function Login($params=array())
	{
		$users = $this->models['users'];

		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$return_uri = "/index.php";
			$unsuccessful = False;
			if (isset($_GET["return_uri"]))
			{
				$return_uri = $_GET["return_uri"];
			}
			if (isset($_GET["unsuccessful"]))
			{
				$unsuccessful = $_GET["unsuccessful"] === "True";
			}

			$message = "";
			if ($unsuccessful)
			{
				$message = "Unsuccessful login, please try again";
			}

      echo $this->templates->render('user::login', ['return_uri' => $return_uri, 'message' => $message, 'models' => $this->models]);
    } else if ($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			$return_uri = $_POST['return_uri'];
			if($users->login($username, $password))
			{
				$this->redirect($return_uri);
			} else {
				$this->redirect("/index.php/Login/Login?unsuccessful=True&return_uri=".$return_uri);
			}
		}
	}

	public function Logout($params=array())
	{
		$this->models['users']->logout();
		$this->redirect("/index.php");
	}
}


?>
