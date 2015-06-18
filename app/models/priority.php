<?php

class Priority extends BaseModel {
    public $id;
    public $nimi;
    public $aste;
    public $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Tarkeysaste');
        $query->execute();

        $rows = $query->fetchAll();
        $priorities = array();

        foreach ($rows as $row) {

            $priorities[] = new Priority(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aste' => $row['aste'],
                'kayttaja_id' => $row['kayttaja_id']
                ));

        }

        return $priorities;
    }

    public function save() {
        $query = DB::connection()->prepare(
            'INSERT INTO Tarkeysaste (nimi, aste) 
            VALUES (:nimi, :aste) RETURNING id');
        
        $query->execute(array(
            'nimi' => $this->nimi,
            'aste' => $this->aste
            ));
    }


    public function validate_nimi() {
        $errors[] = $this->validate_string_length($this->nimi, 'nimi', 2, 30);

        return $errors;
    }
}