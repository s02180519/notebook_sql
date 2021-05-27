<?php

class ControllerAddContact extends Controller
{
    public function __construct()
    {
        $this->model = new ModelAddContact();
        $this->view = new View();
    }

    function action_index()
    {
        $this->view->generate('AddContactView.php', 'TemplateView.php');
        //include_once("ModelBase.php");
        if (!isset($_POST['address']))
            $address = "";
        else
            $address = $_POST['address'];

        if (!isset($_POST['email']))
            $email = "";
        else
            $email = $_POST['email'];

        if (!isset($_POST['name']))
            $name = "";
        else
            $name = $_POST['name'];

        if (!isset($_POST['tel']))
            $tel = "";
        else
            $tel = $_POST['tel'];
        $this->model->get_data($name, $tel, $address, $email);
    }
}
