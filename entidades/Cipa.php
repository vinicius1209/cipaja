<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 23/10/2017
 * Time: 01:58
 */
class Cipa
{
    private $efetivos;
    private $suplentes;
    private $edital;
    private $inicio_candidatura;
    private $fim_candidatura;
    private $inicio_votacao;
    private $fim_votacao;

    /**
     * @return mixed
     */
    public function getEfetivos()
    {
        return $this->efetivos;
    }

    /**
     * @param mixed $efetivos
     * @return Cipa
     */
    public function setEfetivos($efetivos)
    {
        $this->efetivos = $efetivos;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSuplentes()
    {
        return $this->suplentes;
    }

    /**
     * @param mixed $suplentes
     * @return Cipa
     */
    public function setSuplentes($suplentes)
    {
        $this->suplentes = $suplentes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEdital()
    {
        return $this->edital;
    }

    /**
     * @param mixed $edital
     * @return Cipa
     */
    public function setEdital($edital)
    {
        $this->edital = $edital;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInicioCandidatura()
    {
        if ($this->inicio_candidatura instanceof \DateTime){
            return $this->inicio_candidatura->format("Y-m-d");
        }
        return $this->inicio_candidatura;
    }

    /**
     * @param mixed $inicio_candidatura
     * @return Cipa
     */
    public function setInicioCandidatura($inicio_candidatura)
    {
        $this->inicio_candidatura = $inicio_candidatura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFimCandidatura()
    {
        if ($this->fim_candidatura instanceof \DateTime){
            return $this->fim_candidatura->format("Y-m-d");
        }
        return $this->fim_candidatura;
    }

    /**
     * @param mixed $fim_candidatura
     * @return Cipa
     */
    public function setFimCandidatura($fim_candidatura)
    {
        $this->fim_candidatura = $fim_candidatura;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInicioVotacao()
    {
        if ($this->inicio_votacao instanceof \DateTime){
            return $this->inicio_votacao->format("Y-m-d");
        }
        return $this->inicio_votacao;
    }

    /**
     * @param mixed $inicio_votacao
     * @return Cipa
     */
    public function setInicioVotacao($inicio_votacao)
    {
        $this->inicio_votacao = $inicio_votacao;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFimVotacao()
    {
        if ($this->fim_votacao instanceof \DateTime){
            return $this->fim_votacao->format("Y-m-d");
        }
        return $this->fim_votacao;
    }

    /**
     * @param mixed $fim_votacao
     * @return Cipa
     */
    public function setFimVotacao($fim_votacao)
    {
        $this->fim_votacao = $fim_votacao;
        return $this;
    }


}