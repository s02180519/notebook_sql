<?php

class Controller404 extends Controller
{
	
	function action_index()
	{
		$this->view->generate('404View.php', 'TemplateView.php');
	}

}
