<?php
class Model_Main extends Model
{
	
	public function checkurl($var, $table)
	{
		//Function checks if URL is in database
		//And return short link if it is
		$table = 'links_'.$table;
		$where = "link='$var'";
		$db = new Database();
		$db->connect();
		$status = $db->select($table, 'id', $where);
		if (isset($status['id'])) {
			$where = "id='".$status['id']."'";
			$status = $db->select('links_short', 'link', $where);
			$answ = $status['link'];
		} else {
			$answ = false;
		}
		$db->disconnect();
		return $answ;
	}
	
	public function saveurl($var, $user)
	{
		//Checkout don't allow to save one link more than once
		$checkout = $this->checkurl($var, 'full');
		if ($checkout) {
			return "You can't use this URL";
		}
		//If user didn't use their own link
		//Use function to generate it
		//If user's short link is in use, return warning
		$urlConstruction = new Redirect();
		$url = $urlConstruction->urlRedirectConstruct();
		$shortUrl = $url.$user;
		$shortStatus = $this->checkurl($shortUrl, 'short');
		if (!$user) {
			$user = $this->generateRandomString();
			$answ = "URL: ";
		} else if($shortStatus) {
			$answ = "This short URL is already in use";
			return $answ;
		} else {
			$answ = "URL: ";
		}
		$db = new Database();
		$db->connect();
		$insVar = '"'.$var.'"';
		//Saving full link, getting its ID and saving short one
		$query = $db->insert('links_full', 'link', $insVar);
		$where = "link='$var'";
		$query = $db->select('links_full', '*', $where);
		$id = $query['id'];
		$rows = "id, link";
		$url .= $user;
		$answ .= $url;
 		$str = '"'.$id.'", "'.$url.'"';
		$query = $db->insert('links_short', $rows, $str);
		$db->disconnect();
		return $answ;
	}

	private function generateRandomString($length = 10)
	{
		//Function generates short link 
   		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$randomString = '';
    	for ($i = 0; $i < $length; $i++) {
       		$randomString .= $characters[rand(0, $charactersLength - 1)];
    	}
    	return $randomString;
	}

}
