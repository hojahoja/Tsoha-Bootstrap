<?php

class User extends BaseModel {
    public $id;
    public $nimi;
    public $salasana;
    public $confirm;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_password');
        $this->validators = array('validate_user');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();

        $rows = $query->fetchAll();
        $users = array();

        foreach ($rows as $row) {

            $users[] = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

        }

        return $users;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {    
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));
        }

        return $user;
    }

    public static function find_by_name($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {    
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
                ));
            return $user;
        }

        return null;
    }

    public function save() {
        $query = DB::connection()->prepare(
            'INSERT INTO Kayttaja (nimi, salasana) 
            VALUES (:nimi, :salasana) RETURNING id');
        
        $query->execute(array(
            'nimi' => $this->nimi,
            'salasana' => $this->salasana
            ));
    }

    public static function authenticate($nimi, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND salasana = :salasana LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'salasana' => $salasana));
        $row = $query->fetch();

        if ($row) {
            $user = new User(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'salasana' => $row['salasana']
            ));

            return $user;
        } else {
            return null;
        }
    }

    public function validate_password() {
        $errors[] = $this->validate_string_length($this->salasana, 'salasana', 8, 70);

        return $errors;
    }

    public function validate_user() {
        $errors[] = $this->validate_username($this->nimi);

        return $errors;
    }
}