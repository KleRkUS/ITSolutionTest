<?php
class Controller_Main extends Controller
{
	function __construct()
	{
		$this->model = new Model_Main();
		$this->view = new View();
	}
	
	function action_index()
	{	
		//Constructing page
		$data = $this->model->get_data();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
	
	//Processing clicking URL
	//I made this function only to take 
	//this common part out of two funcs 
	function action_urlProc() 
	{
		//URL request contains URL, extra info
		//(table or user url) and type
		$route = explode('/', $_SERVER['REQUEST_URI']);
		$var = $route[3];
		$urls = explode('&&', $var);
		$url = $urls[0];
		$addition = $urls[1];
		$type = $urls[2];
		switch ($type) {
			case '0':
				return $this->action_urlC($url, $addition);
				break;
			case '1':
				return $this->action_urlS($url, $addition);
				break;
			default:
				return "Error";
				break;
		} 
	}

	//Checking if URL is available
	function action_urlC($url, $table)
	{
		$u = new Redirect();
		$var = $u->urlRedirectConstruct();
		$status = $this->model->checkurl($url, $table);
		//Status is link or false
		if ($status) {
			$status = 'This URL is already in use.<br> URL: '.$var.$status;
		} else {
			$status = 'You can use this URL';
		}
		echo $status;
	}
	
	//Saving URL
	function action_urlS($url, $user)
	{
		$status = $this->model->saveurl($url, $user);
		echo $status;
	}
}
