<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{


    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*,`user_menu`.`menu`
                    FROM `user_sub_menu` JOIN `user_menu`
                    ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
        ";

        return $this->db->query($query)->result_array();
    }

    public function hapusDataSubmenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_sub_menu');
    }

    public function hapusDataMenu($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_menu');
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('user_menu', ['id' => $id])->row_array();
    }


    public function ubahMenu()
    {
        $id = $this->input->post('id', true);
        $menu = $this->input->post('menu', true);

        $this->db->where('id', $id)->update('user_menu', ['menu' => $menu]);
    }

    public function getSubMenuById($id)
    {
        return $this->db->get_where('user_sub_menu', ['id' => $id])->row_array();
    }

    public function ubahSubMenu()
    {


        $id = $this->input->post('id', true);
        $subMenu = $this->input->post('subMenu', true);
        $subMenuUrl = $this->input->post('subMenuUrl', true);
        $subMenuIcon = $this->input->post('subMenuIcon', true);
        $menu_id = $this->input->post('menu_id', true);

        $this->db->where('id', $id)->update('user_sub_menu', [
            'title' => $subMenu,
            'url' => $subMenuUrl,
            'icon' => $subMenuIcon,
            'menu_id' => $menu_id,
        ]);



        /*$data = [
            "title" => $this->input->post('title', true),
            "menu" => $this->input->post('menu', true),
            "url" => $this->input->post('url', true),
            "icon" => $this->input->post('icon', true),
        ];

        $id = $this->input->post('id', true);
        $menu = $this->input->post('title', true);

        $this->db->where('id', $id)->update('user_sub_menu', ['title' => $menu]);*/
    }
}
