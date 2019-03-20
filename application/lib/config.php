<?php 
	class Redirect 
	{
		//Website URL 
		private $host = "http://link/";
		private $controller = "su/";

		public function urlRedirectConstruct($controller = true)
		{
			//We can get only $host part if it's nesessary
			if ($controller) {
				$url = $this->host.$this->controller;
			} else {
				$url = $this->host;
			}	
			return $url;
		}
	}