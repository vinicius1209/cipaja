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
        $this->load->helper('download');

        $this->template["cipas"] = $this->cipaDAO->getCipasEmAndamento();
        $this->load->view('votacao', $this->template);
    }

    public function candidatos()
    {
        $this->load->model('cipaDAO');
        $cipa_id = $this->router->uri->segments[3];
        $this->template["candidatos"] = $this->cipaDAO->getCandidatosCipa($cipa_id);
        $this->load->view('candidatos', $this->template);
    }

    public function votar()
    {
        $this->load->model('cipaDAO');
        $usuario_id = $this->router->uri->segments[3];
    }
}