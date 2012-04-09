<?php
/**
 * OSTACK
 * https://github.com/byildiz/ostack
 *
 * Burak YILDIZ
 */

class Users extends OS_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('User_model');
    $this->load->model('Question_model');
    $this->load->model('Answer_model');
    $this->load->model('Comment_model');
  }
  
  public function index()
  {
    if (isset($_GET['sort']))
      $users = $this->User_model->getAll($_GET['sort']);
    else
      $users = $this->User_model->getAll();
    
    foreach ($users as &$u) {
      $u->question_count = $this->Question_model->getUserQuestionCount($u->uid);
      $u->answer_count = $this->Answer_model->getUserAnswerCount($u->uid);
      $u->comment_count = $this->Comment_model->getUserCommentCount($u->uid);
    }
    
    $this->data['users'] = $users;
    $this->layout->view('users/index', $this->data);
  }
  
  public function view($uid)
  {
    if (($user = $this->User_model->getById($uid)) === false)
      redirect('/');
    
    $user->question_count = $this->Question_model->getUserQuestionCount($user->uid);
    $user->answer_count = $this->Answer_model->getUserAnswerCount($user->uid);
    $user->comment_count = $this->Comment_model->getUserCommentCount($user->uid);
    
    $this->data['user'] = $user;
    $this->layout->view('users/view', $this->data);
  }
  
  public function register()
  {
    if (!empty($_POST)) {
      if ($this->User_model->insert($_POST)) {
        $this->User_model->login($_POST);
        redirect('/');
      }
    }
    $this->layout->view('users/register');
  }
  
  public function login()
  {
    if (!empty($_POST)) {
      if ($this->User_model->login($_POST)) {
        redirect('/');
      } else {
        $this->data['login_error'] = true;
      }
    }
    $this->layout->view('users/login', $this->data);
  }
  
  public function logout()
  {
    $this->User_model->logout();
    redirect('/users/login');
  }
}