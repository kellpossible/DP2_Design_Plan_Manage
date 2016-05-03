<?php
class Users extends TableModel
{
	public function __construct($db, &$models)
	{
		parent::__construct($db, $models, "USERS", "User");
	}

	public static function getModelName()
	{
		return "users";
	}

	/**
	* performs user login
	* @param string $username [the username]
	* @param string $password [the password]
	* @return bool [whether or not the login was successful]
	*/
	public function login($username, $password) : bool
	{
		$items = $this->getItemsByValue("USERNAME", $username);
		if (is_null($items))
		{
			return False;
		}

		if (sizeof($items) == 0)
		{
			return False;
		}

		$user = $items[0];
		if (is_null($user))
		{
			return False;
		}

		if($user->getPassword() === "test")
		{
			$_SESSION['user'] = array(
	        'username' => $username,
	    );
			return True;
		}
		return False;
	}

	/**
	* @return bool [whether or not a user is logged in]
	*/
	public function isLoggedIn() : bool
	{
		if(isset($_SESSION['user'])){
			return True;
		}else{
			return False;
		}
	}

	public function logout()
	{
		unset($_SESSION['user']);
	}

}

class User extends ItemModel
{
	private $password;
	private $username;
	private $full_name;

	public function __construct($users_table_model)
	{
		parent::__construct($users_table_model);
		$this->row["PASSWORD"] = NULL;
		$this->row["USERNAME"] = NULL;
		$this->row["FULL_NAME"] = NULL;
	}

	public static function FromValues(
		$users_table_model,
		$pk,
		$username,
		$full_name,
		$password
		)
	{
		$classname = get_called_class();
		$item = new $classname($users_table_model);
		$item->setUsername($username);
		$item->setFullName($full_name);
		$item->setPassword($password);
		return $item;
	}

	public function getUsername()
	{
		return $this->row["USERNAME"];
	}

	public function setUsername($username)
	{
		$this->row["USERNAME"] = $username;
	}

	public function getFullName()
	{
		return $this->row["FULL_NAME"];
	}

	public function setFullName($full_name)
	{
		$this->row["FULL_NAME"] = $full_name;
	}

	public function getPassword()
	{
		return $this->row["PASSWORD"];
	}

	public function setPassword($password)
	{
		$this->password = $this->row["PASSWORD"];
	}
}
?>
