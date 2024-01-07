<?php

  class Pages extends Controller {
    public function __construct(){
     
    }
    
    public function index(){
      $data = [
        'title' => 'SharePosts',
        'project_to_update' => ''
      ];
     
      $this->view('pages/index', $data);
    }
  }