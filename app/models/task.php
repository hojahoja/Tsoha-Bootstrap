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
}