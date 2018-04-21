<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");

class Cipa extends CI_Controller {
    private $template = [];
    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->load->library('session');
        $this->template["menu"] = $this->load->view('partials/menu', '', true);
        $this->template["usuario"] = unserialize($this->session->userdata('usuario'));
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
        $this->template["cipa_id"] = $cipa_id;
        $this->load->view('candidatos', $this->template);
    }

    public function votar()
    {
        $this->load->model('votoDAO');
        $cipa_id = $this->input->post("cipa_id");
        $candidato_id = $this->input->post("candidato_id");

        $voto = $this->votoDAO->getNewVoto();
        $voto->getCandidato()->setId($candidato_id);
        $voto->getUsuario()->setId($this->template["usuario"]->getId());
        $this->votoDAO->salvarVoto($voto);
    }
}