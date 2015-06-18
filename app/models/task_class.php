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

            $classes[] = new TaskClass(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kayttaja_id' => $row['kayttaja_id']
                ));

        }

        return $classes;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Luokka WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {    
            $class = new TaskClass(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
                ));
        }

        return $class;
    }


    public function update() {
        $query = DB::connection()->prepare('UPDATE Luokka SET nimi = :nimi WHERE id = :id');
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi));
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
        $errors[] = $this->validate_string_length($this->nimi, 'nimi', 2, 50);

        return $errors;
    }

}