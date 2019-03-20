<?php

class Controller_Su extends Controller
{
	
	function action_index()
	{
		//Constructing short URL, searching it in database
		$route = explode('/', $_SERVER['REQUEST_URI']);
		$short = $route[2];
		$db = new Database();
		$db->connect();
		//Searching full URL using short's id; 
		$full = $db->select('links_short, links_full', 'links_short.id, links_full.link', "links_short.link='$short' AND links_full.id=links_short.id");
		$db->disconnect();
		//Redirecting
		header("Location:http://".$full['link']);
	}

}