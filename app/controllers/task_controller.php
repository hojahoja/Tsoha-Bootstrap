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

    public static function edit($id) {
        $task = task::find($id);
        View::make('task/edit.html', array('attributes' => $task));
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

    public static function update($id) {
        $params = $_POST;
        Kint::dump($params);

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
        );

        $task = new task($attributes);
        $errors = $task->errors();
        $errorcount = 0;
        foreach ($errors as $errort) {
            if (count($errort) > 0) {
                $errorcount++;
            }
        }

        if ($errorcount > 0) {            
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes));            
        } else {
            $task->update();
            Redirect::to('/task/' . $task->id, array('message' => 'Askare muokattu'));
        }
    }

    public static function destroy($id) {
        $task = new task(array('id' => $id));

        $task->destroy();

        Redirect::to('/task', array('message' => 'Askare poistettu'));
    }
}