<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/models/entity/cipaEntity.php");
require_once("application/models/entity/usuarioEntity.php");
require_once("application/models/entity/candidatoEntity.php");
require_once("application/models/entity/faixaEntity.php");

class CandidatoDAO extends CI_Model
{
    public function __construct()
    {

    }

    public function getResultadoCipa(CipaEntity $cipa)
    {
        $resultados = $this->db->query("
        select 
          count(candidato_id) votos,
          candidato_id,
          usuario.nome
        from
          voto
        left join
          usuario on candidato_id = usuario.id
        where cipa_id = ?
        group by candidato_id, usuario.nome", [$cipa->getId()]);

        $vencedores = [];

        if (empty($resultados)){
            return $vencedores;
        }
        foreach ($resultados->result() as $resultado){
            $vencedor = new CandidatoEntity();
            $vencedor   ->setCipa($cipa)
                ->setId($resultado->candidato_id)
                ->setNome($resultado->nome)
                ->setVotos($resultado->votos);

            $vencedores[] = $vencedor;
        }
        return $vencedores;
    }

}