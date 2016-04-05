<?php
class UserList extends TableModel
{
	protected function generateMockups()
	{
		$this->addMockup(new User($this, 0, "test", "Test User", "test123"));
	}
}

class User extends ItemModel
{
	private $password;
	private $username;
	private $full_name;

	function __construct(
		$user_list,
		$pk,
		$username,
		$full_name,
		$password
		)
	{
		parent::__construct($user_list, $pk);
		$this->username = $username;
		$this->full_name = $full_name;
		$this->password = $password;
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function setUsername($username)
	{
		$this->username = $username;
	}

	public function getFullName()
	{
		return $this->full_name;
	}

	public function setFullName($full_name)
	{
		return $this->full_name;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function setPassword($password)
	{
		$this->password = $password;
	}
}
?>