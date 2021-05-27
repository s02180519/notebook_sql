<?php

class ControllerSearch extends Controller
{
    public function __construct()
    {
        $this->model = new ModelSearch();
        $this->view = new View();
    }
    function action_index()
    {
        if (isset($_POST['SearchInformation'])) {
            $search_string=$_POST['SearchInformation'];
        }
        else $search_string=null;
        $data=$this->model->get_data($search_string);
        $this->view->generate('SearchView.php', 'TemplateView.php',$data);
    }
}
