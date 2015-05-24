<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/task', function() {
    HelloWorldController::listing_page();
  });

  $routes->get('/task/1', function() {
    HelloWorldController::note_information();
  });

  $routes->get('/task/1/edit', function() {
    HelloWorldController::edit_note();
  });

  $routes->get('/login', function() {
    HelloWorldController::login_page();
  });

  $routes->get('/register', function() {
    HelloWorldController::registration_page();
  });