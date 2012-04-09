<?php

class Question_model extends OS_Model
{
  public function insert($data)
  {
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('text', 'Explanation', 'required');
    
    if (!$this->form_validation->run())
      return false;
    
    $user_id = $this->session->userdata('user')->uid;
    $created = created_time();
    $sql = "INSERT INTO questions (title, text, created, user_id) VALUES (?, ?, ?, ?)";
    $this->db->query($sql, array(
      $data['title'],
      $data['text'],
      $created,
      $user_id
    ));
    
    return $this->db->insert_id();
  }
  
  public function getById($qid)
  {
    $sql = "SELECT * FROM questions, users WHERE user_id = uid AND qid = ?";
    $query = $this->db->query($sql, array($qid));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row();
  }
  
  public function getAll($select = 'all', $sortBy = 'newest')
  {
    $sql = "SELECT * 
            FROM questions
            LEFT OUTER JOIN users ON users.uid = questions.user_id
            LEFT OUTER JOIN (
              SELECT coalesce(count(*), 0) as answer_count, question_id
              FROM answers
              GROUP BY question_id
            ) as K ON K.question_id = questions.qid
            LEFT OUTER JOIN (
              SELECT R.question_id, down_count, up_count, down_count-up_count as vote_count
              FROM (
                SELECT coalesce(count(*), 0) AS down_count, question_id
                FROM question_votes
                WHERE value = -1 GROUP BY question_id
              ) as R, (
                SELECT coalesce(count(*), 0) AS up_count, question_id
                FROM question_votes
                WHERE value = 1 GROUP BY question_id
              ) as S
              WHERE R.question_id = S.question_id
            ) as T ON T.question_id = qid";
    switch ($select) {
      case 'unanswered':
        $sql .= " WHERE K.answer_count IS NULL";
        break;
      case 'all':
      default:
        break;
    }
    switch ($sortBy) {
      case 'vote':
        $sql .= " ORDER BY T.vote_count ASC";
        break;
      case 'newest':
      default:
        $sql .= " ORDER BY questions.created DESC";
        break;
    }
    return $this->db->query($sql)->result();
  }
  
  public function getUserQuestionCount($uid)
  {
    $sql = "SELECT * FROM questions, users WHERE user_id = uid AND user_id = ?";
    return $this->db->query($sql, array($uid))->num_rows();
  }
  
  public function getTaggedQuestions($tid)
  {
    $sql = "SELECT * FROM questions, users, question_tags WHERE user_id = uid AND question_id = qid AND tag_id = ?";
    return $this->db->query($sql, array($tid))->result();
  }
}