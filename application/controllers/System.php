<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/usuarioEntity.php");

class System extends CI_Controller {
    private $template = [];

    public function __construct()
    {
        parent::__construct();
        //tentativa de gerar um template aqui
        $this->template["head"] = $this->load->view('partials/headlinks', '', true);
        $this->template["menu"] = $this->load->view('partials/menu', '', true);      
        $this->template["usuario"] = unserialize($this->session->userdata('usuario'));
    }

    public function index()
	{
	    if ($this->session->userdata('usuario')){
            $this->load->view('home', $this->template);
        } else{
            $this->load->view('login',$this->template);
        }
	}

	public function login()
    {
        $this->load->view('login',$this->template);
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

    public function desconectar()
    {
        $this->session->sess_destroy();
        $this->load->view('login',$this->template);
    }

    public function download()
    {
        $this->load->helper('download');
        $arquivo = $this->router->uri->segments[3];
//        var_dump("application/uploads/".$arquivo);die;
        force_download(  "application/uploads/".$arquivo, null);
    }

    public function importacao()
    {
        $this->load->view('importacao',$this->template);
    }

    public function importarFuncionarios()
    {
        if (empty($_FILES['funcionarios'])){
            echo json_encode(false);
            return;
        }
        $arquivoCSV = $_FILES['funcionarios']['tmp_name'][0];
        $handle = fopen($arquivoCSV, "r");

        $this->load->model("usuarioDAO");
        $usuarios = [];
        while(($filesop = fgetcsv($handle, 1000, ",")) !== false) {
            $usuario = $this->usuarioDAO->newUsuario($filesop[3]);
            $usuario->setNome($filesop[0]);
            $usuario->setMatricula($filesop[1]);
            $usuario->setSenha($filesop[2]);
            $usuarios[] = clone $usuario;
        }
        $status = $this->usuarioDAO->cadastrar($usuarios);
        echo json_encode($status);
    }
}
