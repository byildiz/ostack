<?php

class QuestionTag_model extends OS_Model
{
  public function insert($qid, $tid)
  {
    $sql = "INSERT INTO question_tags (question_id, tag_id) VALUES (?, ?)";
    $this->db->query($sql, array($qid, $tid));
    
    return $this->db->insert_id();
  }
}