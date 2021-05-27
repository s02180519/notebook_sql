<?php

class ModelViewRecords extends Model
{

    /**
     * Calculates the number of records in data base
     * @return int - number of records
     */
    public function CountOfRecords()
    {
        $database = new Base();

        return $database->Count_of_records();
    }

    public function get_data($cur_page=1,$records_on_page=6)
    {
        $database = new Base();
        return $database->View($cur_page,$records_on_page);
    }
} ?>




