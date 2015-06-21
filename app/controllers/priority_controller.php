<?php

class PriorityController extends BaseController {

    public static function index() {
        $priorities=Priority::all();
        View::make('priority/index.html', array('priorities' => $priorities));
    }

    public static function create() {
        View::make('priority/new.html');
    }

    public static function edit($id) {
        $priority = Priority::find($id);
        View::make('priority/edit.html', array('attributes' => $priority));
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
            View::make('priority/new.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities));
        }

    }

    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
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

        if ($errorcount > 0) {            
            View::make('priority/edit.html', array('errors' => $errors, 'attributes' => $attributes));            
        } else {
            $priority->update();
            Redirect::to('/priority', array('message' => 'Tärkeysaste muokattu'));
        }
    }
    
    public static function destroy($id) {
        $priority = new Priority(array('id' => $id));

        $priority->destroy();

        Redirect::to('/priority', array('message' => 'Tärkeysaste poistettu'));
    }
}