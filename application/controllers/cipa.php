<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");

class Cipa extends CI_Controller {
    private $template = [];
    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->template["menu"] = $this->load->view('partials/menu', '', true);
		$this->template["head"] = $this->load->view('partials/headlinks', '', true);
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
		$this->load->library('javascript');
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
        $voto->getCandidato()->getCipa()->setId($cipa_id);
        $voto->getUsuario()->setId($this->template["usuario"]->getId());
        echo (bool)$this->votoDAO->salvarVoto($voto);
    }

    public function divulgacao()
    {
        $this->load->model('cipaDAO');
        $this->template["cipas"] = $this->cipaDAO->getCipasFinalizadas();
        $this->load->view('divulgacao', $this->template);
    }

    public function vencedores()
    {
        $this->load->model('candidatoDAO');
        $this->load->model('cipaDAO');
        $cipa_id = $this->input->post("cipa_id");
        $cipa = $this->cipaDAO->getCipaById($cipa_id);
        if (empty($cipa->getFaixa())){
            echo json_encode("Houve um erro ao tentar calcular os resultados");
            return;
        }
        $vencedores = $this->candidatoDAO->getResultadoCipa($cipa);

        $efetivos = [];
        $suplentes = [];
        for ($i = 0; $i < $cipa->getFaixa()->getEfetivos(); $i++){
            $efetivos[] = $vencedores[$i];
        }
        for ($i = $cipa->getFaixa()->getEfetivos(); $i < $cipa->getFaixa()->getEfetivos() + $cipa->getFaixa()->getSuplentes(); $i++){
            $suplentes[] = $vencedores[$i];
        }

        if (count($efetivos) != $cipa->getFaixa()->getEfetivos()){
            echo json_encode("Número de efetivos não alcançou o suficiente");
            return;
        }
        if (count($suplentes) != $cipa->getFaixa()->getSuplentes()){
            echo json_encode("Número de suplentes não alcançou o suficiente");
            return;
        }
        echo(json_encode([
            "efetivos" => $efetivos,
            "suplentes" => $suplentes
        ]));
        return;
    }
}