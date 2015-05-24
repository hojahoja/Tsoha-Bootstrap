<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo "etusivu";
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
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