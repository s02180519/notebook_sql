<?php
class ControllerFaq {

    public $model;
    public $view;

    function __construct()
    {
        $this->view = new ViewFaq();
    }

    // действие (action), вызываемое по умолчанию
    function action_index()
    {
        // todo
    }
}