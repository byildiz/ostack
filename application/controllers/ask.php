<?php
/**
 * OSTACK
 * https://github.com/byildiz/ostack
 *
 * Burak YILDIZ
 */

class Ask extends OS_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Question_model');
    $this->load->model('Tag_model');
    $this->load->model('QuestionTag_model');
  }
  
  public function index()
  {
    if (!empty($_POST)) {
      if (($qid = $this->Question_model->insert($_POST)) !== false) {
        $tags = explode(',', $_POST['tags']);
        foreach ($tags as $t) {
          $t = trim($t);
          $tid = $this->Tag_model->getTagId($t);
          if ($tid === false)
            $tid = $this->Tag_model->insert($t);
          if ($tid === false)
            continue;
          
          $this->QuestionTag_model->insert($qid, $tid);
        }
        redirect("questions/$qid");
      }
    }
    $this->layout->view('ask/index');
  }
}