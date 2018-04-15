<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cipa extends CI_Controller {
    private $template = [];
    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->load->library('session');
        $this->template["menu"] = $this->load->view('partials/menu', '', true);
        $this->template["usuario"] = $this->session->userdata('usuario');
    }

    public function votacao()
    {
        $this->load->model('cipaDAO');

        $this->template["cipas"] = $this->cipaDAO->getCipasEmAndamento();
        $this->load->view('votacao', $this->template);
    }
}