<?php
class Posts extends BD
{
	public $IDUser;
	public $ImgPostURL;

	public function ListAll()
	{
		$query = "SELECT * FROM vta_allPosts";
		return $this->EjectQuery($query);
	}

	public function listAllPostByUser($ID)
	{
		$query = "SELECT * FROM tbl_posts WHERE IDUser='" . $ID . "'";
		return $this->EjectQuery($query);
	}

	public function listAllFavoriteByUser($ID)
	{
		$query = "SELECT 
		tbl_favorites.IDFavorite, 
		tbl_favorites.IDPost, 
		tbl_posts.ImgPostURL, 
		tbl_users.IDUser  
		FROM
		tbl_favorites
		INNER JOIN tbl_posts ON tbl_favorites.IDPost = tbl_posts.IDPost
		INNER JOIN tbl_users ON tbl_posts.IDUser = tbl_users.IDUser 
		WHERE
		tbl_favorites.IDUserAddFavorite = '" . $ID . "' AND tbl_favorites.Favorite = 'Y'";
		return $this->EjectQuery($query);
	}

	public function newPost()
	{
		$query = "INSERT INTO tbl_posts (
			IDUser, 
			ImgPostURL) 
			VALUES (
			'" . $this->IDUser . "',
			'" . $this->ImgPostURL . "')";
		return $this->EjectQuery($query);
	}

	public function delete($IDPost)
	{
		$query = "DELETE FROM tbl_posts WHERE IDPost = '" . $IDPost . "'";
		return $this->EjectQuery($query);
	}

	public function validateDelete($IDUser, $IDPost){
		$query = "SELECT * FROM tbl_posts WHERE IDPost = '".$IDPost."' AND IDUser='".$IDUser."'";
		return $this->EjectQuery($query);
	}
}
