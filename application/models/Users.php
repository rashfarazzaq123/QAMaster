<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function registerUser($name, $email, $username, $password){

        if ($name == null || $email == null || $username == null || $password == null) {      
            return false;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // create a random token for the user (as primary key)
            $userID = mt_rand(1,999999);
            $response = $this->db->get_where('user_details',array('username' => $username));
            if ($response->num_rows() == 0) {
                if ($this->db->insert('user_details',array
                ('user_detailsID' => $userID, 'name' => $name, 'email' => $email, 'username' => $username,'password' => $hashed_password,))){
                    return True;
                }
                else {
                    return False;
                }
            } 
            return false;
        }
    }

    function authenticate($username,$password){
        $response = $this->db->get_where('user_details',array('username' => $username));
        if ($response->num_rows() != 1) {
            return false;
        }
        else {
            $row = $response->row();
            if (password_verify($password,$row->password)) {
                $session_id = $this->session->session_id;
        
                $ip_address = $this->input->ip_address();

                $date = date_create();
                $imestamp = date_timestamp_get($date);

                $this->db->insert('session', array('sessionID' => $session_id, 'ipAddress' => $ip_address, 'imestamp' => $imestamp, 'data' => $session_id));
                
                return true;
            }
            else {
                return false;
            }
        }

        
    }

    function is_logged_in(){
        $session_id = $this->session->session_id;

        $res = $this->db->get_where('session', array('sessionID' => $session_id));

        if ($res->num_rows() == 1) {
            return True;
        }
        else {
            return False;
        }
    }
}