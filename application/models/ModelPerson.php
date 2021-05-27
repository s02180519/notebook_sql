<?php
class Person
{
    /**
     * @var string $name
     * @var string $tel
     * @var string $address
     * @var string $email
     */
    public $name;
    public $tel;
    public $address;
    public $email;

    /**
     * Person constructor.
     * @param $new_name -person`s name
     * @param $new_tel -person`s phone number
     * @param $new_address -person`s address
     * @param $new_email -person`s email
     */
    function __construct($new_name, $new_tel, $new_address, $new_email)
    {
        $this->name = $new_name;
        $this->tel = $new_tel;
        $this->address = $new_address;
        $this->email = $new_email;
    }

    public function getFullName()
    {
        return $this->name . ' ' . $this->address;
    }
}