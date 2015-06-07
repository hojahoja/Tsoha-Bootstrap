<?php

class task extends BaseModel {
    public $id;
    public $nimi;
    public $lisayspaiva;
    public $tehty;
    public $kuvaus;
    public $kayttaja_id;
    public $tarkeysaste_id;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_kuvaus');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Askare');
        $query->execute();

        $rows = $query->fetchAll();
        $tasks = array();

        foreach ($rows as $row) {

            $tasks[] = new task(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'lisayspaiva' => $row['lisayspaiva'],
                'tehty' => $row['tehty'],
                'kuvaus' => $row['kuvaus'],
                'kayttaja_id' => $row['kayttaja_id']
            ));

        }

        return $tasks;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Askare WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {    
            $task = new task(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'lisayspaiva' => $row['lisayspaiva'],
                'tehty' => $row['tehty'],
                'kuvaus' => $row['kuvaus'],
                'kayttaja_id' => $row['kayttaja_id']
            ));
        }

        return $task;
    }

    public function save() {
        $query = DB::connection()->prepare(
            'INSERT INTO Askare (nimi, lisayspaiva, kuvaus) 
            VALUES (:nimi, :lisayspaiva, :kuvaus) RETURNING id');
        
        $query->execute(array(
            'nimi' => $this->nimi,
            'lisayspaiva' => $this->lisayspaiva,
            'kuvaus' => $this->kuvaus
        ));
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Askare SET nimi = :nimi, kuvaus = :kuvaus WHERE id = :id');
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'kuvaus'=> $this->kuvaus));
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Askare WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

    public function validate_nimi() {
        $errors[] = $this->validate_string_length($this->nimi, 'nimi', 2, 30);

        return $errors;
    }

    public function validate_kuvaus() {
        $errors[] = $this->validate_string_length($this->kuvaus, 'kuvaus', 3, 250);

        return $errors;
    }
}