<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contencioso extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_seguridad', "", TRUE);
        $this->load->model('m_usuario', "", TRUE);
        $this->load->model('m_correos', "", TRUE);
    }

    public function index()
    {
        $this->load->view('_encabezado1');
        $this->load->view('_menuLateral1');
        $this->load->view('v_contencioso');
        $this->load->view('_footer1');

    }
}
