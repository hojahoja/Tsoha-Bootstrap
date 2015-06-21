<?php

class TaskController extends BaseController {

    public static function index() {
        $userID = BaseController::get_user_logged_in()->id;
        $tasks = task::find_by_user_id($userID);
        $priorities = Priority::find_by_user_id($userID);
        View::make('task/index.html', array('tasks' => $tasks, 'priorities' => $priorities));
    }

    public static function show($id) {
        $userID = BaseController::get_user_logged_in()->id;
        $task = task::find($id);
        $priorities = Priority::find_by_user_id($userID);

        View::make('task/show.html', array('task' => $task, 'priorities' => $priorities));
    }

    public static function create() {
        $classes = TaskClass::find_by_user_id(BaseController::get_user_logged_in()->id);
        $priorities = Priority::find_by_user_id(BaseController::get_user_logged_in()->id);

        $priorities = array_filter($priorities);
        if (empty($priorities)) {
            View::make('priority/new.html');
        } else {
            View::make('task/new.html', array('classes' => $classes, 'priorities' => $priorities));
        }      
    }

    public static function edit($id) {
        $task = task::find($id);
        $priorities = Priority::find_by_user_id(BaseController::get_user_logged_in()->id);
        View::make('task/edit.html', array('attributes' => $task, 'priorities' => $priorities));
    }    

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'lisayspaiva' => date("Y-m-d H:i:s"),
            'tarkeysaste_id' =>$params['tarkeysaste_id']
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

        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'tarkeysaste_id' => $params['tarkeysaste_id']
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
            $priorities = Priority::find_by_user_id(BaseController::get_user_logged_in()->id);      
            View::make('task/edit.html', array('errors' => $errors, 'attributes' => $attributes, 'priorities' => $priorities));            
        } else {
            $task->update();
            Redirect::to('/task/' . $task->id, array('message' => 'Askare muokattu'));
        }
    }

    public static function done($id) {
        $task = new task(array('id' => $id));

        $task->done();

        Redirect::to('/task');
    }

    public static function destroy($id) {
        $task = new task(array('id' => $id));

        $task->destroy();

        Redirect::to('/task', array('message' => 'Askare poistettu'));
    }
}