<?php
require_once("application/models/entity/usuarioEntity.php");

class CandidatoEntity extends UsuarioEntity
{
    protected $cipa_id;

    /**
     * @return mixed
     */
    public function getCipaId()
    {
        return $this->cipa_id;
    }

    /**
     * @param mixed $cipa_id
     */
    public function setCipaId($cipa_id)
    {
        $this->cipa_id = $cipa_id;
    }


}