<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Post extends CI_Controller
{
    public function index()
    {

        $data['title'] = 'Post Page Found';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['postlost'] = $this->db->get('data_barang')->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('post/index', $data);
        $this->load->view('templates/footer',);
    }

    public function lost()
    {

        $data['title'] = 'Post Page Lost';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['postlost'] = $this->db->get('data_barang')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('post/lost', $data);
        $this->load->view('templates/footer',);
    }
}
