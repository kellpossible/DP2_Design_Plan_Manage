<?php
class Users extends TableModel
{
	public function __construct($db)
	{
		parent::__construct($db, "USERS", "User");
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