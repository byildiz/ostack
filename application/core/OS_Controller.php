<?php

class OS_Controller extends CI_Controller
{
  public $data = array();
  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
  }
}