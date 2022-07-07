<?php
class Settings{

	public function clearParamText($val)
	{
		return trim(ucfirst(strtolower(strip_tags($val))));
	}
	public function clearParamPassword($val)
	{
		return trim($val);
	}

	public function message($type , $val){
		return "<p class=\"d-flex jc-between message $type\">$val<span onclick=\"hideMessage(true);\">X</span></p>";
	}

	public function listAllFoundUser($IDUser, $ImgProfile, $Username){
		return "
		<li class=\"d-flex align-center\" onclick=\"javascript:getViewProfile('" . $IDUser . "'); clearList();\">
			<img src=\"" . $ImgProfile. "\" id=\"imgProfile\" class=\"bordered\">
			<a href=\"#\">". $Username. "</a>
		</li>";
	}
}