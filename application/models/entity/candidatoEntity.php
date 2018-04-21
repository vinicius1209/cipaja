<?php
require_once("application/models/entity/usuarioEntity.php");

class CandidatoEntity extends UsuarioEntity
{
    protected $cipa;

    /**
     * @return mixed
     */
    public function getCipa()
    {
        return $this->cipa;
    }

    /**
     * @param mixed $cipa_id
     */
    public function setCipa($cipa)
    {
        $this->cipa = $cipa;
    }

}