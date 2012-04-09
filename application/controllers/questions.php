<?php

class Questions extends OS_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('Question_model');
    $this->load->model('Answer_model');
    $this->load->model('Tag_model');
    $this->load->model('Vote_model');
    $this->load->model('Comment_model');
  }
  
  public function index()
  {
    $select = isset($_GET['select']) ? $_GET['select'] : 'all';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest';
    $questions = $this->Question_model->getAll($select, $sort);
    foreach ($questions as &$q) {
      $q->vote_count = $this->Vote_model->getQuestionVoteCount($q->qid);
      $q->answer_count = $this->Answer_model->getQuestionAnswerCount($q->qid);
      $q->comment_count = $this->Comment_model->getQuestionCommentCount($q->qid);
      $q->tags = $this->Tag_model->getQuestionTags($q->qid);
    }
    $this->data['questions'] = $questions;
    $this->layout->view('questions/index', $this->data);
  }
  
  public function view($qid = null)
  {
    if ($qid == null || ($question = $this->Question_model->getById($qid)) === false)
      redirect('/');
    
    $question->vote_count = $this->Vote_model->getQuestionVoteCount($qid);
    $question->comments = $this->Comment_model->getQuestionComments($qid);
    $answers = $this->Answer_model->getQuestionAnswers($qid);
    foreach ($answers as &$a) {
      $a->vote_count = $this->Vote_model->getAnswerVoteCount($a->aid);
      $a->comments = $this->Comment_model->getAnswerComments($a->aid);
    }
    $tags = $this->Tag_model->getQuestionTags($qid);
    
    $this->data['question'] = $question;
    $this->data['answers'] = $answers;
    $this->data['tags'] = $tags;
    $this->layout->view('questions/view', $this->data);
  }
  
  public function answer($qid = null)
  {
    if ($qid == null)
      redirect('/');
    
    if (!empty($_POST)) {
      $this->Answer_model->insert($_POST, $qid);
    }
    redirect("questions/$qid");
  }
  
  public function vote_answer($voteType = null, $aid = null)
  {
    if ($voteType != null && $aid != null)
      $this->Vote_model->voteAnswer($voteType, $aid);
    
    $answer = $this->Answer_model->getById($aid);
    redirect("questions/".$answer->question_id);
  }
  
  public function vote_question($voteType = null, $qid = null)
  {
    if ($voteType != null && $qid != null)
      $this->Vote_model->voteQuestion($voteType, $qid);
    
    redirect("questions/$qid");
  }
  
  public function comment_question($qid = null)
  {
    if ($qid == null)
      redirect('/');
    
    if (!empty($_POST)) {
      if (($cqid = $this->Comment_model->insert($_POST)) !== false) {
        $this->Comment_model->insertQuestionComment($cqid, $qid);
        redirect("questions/$qid");
      }
    }
    
    $this->data['formAction'] = $this->uri->uri_string();
    $this->data['commentTitle'] = 'on question';
    $this->layout->view('questions/comment', $this->data);
  }
  
  public function comment_answer($aid, $qid)
  {
    if ($qid == null || $aid == null)
      redirect('/');
    
    if (!empty($_POST)) {
      if (($caid = $this->Comment_model->insert($_POST)) !== false) {
        $this->Comment_model->insertAnswerComment($caid, $aid);
        redirect("questions/$qid");
      }
    }
    
    $this->data['formAction'] = $this->uri->uri_string();
    $this->data['commentTitle'] = 'on answer';
    $this->layout->view('questions/comment', $this->data);
  }
  
  public function comment_comment($cid, $qid)
  {
    if ($qid == null || $cid == null)
      redirect('/');
    
    if (!empty($_POST)) {
      if (($ccid = $this->Comment_model->insert($_POST)) !== false) {
        $this->Comment_model->insertCommentComment($ccid, $cid);
        redirect("questions/$qid");
      }
    }
    
    $this->data['formAction'] = $this->uri->uri_string();
    $this->data['commentTitle'] = 'on comment';
    $this->layout->view('questions/comment', $this->data);
  }
}