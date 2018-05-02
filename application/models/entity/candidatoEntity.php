<?php
require_once("application/models/entity/usuarioEntity.php");

class CandidatoEntity extends UsuarioEntity
{
    protected $cipa;
    protected $votos;

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
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVotos()
    {
        return $this->votos;
    }

    /**
     * @param mixed $votos
     * @return CandidatoEntity
     */
    public function setVotos($votos)
    {
        $this->votos = $votos;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "cipa" => $this->cipa,
            "votos" => $this->votos,
            "nome" => $this->getNome(),
            "matricula" => $this->getMatricula(),
            "id" => $this->getId()
        ];
    }
}