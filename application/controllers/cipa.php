<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");
require_once("application/models/entity/negocioEntity.php");

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

    public function votacaoAction()
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
        $cipa_id = $this->input->post("cipa_id", TRUE);
        $candidato_id = $this->input->post("candidato_id", TRUE);

        $voto = $this->votoDAO->getNewVoto();
        $voto->getCandidato()->setId($candidato_id);
        $voto->getCandidato()->getCipa()->setId($cipa_id);        
        $voto->getUsuario()->setId($this->template["usuario"]->getId());
        echo (bool)$this->votoDAO->salvarVoto($voto);
    }

    public function divulgacaoAction()
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

    public function cadastrarAction()
    {
        $n = $this->db->query("select * from negocio");
        $negocios = [];
        foreach ($n->result() as $ng){
            $negocio = new NegocioEntity();
            $negocio->setId($ng->id);
            $negocio->setArea($ng->area);
            $negocios[] = $negocio;
        }
        $this->template["negocios"] = $negocios;
        $this->load->view("cadastrarCipa", $this->template);
    }

    public function cadastrar()
    {
        $iniciocandidatura     = DateTime::createFromFormat('d/m/Y', @$this->input->post("iniciocandidatura"));
        $terminocandidatura    = DateTime::createFromFormat('d/m/Y', @$this->input->post("terminocandidatura"));

        $iniciovotacao     = DateTime::createFromFormat('d/m/Y', @$this->input->post("iniciovotacao"));
        $terminovotacao    = DateTime::createFromFormat('d/m/Y', @$this->input->post("terminovotacao"));
        $arquivos   = $this->multiple($_FILES);
        $numeroFuncionarios = @$this->input->post("numerofuncionarios");

        $response = [];

        if (@$arquivos["edital"][0]['type'] != "application/pdf"){
            $response["tipo"] = "erro";
            $response["mensagem"] = "São aceitos apenas arquivos do tipo PDF";
        }
        if (empty($_FILES)){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Informe o arquivo";
        }

        if (empty($_POST["terminovotacao"]) || empty($_POST["terminocandidatura"])){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Preencha a data final";
        }

        if ($iniciocandidatura > $terminocandidatura || $iniciovotacao > $terminovotacao){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Data final é maior que data inicial";
        }

        if (empty($_POST["iniciocandidatura"]) || empty($_POST["iniciovotacao"])){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Preencha a data incial";
        }

        if (empty($numeroFuncionarios)){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Preencha o número de funcionários";
        }
//
//        if (!$usuario instanceof \Administrador){
//            $response["tipo"] = "erro";
//            $response["mensagem"] = "Você não possui privilégios para cadastrar uma votação.";
//        }

        if (!empty($response)){
            echo json_encode($response);
            return;
        }

        $nomeArquivo = md5(microtime().@$arquivos["edital"][0]['tmp_name']);
        if (!move_uploaded_file($arquivos["edital"][0]['tmp_name'], __DIR__."/../uploads/".$nomeArquivo.".pdf")){
            $response["tipo"] = "erro";
            $response["mensagem"] = "Ocorreu um erro ao copiar o arquivo.";
            echo json_encode($response);
            return;
        }

        $this->load->model("cipaDAO");
        $cipa = $this->cipaDAO->getNewCipa();
        $cipa->setEdital($nomeArquivo . ".pdf")
            ->setInicioCandidatura($iniciocandidatura->format('Y-m-d H:i:s'))
            ->setFimCandidatura($terminocandidatura->format('Y-m-d H:i:s'))
            ->setInicioVotacao($iniciovotacao->format('Y-m-d H:i:s'))
            ->setFimVotacao($terminovotacao->format('Y-m-d H:i:s'));

        $f = $this->db->query("select * from faixa where inicial <= ? and final >= ? and negocio_id = ?", [$numeroFuncionarios, $numeroFuncionarios, $this->input->post("negocio")]);
        foreach ($f->result() as $fx){
            $faixa = new FaixaEntity();
            $faixa->setId($fx->id);
        }
        $cipa->setFaixa($faixa);
        try{
            if ($this->cipaDAO->salvar($cipa)) {
                $response["tipo"] = "sucesso";
                $response["mensagem"] = "Cipa cadastrada com sucesso!";
            } else {
                throw new Exception("Há uma cipa cadastrada neste período");
            }
        } catch(\Exception $e){
            $response["tipo"] = "erro";
            $response["mensagem"] = $e->getMessage();
        } finally{
            echo json_encode($response);
            return;
        }
    }

    private function multiple(array $_files, $top = TRUE)
    {
        $files = array();
        foreach($_files as $name=>$file){
            if($top) $sub_name = $file['name'];
            else    $sub_name = $name;

            if(is_array($sub_name)){
                foreach(array_keys($sub_name) as $key){
                    $files[$name][$key] = array(
                        'name'     => $file['name'][$key],
                        'type'     => $file['type'][$key],
                        'tmp_name' => $file['tmp_name'][$key],
                        'error'    => $file['error'][$key],
                        'size'     => $file['size'][$key],
                    );
                    $files[$name] = $this->multiple($files[$name], FALSE);
                }
            }else{
                $files[$name] = $file;
            }
        }
        return $files;
    }
}