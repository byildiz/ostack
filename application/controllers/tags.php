<?php

class Tags extends OS_Controller
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
    if (!empty($_POST)) {
      $this->form_validation->set_rules('text', 'Search', 'required');
      if ($this->form_validation->run()) {
        if (($tagId = $this->Tag_model->getTagId($_POST['text'])) !== false) {
          $questions = $this->Question_model->getTaggedQuestions($tagId);
          foreach ($questions as &$q) {
            $q->vote_count = $this->Vote_model->getQuestionVoteCount($q->qid);
            $q->answer_count = $this->Answer_model->getQuestionAnswerCount($q->qid);
            $q->comment_count = $this->Comment_model->getQuestionCommentCount($q->qid);
            $q->tags = $this->Tag_model->getQuestionTags($q->qid);
          }
          $this->data['questions'] = $questions;
        }
      }
    }
    $this->layout->view('tags/index', $this->data);
  }
}