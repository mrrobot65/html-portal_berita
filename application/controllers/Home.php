<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['title'] = 'Beranda | Berita 86';
        $this->load->model('post_model', 'news');
        if(!is_logged_in()) {
            $data['news'] = $this->news->get_posts(10);
            $this->template->view('home/public', $data);
        } else {
            $data['news'] = $this->news->get_all();
            $this->template->view('home/member', $data);
        }
    }
}