<?php

class ModelAddContact extends Model
{

    public function get_data($name='',$tel='',$address='',$email='')
    {
        $database = new Base();
        $person = new Person($name, $tel, $address, $email);
        $database->CreatePerson($person);
        unset($person);
        unset($database);
    }

}
