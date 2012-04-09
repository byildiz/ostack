<?php

class Vote_model extends OS_Model
{
  public function getQuestionVoteCount($qid)
  {
    $sql = "SELECT count(*) as vote_count, value FROM question_votes WHERE question_id = ? GROUP BY value";
    $query = $this->db->query($sql, array($qid));
    $vote_count = 0;
    foreach ($query->result() as $row) {
      $vote_count += $row->value * $row->vote_count;
    }
    return $vote_count;
  }
  
  public function getAnswerVoteCount($aid)
  {
    $sql = "SELECT count(*) as vote_count, value FROM answer_votes WHERE answer_id = ? GROUP BY value";
    $query = $this->db->query($sql, array($aid));
    $vote_count = 0;
    foreach ($query->result() as $row) {
      $vote_count += $row->value * $row->vote_count;
    }
    return $vote_count;
  }
  
  public function voteAnswer($voteType, $aid)
  {
    $value = ($voteType == 'up') ? 1 : -1;
    $user_id = $this->session->userdata('user')->uid;
    $answer = $this->getUserAnswerVote($user_id, $aid);
    if ($answer !== false && $value != $answer->value) {
      $sql = "UPDATE answer_votes SET value = ? WHERE answer_id = ? AND user_id = ?";
      $this->db->query($sql, array($value, $aid, $user_id));
    } else if ($answer === false) {
      $sql = "INSERT INTO answer_votes (answer_id, user_id, value) VALUES (?, ? ,?)";
      $this->db->query($sql, array($aid, $user_id, $value));
    }
    return true;
  }
  
  public function getUserAnswerVote($uid, $aid)
  {
    $sql = "SELECT * FROM answer_votes WHERE user_id = ? AND answer_id = ?";
    $query = $this->db->query($sql, array($uid, $aid));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row();
  }
  
  public function voteQuestion($voteType, $qid)
  {
    $value = ($voteType == 'up') ? 1 : -1;
    $user_id = $this->session->userdata('user')->uid;
    $question = $this->getUserQuestionVote($user_id, $qid);
    if ($question !== false && $value != $question->value) {
      $sql = "UPDATE question_votes SET value = ? WHERE question_id = ? AND user_id = ?";
      $this->db->query($sql, array($value, $qid, $user_id));
    } else if ($question === false) {
      $sql = "INSERT INTO question_votes (question_id, user_id, value) VALUES (?, ? ,?)";
      $this->db->query($sql, array($qid, $user_id, $value));
    }
    return true;
  }
  
  public function getUserQuestionVote($uid, $qid)
  {
    $sql = "SELECT * FROM question_votes WHERE user_id = ? AND question_id = ?";
    $query = $this->db->query($sql, array($uid, $qid));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row();
  }
}