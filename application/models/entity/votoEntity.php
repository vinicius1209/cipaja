<?php

class VotoEntity
{
    protected $usuario;
    protected $candidato;
    protected $cipa;
    protected $horario_voto;

    /**
     * @return mixed
     */
    public function getCipa()
    {
        return $this->cipa;
    }

    /**
     * @param mixed $cipa
     */
    public function setCipa($cipa)
    {
        $this->cipa = $cipa;
        return $this->cipa;
    }


    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     * @return VotoEntity
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCandidato()
    {
        return $this->candidato;
    }

    /**
     * @param mixed $candidato
     * @return VotoEntity
     */
    public function setCandidato($candidato)
    {
        $this->candidato = $candidato;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHorarioVoto()
    {
        return $this->horario_voto;
    }

    public function getHorarioVotoAsDateTime()
    {
        $horarioVoto = new \DateTime($this->horario_voto);
        return $horarioVoto;
    }

    /**
     * @param mixed $horario_voto
     * @return VotoEntity
     */
    public function setHorarioVoto($horario_voto)
    {
        $this->horario_voto = $horario_voto;
        return $this;
    }


}