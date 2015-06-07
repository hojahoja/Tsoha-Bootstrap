<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/task', function() {
    TaskController::index();
  });

  $routes->post('/task', function() {
    TaskController::store();
  });

  $routes->get('/task/new', function() {
    TaskController::create();
  });

  $routes->get('/task/:id', function($id) {
    TaskController::show($id);
  });

  $routes->get('/task/:id/edit', function($id) {
    TaskController::edit($id);
  });

  $routes->post('/task/:id/edit', function($id) {
    TaskController::update($id);
  });

  $routes->post('/task/:id/destroy', function($id) {
    TaskController::destroy($id);
  });

  $routes->get('/login', function() {
    HelloWorldController::login_page();
  });

  $routes->get('/register', function() {
    HelloWorldController::registration_page();
  });