<?php
/**
 * OSTACK
 * https://github.com/byildiz/ostack
 *
 * Burak YILDIZ
 */

class Home extends OS_Controller
{
  public function index()
  {
    $this->layout->view('home/index');
  }
}