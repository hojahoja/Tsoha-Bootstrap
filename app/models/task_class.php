<?php

class TaskClass extends BaseModel {
    public $id;
    public $nimi;
    public $kayttaja_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Luokka');
        $query->execute();

        $rows = $query->fetchAll();
        $classes = array();

        foreach ($rows as $row) {

            $classes[] = new task(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttaja_id' => $row['kayttaja_id']
                ));

        }

        return $classes;
    }

    public function save() {
        $query = DB::connection()->prepare(
            'INSERT INTO Luokka (nimi) 
            VALUES (:nimi) RETURNING id');
        
        $query->execute(array('nimi' => $this->nimi));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_nimi() {
        $errors[] = $this->validate_string_length($this->nimi, 'nimi', 2, 30);

        return $errors;
    }

}