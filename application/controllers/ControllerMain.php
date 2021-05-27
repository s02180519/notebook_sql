<?php

class ControllerMain extends Controller
{

	function action_index()
	{	
		$this->view->generate('MainView.php', 'TemplateView.php');
	}
}