<?php

class CipaEntity implements JsonSerializable
{
    protected $id;
    protected $edital;
    protected $faixa;
    protected $inicio_candidatura;
    protected $fim_candidatura;
    protected $inicio_votacao;
    protected $fim_votacao;
    protected $efetivos = [];
    protected $suplentes = [];
    protected $candidatos = [];

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
     * @return FaixaEntity
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

    /**
     * @return array
     */
    public function getEfetivos()
    {
        return $this->efetivos;
    }

    /**
     * @param array $efetivos
     * @return CipaEntity
     */
    public function setEfetivos($efetivos)
    {
        $this->efetivos = $efetivos;
        return $this;
    }

    /**
     * @return array
     */
    public function getSuplentes()
    {
        return $this->suplentes;
    }

    /**
     * @param array $suplentes
     * @return CipaEntity
     */
    public function setSuplentes($suplentes)
    {
        $this->suplentes = $suplentes;
        return $this;
    }

    public function addEfetivo(CandidatoEntity $efetivo)
    {
        $this->efetivos[] = $efetivo;
    }

    public function addSuplente(CandidatoEntity $suplente)
    {
        $this->suplentes[] = $suplente;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->id,
            "edital" => $this->edital,
            "faixa" => $this->faixa,
            "inicio_candidatura" => $this->inicio_candidatura,
            "fim_candidatura" => $this->fim_candidatura,
            "inicio_votacao" => $this->inicio_votacao,
            "fim_votacao" => $this->fim_votacao
        ];
    }

    public function addCandidato(\CandidatoEntity $candidatoEntity)
    {
        $this->candidatos[] = $candidatoEntity;
        return $this;
    }

    public function setCandidatos($candidatos)
    {
        $this->candidatos = $candidatos;
        return $this;
    }

    public function getCandidatos()
    {
        return $this->candidatos;
    }
}