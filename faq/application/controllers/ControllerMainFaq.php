<?php

class ControllerMainFaq extends ControllerFaq
{

    function action_index()
    {
        $this->view->generate('MainFaqView.php', 'TemplateView.php');
    }
}