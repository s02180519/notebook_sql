<?php

class ModelSearch
{


    public function get_data($search_string =null)
    {
        $database = new Base();

        $data=null;
        if ($search_string) {
            $data=$database->Search($search_string);
        }
        unset($database);
        return $data;
    }
}