<?php

class TaskClassController extends BaseController {

    public static function index() {
        $classes=TaskClass::all();
        View::make('class/index.html', array('classes' => $classes));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi']
        );

        $class = new TaskClass($attributes);
        $errors = $class->errors();
        $errorcount = 0;
        foreach ($errors as $errort) {
            if (count($errort) > 0) {
                $errorcount++;
            }
        }

        if ($errorcount == 0) {
            $class->save();
            Redirect::to('/class', array('message' => 'Luokka lisätty'));
        } else {
            $classes=TaskClass::all();
            View::make('class/index.html', array('errors' => $errors, 'attributes' => $attributes, 'classes' => $classes));
        }

    }

    public static function destroy($id) {
        $class = new TaskClass(array('id' => $id));

        $class->destroy();

        Redirect::to('/class', array('message' => 'Luokka poistettu'));
    }
}