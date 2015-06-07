<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        $validation = $this->{$validator}();
        $errors = array_merge($errors, $validation);
      }

      return $errors;
    }

    public function validate_string_length($string, $attrName, $min, $max) {
    $errors = array();
      if ($string == '' || $string == null) {
        $errors[] = $attrName . ' ei saa olla tyhjä';
      }

      if (strlen($string) < $min) {
        $errors[] = $attrName . ' pitää olla vähintään ' . $min . ' merkkiä pitkä';
      }

      if (strlen($string) > $max) {
        $errors[] = $attrName . ' saa olla enintään ' . $max . ' merkkiä pitkä';
      }

      return $errors;
    }

  }
