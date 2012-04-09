<?php

class Tag_model extends OS_Model
{
  public function insert($tag)
  {
    if ($tag == '')
      return false;
    
    $user_id = $this->session->userdata('user')->uid;
    $created = created_time();
    $sql = "INSERT INTO tags (text, created, user_id) VALUES (?, ?, ?)";
    $this->db->query($sql, array(
      $tag,
      $created,
      $user_id
    ));
    
    return $this->db->insert_id();
  }
  
  public function getTagId($tag)
  {
    if ($tag == '')
      return false;
    
    $sql = "SELECT * FROM tags WHERE text = ?";
    $query = $this->db->query($sql, array($tag));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row()->tid;
  }
  
  public function getQuestionTags($qid)
  {
    $sql = "SELECT * FROM question_tags, tags WHERE tag_id = tid AND question_id = ?";
    return $this->db->query($sql, array($qid))->result();
  }
}