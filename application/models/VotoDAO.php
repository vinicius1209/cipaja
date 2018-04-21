<?php
require_once("application/models/entity/votoEntity.php");
require_once("application/models/entity/cipaEntity.php");
require_once("application/models/entity/usuarioEntity.php");
require_once("application/models/entity/candidatoEntity.php");

class VotoDAO extends CI_Model
{
    public function __construct()
    {
    }

    public function getNewVoto()
    {
        $voto = new VotoEntity();
        $voto->setCandidato(new CandidatoEntity());
        $voto->setUsuario(new UsuarioEntity());
        $voto->setHorarioVoto(null);
        $voto->getCandidato()->setCipa(new CipaEntity());
        return $voto;
    }

    public function salvarVoto($voto)
    {
        $this->db->query("insert into voto(usuario_id, cipa_id, candidato_id, horario_voto) values (?, ?, ?, curdate())",
            [$voto->getUsuario()->getId(), $voto->getCandidato()->getCipa()->getId(), $voto->getCandidato()->getId()]);
    }
}