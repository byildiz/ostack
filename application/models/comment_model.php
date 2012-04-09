<?php

class Comment_model extends OS_Model
{
  public function getQuestionComments($qid)
  {
    $sql = "SELECT * FROM comments, question_comments, users WHERE user_id = uid AND cqid = cid AND question_id = ?";
    return $this->db->query($sql, array($qid))->result();
  }
  
  public function getAnswerComments($aid)
  {
    $sql = "SELECT * FROM comments, answer_comments, users WHERE user_id = uid AND caid = cid AND answer_id = ?";
    return $this->db->query($sql, array($aid))->result();
  }
  
  public function getCommentComments($cid)
  {
    $sql = "SELECT * FROM comments, comment_comments, users WHERE user_id = uid AND ccid = cid AND commented_id = ?";
    return $this->db->query($sql, array($cid))->result();
  }
  
  public function getQuestionCommentCount($qid)
  {
    $sql = "SELECT * FROM comments, question_comments, users WHERE user_id = uid AND cqid = cid AND question_id = ?";
    return $this->db->query($sql, array($qid))->num_rows();
  }
  
  public function getUserCommentCount($uid)
  {
    $sql = "SELECT * FROM comments, users WHERE user_id = uid AND user_id = ?";
    return $this->db->query($sql, array($uid))->num_rows();
  }
  
  public function insertQuestionComment($cid, $qid)
  {
    $sql = "INSERT INTO question_comments (cqid, question_id) VALUES (?, ?)";
    $this->db->query($sql, array($cid, $qid));
    return true;
  }
  
  public function insertAnswerComment($cid, $aid)
  {
    $sql = "INSERT INTO answer_comments (caid, answer_id) VALUES (?, ?)";
    $this->db->query($sql, array($cid, $aid));
    return true;
  }
  
  public function insertCommentComment($ccid, $cid)
  {
    $sql = "INSERT INTO comment_comments (ccid, commented_id) VALUES (?, ?)";
    $this->db->query($sql, array($ccid, $cid));
    return true;
  }
  
  public function insert($data)
  {
    $this->form_validation->set_rules('text', 'Comment', 'required');
    
    if (!$this->form_validation->run())
      return false;
    
    $user_id = $this->session->userdata('user')->uid;
    $created = created_time();
    $sql = "INSERT INTO comments (text, created, user_id) VALUES (?, ?, ?)";
    $this->db->query($sql, array(
      $data['text'],
      $created,
      $user_id
    ));
    
    return $this->db->insert_id();
  }
}