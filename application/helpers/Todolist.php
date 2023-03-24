<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todolist extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getlist($userid)
    {
        $this->db->where('userid',$userid);
        $res = $this->db->get('todo');
        if ($res->num_rows() == 0) {
            return false;
        }
        $actions = array();
        foreach ($res->result() as $row) {
            $actions[] = $row->action;
        }
        return $actions;
    }

    function add($userid,$action)
    {
        $this->db->insert('todo',array('userid' => $userid,'action' => $action));
    }
}