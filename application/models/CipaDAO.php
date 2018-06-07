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
        $resultados = $this->db->query("
			select
				*
			from
				cipa
			where
				date_format(inicio_votacao, '%Y-%m-%d') <= curdate()
				and date_format(fim_votacao, '%Y-%m-%d') >= curdate()
		");
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

    public function getCipasFinalizadas()
    {
        $resultados = $this->db->query("select * from cipa where fim_votacao <= curdate()");
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
        $resultados = $this->db->query("select usuario.*, candidato.cipa_id from candidato inner join usuario on (candidato.usuario_id = usuario.id) where candidato.cipa_id = ? and candidato.aprovado = ?", [$cipa_id, 1]);
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


    public function getCipaById($id)
    {
        $resultados = $this->db->query("
        select
          cipa.*,
          faixa.suplentes,
          faixa.efetivos
        from
          cipa
        inner join
          faixa on cipa.faixa_id = faixa.id
        where cipa.id = ?", [$id]);

        $cipa = new CipaEntity();
        foreach ($resultados->result() as $resultado){
            $cipa->setId($resultado->id);
            $cipa->setEdital($resultado->edital);
            $cipa->setFaixa(new FaixaEntity());
            $cipa->setInicioCandidatura($resultado->inicio_candidatura);
            $cipa->setFimCandidatura($resultado->fim_candidatura);
            $cipa->setInicioVotacao($resultado->inicio_votacao);
            $cipa->setFimVotacao($resultado->fim_votacao);

            $cipa->getFaixa()->setId($resultado->faixa_id);
            $cipa->getFaixa()->setSuplentes($resultado->suplentes);
            $cipa->getFaixa()->setEfetivos($resultado->efetivos);
        }

        return $cipa;
    }

    public function getNewCipa()
    {
        return new CipaEntity();
    }

    public function salvar(CipaEntity $cipa)
    {
        $votacoes = $this->db->query("select * from cipa where date(inicio_votacao) >= date(?) and date(fim_votacao) <= date(?)", [$cipa->getInicioVotacao(), $cipa->getFimVotacao()]);
        $cipaAndamento = [];
        foreach ($votacoes->result() as $votacao){
            //há uma cipa em andamento
            return false;
        }
        $resultado = $this->db->query("insert into cipa(edital, faixa_id, inicio_votacao, fim_votacao, inicio_candidatura, fim_candidatura)
        values(?, ?, ?, ?, ?, ?)
        ", [$cipa->getEdital(), $cipa->getFaixa()->getId(), $cipa->getInicioVotacao(), $cipa->getFimVotacao(), $cipa->getInicioCandidatura(), $cipa->getFimCandidatura()]);
        return $resultado;
    }


    public function getCandidatosPorCipa()
    {
        $cipas = [];
        $resultados = $this->db->query(	
            "select
                cipa.*, usuario.id usuario_id, usuario.nome, candidato.aprovado
            from
                cipa
                left join candidato on candidato.cipa_id = cipa.id
                left join usuario on usuario.id = candidato.usuario_id
			where
				date_format(cipa.inicio_candidatura, '%Y-%m-%d') <= curdate()
				and date_format(cipa.fim_votacao, '%Y-%m-%d') >= curdate()
            "
        );

        if (empty($resultados)){
            return [];
        }
        foreach ($resultados->result() as $resultado){
            if (empty($cipas[$resultado->id])){
                $cipa = new CipaEntity();
                $cipa->setId($resultado->id)
                    ->setInicioCandidatura($resultado->inicio_candidatura)
                    ->setFimCandidatura($resultado->fim_candidatura)
                    ->setInicioVotacao($resultado->inicio_votacao)
                    ->setFimVotacao($resultado->fim_votacao);
                $cipas[$resultado->id] = $cipa;
            }

            if ($resultado->nome){
                $candidato = new CandidatoEntity();
                $candidato->setNome($resultado->nome);
                $candidato->setId($resultado->usuario_id);
                $candidato->setAprovacao($resultado->aprovado);
                $cipas[$resultado->id]->addCandidato($candidato);
            }
        }
        return $cipas;
    }
}