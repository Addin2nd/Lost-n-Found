<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer',);
    }



    public function edit()
    {
        $data['title'] = 'Edit Profile';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer',);
        } else {

            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //jika ada gambar diupload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|img';
                $config['max_size'] = '25600';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');


            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your profile has been changed!
          </div>');
            redirect('user');
        }
    }


    public function changePassword()
    {
        $data['title'] = 'Change Password';

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');


        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer',);
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Wrong current password!
                </div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                New password cannot be the same as current password!
                </div>');
                    redirect('user/changepassword');
                } else {
                    //pw dah oke
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');


                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Password changed!
                </div>');
                    redirect('user/changepassword');
                }
            }
        }
    }




    public function form()
    {

        $data['title'] = 'Form';

        $this->form_validation->set_rules('category', 'category', 'required');
        $this->form_validation->set_rules('contact', 'contact', 'required|trim');
        $this->form_validation->set_rules('description', 'description', 'required');

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/form', $data);
            $this->load->view('templates/footer');
        } else {

            $upload_image = $_FILES['image'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|img|png';
                $config['max_size'] = '25600';
                $config['upload_path'] = './assets/img/barang/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    //return $this->upload->data('file_name');
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $new_image = "defaultbarang.jpg";
                    $this->db->set('image', $new_image);
                    //return "defaultbarang.jpg";
                    //echo $this->upload->display_errors();
                }
            } else {
            }

            $data = [
                'kategori' => $this->input->post('category'),
                'kontak' =>  $this->input->post('contact'),
                'deskripsi' => $this->input->post('description'),
                'image' => $new_image
            ];


            $this->db->insert('data_barang', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been post!
                </div>');
            redirect('user/form');
        }
    }
}

/*$upload_image = $_FILES['image']['kategory'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|img';
                $config['max_size'] = '25600';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['data_barang']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/barang/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            } else {
                $data = ['image' => 'defaultbarang.jpg',];
            }*/

            /*$upload_image = $_FILES['image'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|img|png';
                $config['max_size'] = '25600';
                $config['upload_path'] = './assets/img/barang/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }*/


             /*$category = $this->input->post('category');
            $contact = $this->input->post('contact');
            $description = $this->input->post('description');
            $image = $_FILES['image'];

            if ($image = '') {
            } else {
                $config['upload_path'] = '.assets/img/barang/';
                $config['allowed_types'] = 'jpg|png|gif|img';
                $config['max_size'] = '25600';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                    die();
                } else {
                    $image = $this->upload->data('file_name');
                }
            }*/

            /*$kategori = $this->input->post('category');
            $kontak = $this->input->post('contact');
            $deskripsi = $this->input->post('description');
            $image = $_FILES['image'];*/
