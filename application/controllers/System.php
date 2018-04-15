<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System extends CI_Controller {
    private $template = [];

    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->load->library('session');
        $this->template["menu"] = $this->load->view('partials/menu', '', true);
        $this->template["usuario"] = $this->session->userdata('usuario');
    }

    public function index()
	{
        $this->load->library('session');
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
        $this->load->library('session');
        $this->load->model("UsuarioDAO");

        $matricula  = $this->input->post("matricula");
        $senha      = $this->input->post("senha");
        $usuario = $this->UsuarioDAO->getUsuarioByMatriculaAndSenha($matricula, $senha);

        if ($usuario){
            $this->session->set_userdata('usuario', $usuario);
            echo true;
        }
        echo false;
    }

    public function desconectar()
    {
        $this->load->library('session');
        $this->session->sess_destroy();
        $this->load->view('login');
    }
}
