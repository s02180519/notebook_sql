<?php

class Base
{
    /**
     * @var string $table-current table name
     * @var
     */
    protected $table;
    protected $config;

    /**
     * Base constructor.
     */
    function __construct()
    {
        $this->config=include ("Config.php");
        $this->table=$this->config['db']['table name'];
    }

    /**
     * Calculates person`s existing in file with names and phone numbers
     * @param file $fname -where we`re search person
     * @param file $ftel -where we`re search person
     * @param string $person -whom we`re search
     * @return int - 1:exist,0:don`t exist
     */
    protected function PersonExists($dbh, $person, $table)
    {
        $sth = $dbh->prepare("SELECT COUNT(contact_id) FROM $this->table WHERE Name LIKE :name OR tel LIKE :tel");
        $sth->execute([
            'name' => $person->name,
            'tel' => $person->tel
        ]);
        $result = $sth->fetchColumn();
        if ($result)
            return true;
        return false;
    }

    /**
     * Calculates the number of records in data base
     * @return int - number of records
     */
    public function Count_of_records()
    {
        $dbh = new PDO($this->config['db']['dsn'],$this->config['db']['user name'],$this->config['db']['password']);

        $sth = $dbh->prepare("SELECT COUNT(contact_id) FROM $this->table");
        $sth->execute();
        return $sth->fetchColumn();
    }

    /**main function of searching and entering of all records
     * @param $SearchStr -string which is searched
     */
    public function Search($SearchStr)
    {
        $dbh = new PDO($this->config['db']['dsn'],$this->config['db']['user name'],$this->config['db']['password']);

        if (preg_match("/(?<=(tel):|(name):|(address):|(email):)\w+/i", $SearchStr)) {
            $array_meta = preg_split("/[\s,]/", $SearchStr);
            $query_tel = '';
            $query_name = '';
            $query_address = '';
            $query_email = '';
            $execute_array = [];
            foreach ($array_meta as $cur_str) {
                if (preg_match("/^tel:/", $cur_str)) {
                    $cur_tel = substr($cur_str, 4);
                    $query_tel .= 'tel LIKE :tel ';
                    $execute_array['tel'] = "%$cur_tel%";
                } elseif (preg_match("/^name:/", $cur_str)) {
                    $cur_name = substr($cur_str, 5);
                    $query_name .= 'Name LIKE :name ';
                    $execute_array['name'] = "%$cur_name%";
                } elseif (preg_match("/^address:/", $cur_str)) {
                    $cur_address = substr($cur_str, 8);
                    $query_address .= 'address LIKE :address ';
                    $execute_array['address'] = "%$cur_address%";
                } elseif (preg_match("/^email:/", $cur_str)) {
                    $cur_email = substr($cur_str, 6);
                    $query_email .= 'email LIKE :email';
                    $execute_array['email'] = "%$cur_email%";
                }
            }
            if (strlen($query_name)&&(strlen($query_tel)||strlen($query_address)||strlen($query_email)))
                $query_name .= "OR ";
            if (strlen($query_tel)&&(strlen($query_address)||strlen($query_email)))
                $query_tel .= "OR ";
            if (strlen($query_address)&&strlen($query_email))
                $query_address .= "OR ";
            $sth = $dbh->prepare("SELECT Name, tel, address, email FROM $this->table WHERE " . $query_tel . $query_name . $query_address . $query_email);
            $sth->execute($execute_array);
        } else {
            $sth = $dbh->prepare("SELECT Name, tel, address, email FROM $this->table WHERE tel LIKE :data OR Name LIKE :data OR address LIKE :data OR email LIKE :data");
            $sth->execute([
                'data' => "%$SearchStr%"
            ]);

        }
        $execute_array=$sth->fetchAll();
        $person_array= [];$i=0;
        foreach ($execute_array as $row){
            $person=new Person($row['Name'], $row['tel'],$row['address'],$row['email']);
            $person_array[++$i]=$person;
        }
        return $person_array;
    }

    /**
     * main function of adding person`s data to the data base
     * @param Person $person -person which is added to the data base
     */
    public function CreatePerson($person)
    {
        $dbh = new PDO($this->config['db']['dsn'],$this->config['db']['user name'],$this->config['db']['password']);

        if (!$this->PersonExists($dbh, $person, $this->table)) {
            $sth = $dbh->prepare("INSERT INTO `$this->table`  VALUES(NULL,:name,:tel,:address,:email)");
            $sth->execute([
                'name' => $person->name,
                'tel' => $person->tel,
                'address' => $person->address,
                'email' => $person->email
            ]);
        } else {
            echo "PERSON EXISTS!!!";
        }
    }

    /**
     * function to view all records in data base
     * @param $cur_page -current page to view
     * @return array - array with person`s data
     */
    public function View($cur_page, $records_on_page)
    {

        $dbh = new PDO($this->config['db']['dsn'],$this->config['db']['user name'],$this->config['db']['password']);
        $first_page = ($cur_page - 1) * $records_on_page;
        $sth = $dbh->prepare("SELECT * FROM $this->table WHERE 1 ORDER BY Name ASC LIMIT $first_page, $records_on_page");
        $sth->execute();
        $execute_array=$sth->fetchAll();
        $person_array= [];$i=0;
        foreach ($execute_array as $row){
            $person=new Person($row['Name'], $row['tel'],$row['address'],$row['email']);
            $person_array[++$i]=$person;
        }
        return $person_array;
    }
}
