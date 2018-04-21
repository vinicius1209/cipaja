<?php

class CipaEntity
{
    protected $id;
    protected $edital;
    protected $faixa;
    protected $inicio_candidatura;
    protected $fim_candidatura;
    protected $inicio_votacao;
    protected $fim_votacao;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CipaController
     */
    public function setId($id)
    {
        $this->id = $id;
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
     * @return CipaController
     */
    public function setEdital($edital)
    {
        $this->edital = $edital;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFaixa()
    {
        return $this->faixa;
    }

    /**
     * @param mixed $faixa_id
     * @return CipaController
     */
    public function setFaixa($faixa)
    {
        $this->faixa = $faixa;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInicioCandidatura()
    {
        return $this->inicio_candidatura;
    }

    public function getInicioCandidaturaAsDateTime()
    {
        $inicioCandidatura = new \DateTime($this->inicio_candidatura);
        return $inicioCandidatura;
    }

    /**
     * @param mixed $inicio_candidatura
     * @return CipaController
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
        return $this->fim_candidatura;
    }

    public function getFimCandidaturaAsDateTime()
    {
        $fimCandidatura = new \DateTime($this->fim_candidatura);
        return $fimCandidatura;
    }

    /**
     * @param mixed $fim_candidatura
     * @return CipaController
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
        return $this->inicio_votacao;
    }

    public function getInicioVotacaoAsDateTime()
    {
        $inicioVotacao = new \DateTime($this->inicio_votacao);
        return $inicioVotacao;
    }

    /**
     * @param mixed $inicio_votacao
     * @return CipaController
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
        return $this->fim_votacao;
    }

    public function getFimVotacaoAsDateTime()
    {
        $fimVotacao = new \DateTime($this->fim_votacao);
        return $fimVotacao;
    }

    /**
     * @param mixed $fim_votacao
     * @return CipaController
     */
    public function setFimVotacao($fim_votacao)
    {
        $this->fim_votacao = $fim_votacao;
        return $this;
    }


}