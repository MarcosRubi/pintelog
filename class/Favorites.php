<?php
class Favorites extends BD
{
	public $IDPost;
	public $IDUserAddFavorite;

	public function isPostFavorite()
	{
		$query = "SELECT * FROM tbl_favorites WHERE IDPost='" . $this->IDPost . "' AND IDUserAddFavorite='" . $this->IDUserAddFavorite . "'";
		return $this->EjectQuery($query);
	}

	public function addFavorite()
	{
		$query = "INSERT INTO tbl_favorites (
			IDPost,
			IDUserAddFavorite )
			VALUES (
			'" . $this->IDPost . "',
			'" . $this->IDUserAddFavorite . "')";
		return $this->EjectQuery($query);
	}


	public function editFavorite($ID, $VAL)
	{
		$query = "UPDATE tbl_favorites SET 
		Favorite = '" . $VAL . "'
		WHERE IDFavorite='" . $ID . "'";
		return $this->EjectQuery($query);
	}


}
