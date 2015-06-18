<?php

  function check_logged_in() {
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

//////////////////////////////Task//////////////////////////////

  $routes->get('/task', 'check_logged_in', function() {
    TaskController::index();
  });

  $routes->post('/task', 'check_logged_in', function() {
    TaskController::store();
  });

  $routes->get('/task/new', 'check_logged_in', function() {
    TaskController::create();
  });

  $routes->get('/task/:id', 'check_logged_in', function($id) {
    TaskController::show($id);
  });

  $routes->get('/task/:id/edit', 'check_logged_in', function($id) {
    TaskController::edit($id);
  });

  $routes->post('/task/:id/edit', 'check_logged_in', function($id) {
    TaskController::update($id);
  });

  $routes->post('/task/:id/destroy', 'check_logged_in', function($id) {
    TaskController::destroy($id);
  });

//////////////////////////////TaskClass//////////////////////////////

  $routes->get('/class', 'check_logged_in', function() {
    TaskClassController::index();
  });

  $routes->post('/class', 'check_logged_in', function() {
    TaskClassController::store();
  });

  $routes->post('/class/:id/destroy', 'check_logged_in', function($id) {
    TaskClassController::destroy($id);
  });

    $routes->get('/class/:id/edit', 'check_logged_in', function($id) {
    TaskClassController::edit($id);
  });

  $routes->post('/class/:id/edit', 'check_logged_in', function($id) {
    TaskClassController::update($id);
  });

//////////////////////////////Priority//////////////////////////////

  $routes->get('/priority', 'check_logged_in', function() {
    PriorityController::index();
  });

  $routes->post('/priority', 'check_logged_in', function() {
    PriorityController::store();
  });

  $routes->get('/priority/new', 'check_logged_in', function() {
    PriorityController::create();
  });

  $routes->post('/priority/:id/destroy', 'check_logged_in', function($id) {
    PriorityController::destroy($id);
  });

  $routes->post('/priority/:id/edit', 'check_logged_in', function($id) {
    PriorityController::update($id);
  });

//////////////////////////////User//////////////////////////////

  $routes->get('/login', function() {
    UserController::login();
  });

  $routes->post('/login', function() {
    UserController::handle_login();
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/register', function() {
    HelloWorldController::registration_page();
  });