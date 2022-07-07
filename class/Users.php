<?php
class Users extends BD
{
	public $Username;
	public $Email;
	public $Password;
	public $ImgUserURL;

	public function FindById($ID)
	{
		$query = "SELECT * FROM tbl_users WHERE IDUser='" . $ID . "'";
		return $this->EjectQuery($query);
	}

	public function ListAllUsersByName()
	{
		$query = "SELECT * FROM tbl_users WHERE Username LIKE'%" . $this->Username . "%' LIMIT 5";
		return $this->EjectQuery($query);
	}

	public function FindByUsername()
	{
		$query = "SELECT * FROM tbl_users WHERE Username='" . $this->Username . "'";
		return $this->EjectQuery($query);
	}
	public function FindByEmail()
	{
		$query = "SELECT * FROM tbl_users WHERE Email='" . $this->Email . "'";
		return $this->EjectQuery($query);
	}

	public function CreateUser()
	{
		$query = "INSERT INTO tbl_users (
			Username,
			Email,
			PasswordUser)
			VALUES (
			'" . $this->Username . "',
			'" . $this->Email . "',
			'" . $this->Password . "')";
		return $this->EjectQuery($query);
	}

	public function FindUser()
	{
		$query = "SELECT * FROM tbl_users WHERE Username='" . $this->Username . "' AND PasswordUser= '".$this->Password."'";
		return $this->EjectQuery($query);
	}

	public function UpdateUser($ID)
	{
		$query = "UPDATE tbl_users SET 
		Username = '" . $this->Username . "',
		Email = '" . $this->Email . "',
		PasswordUser = '" . $this->Password . "',
		ImgUserURL = '" . $this->ImgUserURL . "' 
		WHERE IDUser='" . $ID . "'";
		return $this->EjectQuery($query);
	}

	public function DeleteUser($ID)
	{
		$query = "DELETE FROM tbl_users WHERE IDUser='" . $ID . "'";
		return $this->EjectQuery($query);
	}


}
