<?php

class TaskController extends BaseController {

    public static function index() {
        $tasks = task::all();
        View::make('task/index.html', array('tasks' => $tasks));
    }

    public static function show($id) {
        $task = task::find($id);
        View::make('task/show.html', array('task' => $task));
    }

    public static function create() {
        View::make('task/new.html');
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'lisayspaiva' => date("Y-m-d H:i:s")
        );

        $task = new task($attributes);
        $errors = $task->errors();
        $errorcount = 0;
        foreach ($errors as $errort) {
            if (count($errort) > 0) {
                $errorcount++;
            }
        }

        if ($errorcount == 0) {
            $task->save();
            Redirect::to('/task', array('message' => 'Askare lisätty'));
        } else {
            View::make('task/new.html', array('errors' => $errors, 'attributes' => $attributes));
        }

    }
}