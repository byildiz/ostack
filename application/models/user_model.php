<?php
/**
 * OSTACK
 * https://github.com/byildiz/ostack
 *
 * Burak YILDIZ
 */

class User_model extends OS_Model
{
  public function insert($data)
  {
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email|is_unique[users.email]');
    
    if (!$this->form_validation->run())
      return false;
    
    $password = sha1($data['password']);
    $created = created_time();
    $sql = "INSERT INTO users (email, password, name, created) VALUES (?, ?, ?, ?)";
    return $this->db->query($sql, array(
      $data['email'],
      $password,
      $data['name'],
      $created
    ));
  }
  
  public function login($data)
  {
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('email', 'E-mail', 'required');
    
    if (!$this->form_validation->run())
      return false;
    
    $password = sha1($data['password']);
    $sql = "SELECT * FROM users WHERE email = ? AND password = ?";
    $query = $this->db->query($sql, array(
      $data['email'],
      $password
    ));
    
    if ($query->num_rows() == 0)
      return false;
    
    $this->session->set_userdata('user', $query->first_row());
    
    return true;
  }
  
  public function logout()
  {
    $this->session->unset_userdata('user');
    return true;
  }
  
  public function isLoged()
  {
    return $this->session->userdata('user');
  }
  
  public function getAll($sortBy = 'reputation')
  {
    $sql = "SELECT * FROM users LEFT OUTER JOIN (SELECT count(*) as reputation, user_id FROM answers WHERE best = 1 GROUP BY user_id) as R ON R.user_id = users.uid";
    switch ($sortBy) {
      case 'newest':
        $sql .= " ORDER BY users.created DESC";
        break;
      case 'reputation':
      default:
        $sql .= " ORDER BY R.reputation DESC";
        break;
    }
    return $this->db->query($sql)->result();
  }
  
  public function getById($uid)
  {
    $sql = "SELECT * FROM users LEFT OUTER JOIN (SELECT count(*) as reputation, user_id FROM answers WHERE best = 1 AND user_id = ? GROUP BY user_id) as R ON R.user_id = users.uid WHERE users.uid = ?";
    $query = $this->db->query($sql, array($uid, $uid));
    if ($query->num_rows() == 0)
      return false;
    
    return $query->first_row();
  }
}