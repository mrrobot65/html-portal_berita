<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = 'Akun Saya | Berita 86';

        if(!is_logged_in()) {
            redirect('account/login');
            return;
        }

        $this->form_validation->set_rules('password', 'password', 'trim|min_length[6]|md5');
        $this->form_validation->set_rules('conf_password', 'password confirmation', 'trim|md5|matches[password]');
        $this->form_validation->set_rules('gravatar_email', 'gravatar email', 'valid_email');
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');

        if($this->input->method(TRUE) == 'POST' && $this->form_validation->run()) {

            $current_user = $this->user->get();
            $current_profile = $this->user->profile();

            if($current_user->iduser != $this->input->post('iduser') || (isset($current_profile->idprofile) && $current_profile->idprofile != $this->input->post('idprofile'))) {
                $this->template->alert(
                    'Form spoofing detected.',
                    'warning'
                );
                redirect(base_url('account/logout'));
                return;
            }

            $this->load->model('user_model', 'um');
            $this->load->model('profile_model', 'pm');

            if(strlen($this->input->post('password')) > 0) {
                $this->um->update(
                    array(
                        'password' => $this->input->post('password'),
                        'edit_date' => date('Y-m-d H:i:s'),
                        'edited_by' => 'user'
                    ),
                    array(
                        'iduser' => $current_user->iduser
                    )
                );
            }

            if($current_profile && isset($current_profile->idprofile)) {
                $this->pm->update(
                    array(
                        'first_name'     => $this->input->post( 'first_name' ),
                        'last_name'      => $this->input->post( 'last_name' ),
                        'display_name'   => $this->input->post( 'display_name' ),
                        'gravatar_email' => $this->input->post( 'gravatar_email' )
                    ),
                    array(
                        'idprofile' => $current_profile->idprofile
                    )
                );
            } else {
                $this->pm->add(
                    array(
                        'iduser'         => $current_user->iduser,
                        'first_name'     => $this->input->post( 'first_name' ),
                        'last_name'      => $this->input->post( 'last_name' ),
                        'display_name'   => $this->input->post( 'display_name' ),
                        'gravatar_email' => $this->input->post( 'gravatar_email' )
                    )
                );
            }

            $this->template->alert(
                'Updated profile values.',
                'success'
            );
        }

        $data['user'] = $this->user->get();
        $data['profile'] = $this->user->profile();
        $this->template->view('account/profile', $data);
    }

    

    
    public function login() {
        $data['title'] = 'Log in | News Portal';

        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'trim|required|md5');

        if($this->input->method(TRUE) == 'POST' && $this->form_validation->run() && !$this->user->login($this->input->post('email', TRUE), $this->input->post('password'))) {
            $this->template->alert(
                'Alamat email atau password anda Salah',
                'danger'
            );
        }

        if(!is_logged_in()) {
            $this->template->view('account/login', $data);
            return;
        }

        redirect('account');
        return;
    }

    public function logout() {
        $this->user->logout();
        redirect(base_url());
    }

    public function retrieve() {
        $data['title'] = 'Retrieve password | News Portal';

        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        if($this->input->method(TRUE) == 'POST' && $this->form_validation->run()) {
            $this->load->model('user_model', 'um');

            $current_user = $this->um->get_by_email($this->input->post('email'));
            if(!$current_user) {
                $this->template->alert(
                    'Tidak dapat menemukan akun. Pastikan alamat email tertulis dengan benar.',
                    'danger'
                );
                redirect('account/retrieve');
                return;
            }

            $this->um->update(
                array(
                    'code' => generate_validation_code($this->input->post('email'))
                ),
                array(
                    'email' => $this->input->post('email')
                )
            );

            if($this->user->notify($current_user->iduser, 'retrieve')) {
                $this->template->alert(
                    'Email tentang permintaan ganti password telah dikirim.',
                    'info'
                );
                redirect(base_url());
                return;
            } else {
                $this->template->alert(
                    'Maaf! tidak dapat memproses ganti password. Mohon tunggu beberapa menit.',
                    'danger'
                );
            }

        }

        $this->template->view('account/retrieve', $data);
    }

    public function reset($key) {
        $data['title'] = 'Reset password | News Portal';
        $this->load->model('user_model', 'um');

        $current_user = $this->um->get_by_key($key);
        $data['user'] = $current_user;
        $data['key'] = $key;

        if(!$current_user) {
            $this->template->alert(
                'Invalid token provided.',
                'warning'
            );
            redirect(base_url());
            return;
        }

        $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|md5');
        $this->form_validation->set_rules('conf_password', 'password confirmation', 'trim|required|md5|matches[password]');

        if($this->input->method(TRUE) == 'POST' && ($this->input->post('key') != $key || $this->input->post('iduser') != $current_user->iduser)) {
            $this->template->alert(
                'Form spoofing detected.',
                'warning'
            );
            redirect(base_url());
            return;
        }

        if($this->input->method(TRUE) == 'POST' && $this->form_validation->run()) {
            if($this->user->activate($key, $current_user->iduser, $this->input->post('password'))) {

                $this->template->alert(
                    'Kata sandi anda telah disimpan. Silahkan login dengan form  dibawah.',
                    'Berhasil'
                );
                redirect('account/login');
                return;
            } else {
                $this->template->alert(
                    'Tidak dapat mengubah password. Silahkan hubungi administrator.',
                    'warning'
                );
                redirect(base_url());
                return;
            }
        }

        $this->template->view('account/reset_password', $data);
    }
}