<?php
/**
 * OSTACK
 * https://github.com/byildiz/ostack
 *
 * Burak YILDIZ
 */

class Users extends OS_Controller
{
  public function index()
  {
    $this->layout->view('users/index');
  }
}