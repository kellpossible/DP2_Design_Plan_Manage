<?php
require_once("models/user.php");

/**
* A controller as part of the MVC design pattern
*/
abstract class Controller
{
	protected $templates;
	protected $models;
	function __construct($templates, $models)
	{
		$this->templates = $templates;
		$this->models = $models;
	}

	/**
	* redirects client to desired uri.
	* @param string $uri [uri to redirect to]
	*/
	protected function redirect($uri)
	{
		$host  = $_SERVER['HTTP_HOST'];
		header(sprintf("Location: http://%s%s", $host, $uri));
		exit;
	}

	/**
	* call if the current route requires login to access
	* @param string $return_uri [the url to return to if login is successful]
	*/
	protected function requireLogin($return_uri)
	{
		$users = $this->models[Users::getModelName()];
		if($users->isLoggedIn()){ // OR isset($_SESSION['user']), if array
		// Logged In
		}else{
			$this->redirect("/index.php/Login/Login?return_uri=".$return_uri);
		}
	}
}
?>
