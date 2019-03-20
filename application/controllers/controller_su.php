<?php

class Controller_Su extends Controller
{
	
	function action_index()
	{
		//Constructing short URL, searching it in database
		$url = new Redirect();
		$urli = $url->urlRedirectConstruct();
		$route = explode('/', $_SERVER['REQUEST_URI']);
		$short = $urli.$route[2];
		$db = new Database();
		$db->connect();
		$where = "link='$short'";
		$id = $db->select('links_short', 'id', $where);
		//Searching full URL using short's id; 
		$where = "id='".$id['id']."'";
		$full = $db->select('links_full', 'link', $where);
		$db->disconnect;
		//Redirecting
		header("Location:http://".$full['link']);
	}

}