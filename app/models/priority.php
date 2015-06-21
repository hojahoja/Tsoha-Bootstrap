<?php

class Priority extends BaseModel {
    public $id;
    public $nimi;
    public $aste;
    public $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
        $this->validators = array('validate_aste');
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

    public static function find_by_user_id($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tarkeysaste WHERE kayttaja_id = :id');
        $query->execute(array('id' => $id));
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


    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tarkeysaste WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        $priority = null;
        if ($row) {    
            $priority = new Priority(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'aste' => $row['aste'],
                'kayttaja_id' => $row['kayttaja_id']
            ));
        }

        return $priority;
    }

    public function save() {
        $query = DB::connection()->prepare(
            'INSERT INTO Tarkeysaste (nimi, aste, kayttaja_id) 
            VALUES (:nimi, :aste, :kayttaja_id) RETURNING id');
        
        $query->execute(array(
            'nimi' => $this->nimi,
            'aste' => $this->aste,
            'kayttaja_id' => BaseController::get_user_logged_in()->id
        ));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Tarkeysaste WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Tarkeysaste SET nimi = :nimi, aste = :aste WHERE id = :id');
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'aste' => $this->aste));
    }


    public function validate_nimi() {
        $errors[] = $this->validate_string_length($this->nimi, 'nimi', 2, 50);

        return $errors;
    }

    public function validate_aste() {
        $errors[] = $this->validate_integer($this->aste, 'arvo', 1, 100);

        return $errors;
    }
}