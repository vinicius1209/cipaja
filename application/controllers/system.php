<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");

class System extends CI_Controller {
    private $template = [];

    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->template["menu"] = $this->load->view('partials/menu', '', true);
        $this->template["usuario"] = unserialize($this->session->userdata('usuario'));
    }

    public function index()
	{
	    if ($this->session->userdata('usuario')){
            $this->load->view('home', $this->template);
        } else{
            $this->load->view('login');
        }
	}

	public function login()
    {
        $this->load->view('login');
    }

    public function autenticar()
    {
        $this->load->model("UsuarioDAO");

        $matricula  = $this->input->post("matricula");
        $senha      = $this->input->post("senha");
        $usuario = $this->UsuarioDAO->getUsuarioByMatriculaAndSenha($matricula, $senha);
        if ($usuario->getId()){
            $this->session->set_userdata('usuario', serialize($usuario));
            echo true;
        }
        echo false;
    }

    public function desconectarAction()
    {
        $this->session->sess_destroy();
        $this->load->view('login');
    }

    public function download()
    {
        $this->load->helper('download');
        $arquivo = $this->router->uri->segments[3];
//        var_dump("application/uploads/".$arquivo);die;
        force_download(  "application/uploads/".$arquivo, null);
    }
}
