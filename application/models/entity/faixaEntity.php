<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 17/04/2018
 * Time: 23:36
 */

class FaixaEntity
{
    protected $id;
    protected $efetivos;
    protected $suplentes;
    protected $inicial;
    protected $final;
    protected $negocio;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return FaixaEntity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEfetivos()
    {
        return $this->efetivos;
    }

    /**
     * @param mixed $efetivos
     * @return FaixaEntity
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
     * @return FaixaEntity
     */
    public function setSuplentes($suplentes)
    {
        $this->suplentes = $suplentes;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInicial()
    {
        return $this->inicial;
    }

    /**
     * @param mixed $inicial
     * @return FaixaEntity
     */
    public function setInicial($inicial)
    {
        $this->inicial = $inicial;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFinal()
    {
        return $this->final;
    }

    /**
     * @param mixed $final
     * @return FaixaEntity
     */
    public function setFinal($final)
    {
        $this->final = $final;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNegocio()
    {
        return $this->negocio;
    }

    /**
     * @param mixed $negocio
     * @return FaixaEntity
     */
    public function setNegocio($negocio)
    {
        $this->negocio = $negocio;
        return $this;
    }


}