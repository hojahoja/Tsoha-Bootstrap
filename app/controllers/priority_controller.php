<?php

class PriorityController extends BaseController {

    public static function index() {
        $priorities=Priority::all();
        View::make('priority/index.html', array('priorities' => $priorities));
    }

    public static function create() {
        View::make('priority/new.html');
    }

   public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'aste' => $params['aste']
        );

        $priority = new Priority($attributes);
        $errors = $priority->errors();
        $errorcount = 0;
        foreach ($errors as $errort) {
            if (count($errort) > 0) {
                $errorcount++;
            }
        }

        if ($errorcount == 0) {
            $priority->save();
            Redirect::to('/priority', array('message' => 'Tärkeysaste lisätty'));
        } else {
            $priorities=Priority::all();
            View::make('priority/index.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities));
        }

    }
    /*
    public static function destroy($id) {
        $priority = new Priority(array('id' => $id));

        $priority->destroy();

        Redirect::to('/priority', array('message' => 'Luokka poistettu'));
    }*/
}