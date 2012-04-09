<?php

class Answer_model extends OS_Model
{
  public function getQuestionAnswers($qid)
  {
    $sql = "SELECT * FROM answers, users WHERE user_id = uid AND question_id = ?";
    return $this->db->query($sql, array($qid))->result();
  }
  
  public function getQuestionAnswerCount($qid)
  {
    $sql = "SELECT * FROM answers, users WHERE user_id = uid AND question_id = ?";
    return $this->db->query($sql, array($qid))->num_rows();
  }
  
  public function getUserAnswerCount($uid)
  {
    $sql = "SELECT * FROM answers, users WHERE user_id = uid AND user_id = ?";
    return $this->db->query($sql, array($uid))->num_rows();
  }
  
  public function insert($data, $qid)
  {
    $this->form_validation->set_rules('text', 'Answer', 'required');
    
    if (!$this->form_validation->run())
      return false;
    
    $user_id = $this->session->userdata('user')->uid;
    $created = created_time();
    $sql = "INSERT INTO answers (text, created, user_id, question_id, best) VALUES (?, ?, ?, ?, 0)";
    $this->db->query($sql, array(
      $data['text'],
      $created,
      $user_id,
      $qid
    ));
    
    return $this->db->insert_id();
  }
  
  public function getById($aid)
  {
    $sql = "SELECT * FROM answers, users WHERE user_id = uid AND aid = ?";
    $query = $this->db->query($sql, array($aid));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row();
  }
}