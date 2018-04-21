<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/cipaEntity.php");
require_once("application/models/entity/usuarioEntity.php");
require_once("application/models/entity/candidatoEntity.php");
require_once("application/models/entity/faixaEntity.php");

class CipaDAO extends CI_Model
{
    public function __construct()
    {
    }

    public function getCipasEmAndamento()
    {
        $resultados = $this->db->query("select * from cipa where inicio_votacao <= curdate() and fim_votacao >= curdate()");
        $cipas = [];
        foreach ($resultados->result() as $resultado){
            $cipa = new CipaEntity();
            $cipa->setId($resultado->id);
            $cipa->setEdital($resultado->edital);
            $cipa->setFaixa(new FaixaEntity());
            $cipa->setInicioCandidatura($resultado->inicio_candidatura);
            $cipa->setFimCandidatura($resultado->fim_candidatura);
            $cipa->setInicioVotacao($resultado->inicio_votacao);
            $cipa->setFimVotacao($resultado->fim_votacao);

            $cipa->getFaixa()->setId($resultado->faixa_id);
            $cipas[] = $cipa;
        }
        return $cipas;
    }

    public function getCandidatosCipa($cipa_id)
    {
        $resultados = $this->db->query("select usuario.*, candidato.cipa_id from candidato inner join usuario on (candidato.usuario_id = usuario.id) where candidato.cipa_id = ?", [$cipa_id]);
        $candidatos = [];
        foreach ($resultados->result() as $resultado){
            $candidato = new CandidatoEntity();
            $candidato->setId($resultado->id);
            $candidato->setMatricula($resultado->matricula);
            $candidato->setNome($resultado->nome);
            $candidato->setSenha($resultado->senha);
            $candidato->setCipa(new CipaEntity());
            $candidato->getCipa()->setId($resultado->cipa_id);
            $candidatos[] = $candidato;
        }
        return $candidatos;
    }
}