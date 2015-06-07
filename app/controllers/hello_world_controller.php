<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('plans/frontpage.html');
    }

    public static function sandbox(){
      $siivous = task::find(1);
      $tasks = task::all();

      Kint::dump($siivous);
      Kint::dump($tasks);

      $juri = user::find(1);
      $users = user::all();

      Kint::dump($juri);
      Kint::dump($users);
    }

    public static function listing_page(){
      View::make('plans/listingpage.html');
    }

    public static function note_information() {
      View::make('plans/note.html');
    }

    public static function edit_note() {
      View::make('plans/edit.html');
    }

    public static function login_page() {
      View::make('plans/login.html');
    }

    public static function registration_page() {
      View::make('plans/register.html');
    }
  }