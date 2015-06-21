<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('frontpage.html');
    }

    public static function sandbox(){
      $taski = new task(array(
        'nimi' => '',
        'kuvaus' => 'a',
      ));

      $errors = $taski->errors();

      Kint::dump($errors);
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
  }