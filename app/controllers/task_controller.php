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

        $task = new task(array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'lisayspaiva' => date("Y-m-d H:i:s")
        ));

        $task->save();

        Redirect::to('/task/' . $task->id, array('message' => 'Askare lisätty'));
    }
}