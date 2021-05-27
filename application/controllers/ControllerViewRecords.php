<?php

class ControllerViewRecords extends Controller
{
    public function __construct()
    {
        $this->model = new ModelViewRecords();
        $this->view = new View();
    }

    function action_index()
    {
        if (empty($_GET["cur_page"])) {
            $_GET["cur_page"] = "1";
        }
        $cur_page = $_GET["cur_page"];
        $data = $this->model->get_data($cur_page);
        $this->view->generate('ViewRecordsView.php', 'TemplateView.php',$data,$this->model->CountOfRecords());
    }
}
