<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role_model extends CI_Model
{

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function ubahDataRole()
    {
        $id = $this->input->post('id', true);
        $role = $this->input->post('role', true);

        $this->db->where('id', $id)->update('user_role', ['role' => $role]);



        //$this->db->where('id', $this->input->post('id'));
        //$this->db->update('user_role', ['role' => $this->input->post('editRole')]);
        //$data = 

        // $this->db->set('role', $data);
        //$this->db->where('id', $id);
        //$this->db->update('user_role');

        //$data = $this->db->insert('user_role', ['role' => $this->input->post('role')]);
        //$this->db->where('id', $this->input->post('id'));
        //$this->db->update('user_role', $data);
    }
}
