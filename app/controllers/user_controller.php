<?php

class UserController extends BaseController {
    

    public static function login() {
        View::make('/user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }

    public static function registration_page() {
        View::make('/user/register.html');
    }

    public static function handle_registration() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'salasana' => $params['password'],
            'confirm' => $params['password_confirm']
            );
        $user = new User($attributes);

        $errors = $user->errors();
        $errorcount = 0;
        foreach ($errors as $errort) {
            if (count($errort) > 0) {
                $errorcount++;
            }
        }

        if ($errorcount > 0) {            
            View::make('user/register.html', array('errors' => $errors));
        } else {
            $user->save();
            Redirect::to('/login', array('message' => 'Tunnus luotu onnistuneesti'));
        }

    }


}